<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class MaintenanceHelper
{
    /**
     * Check if the application is in maintenance mode
     */
    public static function isInMaintenanceMode(): bool
    {
        return File::exists(storage_path('framework/maintenance.php'));
    }

    /**
     * Get maintenance start time
     */
    public static function getMaintenanceStartTime(): ?Carbon
    {
        if (!self::isInMaintenanceMode()) {
            return null;
        }

        $maintenanceData = include storage_path('framework/maintenance.php');
        return Carbon::createFromTimestamp($maintenanceData['time'] ?? time());
    }

    /**
     * Get maintenance duration
     */
    public static function getMaintenanceDuration(): ?string
    {
        $startTime = self::getMaintenanceStartTime();
        
        if (!$startTime) {
            return null;
        }

        $now = Carbon::now();
        $duration = $startTime->diffForHumans($now, true);
        
        return "Ongoing for {$duration}";
    }

    /**
     * Get custom maintenance data
     */
    public static function getCustomMaintenanceData(): array
    {
        $customFile = storage_path('framework/maintenance_custom.json');
        
        if (File::exists($customFile)) {
            return json_decode(File::get($customFile), true) ?: [];
        }

        return [];
    }

    /**
     * Get maintenance message
     */
    public static function getMaintenanceMessage(): string
    {
        $customData = self::getCustomMaintenanceData();
        return $customData['message'] ?? 'System is under maintenance. We\'ll be back shortly.';
    }

    /**
     * Get maintenance contact information
     */
    public static function getMaintenanceContact(): string
    {
        $customData = self::getCustomMaintenanceData();
        return $customData['contact'] ?? 'support@medquest.com';
    }

    /**
     * Get estimated completion time
     */
    public static function getEstimatedCompletion(): string
    {
        $customData = self::getCustomMaintenanceData();
        return $customData['estimated'] ?? 'We\'ll be back shortly';
    }

    /**
     * Check if IP is allowed during maintenance
     */
    public static function isIpAllowed(string $ip): bool
    {
        if (!self::isInMaintenanceMode()) {
            return true;
        }

        $maintenanceData = include storage_path('framework/maintenance.php');
        $allowedIps = $maintenanceData['allowed'] ?? [];

        return in_array($ip, $allowedIps);
    }

    /**
     * Get maintenance status for API
     */
    public static function getMaintenanceStatus(): array
    {
        if (!self::isInMaintenanceMode()) {
            return [
                'status' => 'online',
                'maintenance' => false,
                'message' => 'All systems operational',
            ];
        }

        $customData = self::getCustomMaintenanceData();
        $startTime = self::getMaintenanceStartTime();

        return [
            'status' => 'maintenance',
            'maintenance' => true,
            'message' => self::getMaintenanceMessage(),
            'contact' => self::getMaintenanceContact(),
            'estimated' => self::getEstimatedCompletion(),
            'started_at' => $startTime?->toISOString(),
            'duration' => self::getMaintenanceDuration(),
            'retry_after' => $customData['retry'] ?? 300,
        ];
    }

    /**
     * Log maintenance action
     */
    public static function logMaintenanceAction(string $action, array $data = []): void
    {
        $logData = [
            'timestamp' => Carbon::now()->toISOString(),
            'action' => $action,
            'data' => $data,
            'user' => auth()->user()?->email ?? 'system',
            'ip' => request()->ip(),
        ];

        $logFile = storage_path('logs/maintenance.log');
        $logEntry = json_encode($logData) . PHP_EOL;
        
        File::append($logFile, $logEntry);
    }
}
