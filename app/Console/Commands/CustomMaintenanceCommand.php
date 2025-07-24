<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Console\DownCommand;
use Illuminate\Support\Facades\File;

class CustomMaintenanceCommand extends Command
{
    protected $signature = 'medquest:maintenance
                            {action : The action to perform (on/off/status)}
                            {--message= : Custom maintenance message}
                            {--contact= : Custom contact information}
                            {--estimated= : Estimated time for maintenance completion}
                            {--allow=* : IP addresses to allow during maintenance}';

    protected $description = 'Custom maintenance mode management for Medquest application';

    public function handle(): int
    {
        $action = $this->argument('action');

        return match ($action) {
            'on' => $this->enableMaintenanceMode(),
            'off' => $this->disableMaintenanceMode(),
            'status' => $this->showMaintenanceStatus(),
            default => $this->error('Invalid action. Use: on, off, or status'),
        };
    }

    private function enableMaintenanceMode(): int
    {
        $message = $this->option('message');
        $contact = $this->option('contact');
        $estimated = $this->option('estimated');
        $allowedIps = $this->option('allow');

        $maintenanceData = [
            'time' => time(),
            'message' => $message ?? 'System is under maintenance for improvements.',
            'contact' => $contact ?? 'support@medquest.com',
            'estimated' => $estimated ?? 'We\'ll be back shortly',
            'allowed_ips' => $allowedIps,
            'retry' => 300,
        ];

        $arguments = ['--render' => 'errors::503'];
        
        if (!empty($allowedIps)) {
            $arguments['--allow'] = $allowedIps;
        }

        $this->call('down', $arguments);

        File::put(
            storage_path('framework/maintenance_custom.json'),
            json_encode($maintenanceData, JSON_PRETTY_PRINT)
        );

        $this->info('🔧 Maintenance mode enabled successfully!');
        $this->line('');
        $this->line('Configuration:');
        $this->line("📝 Message: {$maintenanceData['message']}");
        $this->line("📧 Contact: {$maintenanceData['contact']}");
        $this->line("⏰ Estimated: {$maintenanceData['estimated']}");
        
        if (!empty($allowedIps)) {
            $this->line('🔓 Allowed IPs: ' . implode(', ', $allowedIps));
        }

        $this->newLine();
        $this->warn('Remember to run "php artisan medquest:maintenance off" when maintenance is complete!');

        return self::SUCCESS;
    }

    private function disableMaintenanceMode(): int
    {
        $this->call('up');

        $customMaintenanceFile = storage_path('framework/maintenance_custom.json');
        if (File::exists($customMaintenanceFile)) {
            File::delete($customMaintenanceFile);
        }

        $this->info('✅ Maintenance mode disabled successfully!');
        $this->line('🎉 Welcome back online!');

        return self::SUCCESS;
    }

    private function showMaintenanceStatus(): int
    {
        $maintenanceFile = storage_path('framework/maintenance.php');
        $customMaintenanceFile = storage_path('framework/maintenance_custom.json');

        if (File::exists($maintenanceFile)) {
            $this->error('🔧 Application is currently in MAINTENANCE MODE');
            $this->newLine();

            // Read maintenance data safely
            try {
                $maintenanceData = File::get($maintenanceFile);
                // Extract data from the file content
                if (preg_match('/\'time\'\s*=>\s*(\d+)/', $maintenanceData, $matches)) {
                    $startTime = $matches[1];
                    $this->line("⏰ Started: " . date('Y-m-d H:i:s', $startTime));
                }
                
                if (preg_match('/\'secret\'\s*=>\s*\'([^\']+)\'/', $maintenanceData, $matches)) {
                    $this->line("🔑 Secret: {$matches[1]}");
                }
                
                if (preg_match('/\'allowed\'\s*=>\s*\[(.*?)\]/s', $maintenanceData, $matches)) {
                    $allowedStr = trim($matches[1]);
                    if (!empty($allowedStr)) {
                        $this->line("🔓 Allowed IPs found");
                    }
                }
            } catch (\Exception $e) {
                $this->line("⚠️  Could not read maintenance details");
            }

            if (File::exists($customMaintenanceFile)) {
                $customData = json_decode(File::get($customMaintenanceFile), true);
                if ($customData) {
                    $this->newLine();
                    $this->line('Custom Maintenance Info:');
                    $this->line("📝 Message: {$customData['message']}");
                    $this->line("📧 Contact: {$customData['contact']}");
                    $this->line("⏰ Estimated: {$customData['estimated']}");
                }
            }

            $this->newLine();
            $this->info('To disable maintenance mode, run: php artisan medquest:maintenance off');
        } else {
            $this->info('✅ Application is currently ONLINE');
            $this->line('🎉 All systems operational!');
        }

        return self::SUCCESS;
    }
}
