<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MaintenanceTest extends TestCase
{
    protected function tearDown(): void
    {
        // Clean up maintenance files after each test
        $maintenanceFile = storage_path('framework/maintenance.php');
        $customMaintenanceFile = storage_path('framework/maintenance_custom.json');
        
        if (File::exists($maintenanceFile)) {
            File::delete($maintenanceFile);
        }
        
        if (File::exists($customMaintenanceFile)) {
            File::delete($customMaintenanceFile);
        }
        
        parent::tearDown();
    }

    public function test_maintenance_status_api_returns_online_when_not_in_maintenance(): void
    {
        $response = $this->get('/api/maintenance/status');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'online',
                     'maintenance' => false,
                     'message' => 'All systems operational',
                 ]);
    }

    public function test_maintenance_page_displays_correctly(): void
    {
        // Put application in maintenance mode
        $this->artisan('down', ['--render' => 'errors::503']);

        $response = $this->get('/');

        $response->assertStatus(503)
                 ->assertSee('System Under Maintenance')
                 ->assertSee('Medquest')
                 ->assertSee('support@medquest.com');

        // Clean up
        $this->artisan('up');
    }

    public function test_custom_maintenance_command_enables_maintenance_mode(): void
    {
        $this->artisan('medquest:maintenance', ['action' => 'on'])
             ->assertSuccessful();

        $this->assertTrue(File::exists(storage_path('framework/maintenance.php')));
        $this->assertTrue(File::exists(storage_path('framework/maintenance_custom.json')));

        // Test status command
        $this->artisan('medquest:maintenance', ['action' => 'status'])
             ->assertSuccessful();

        // Clean up
        $this->artisan('medquest:maintenance', ['action' => 'off'])
             ->assertSuccessful();

        $this->assertFalse(File::exists(storage_path('framework/maintenance.php')));
        $this->assertFalse(File::exists(storage_path('framework/maintenance_custom.json')));
    }

    public function test_custom_maintenance_command_with_options(): void
    {
        $customMessage = 'Upgrading database for better performance';
        $customContact = 'admin@medquest.com';
        $estimatedTime = '2 hours';

        $this->artisan('medquest:maintenance', [
            'action' => 'on',
            '--message' => $customMessage,
            '--contact' => $customContact,
            '--estimated' => $estimatedTime,
        ])->assertSuccessful();

        // Verify custom data was saved
        $customFile = storage_path('framework/maintenance_custom.json');
        $this->assertTrue(File::exists($customFile));

        $customData = json_decode(File::get($customFile), true);
        $this->assertEquals($customMessage, $customData['message']);
        $this->assertEquals($customContact, $customData['contact']);
        $this->assertEquals($estimatedTime, $customData['estimated']);

        // Clean up
        $this->artisan('medquest:maintenance', ['action' => 'off']);
    }

    public function test_maintenance_status_api_returns_maintenance_data_when_in_maintenance(): void
    {
        // Put application in maintenance mode with custom data
        $this->artisan('medquest:maintenance', [
            'action' => 'on',
            '--message' => 'System upgrade in progress',
        ]);

        $response = $this->get('/api/maintenance/status');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'maintenance',
                     'maintenance' => true,
                     'message' => 'System upgrade in progress',
                 ]);

        // Clean up
        $this->artisan('medquest:maintenance', ['action' => 'off']);
    }

    public function test_maintenance_page_shows_custom_message(): void
    {
        $customMessage = 'Database optimization in progress';
        
        // Put application in maintenance mode with custom message
        $this->artisan('medquest:maintenance', [
            'action' => 'on',
            '--message' => $customMessage,
        ]);

        $response = $this->get('/');

        $response->assertStatus(503)
                 ->assertSee($customMessage);

        // Clean up
        $this->artisan('medquest:maintenance', ['action' => 'off']);
    }

    public function test_admin_routes_are_accessible_during_maintenance(): void
    {
        // Put application in maintenance mode
        $this->artisan('down');

        // Admin routes should still be accessible
        // Note: This test assumes you have proper authentication middleware
        // You might need to adjust based on your actual admin setup
        
        $response = $this->get('/admin');
        // Should either redirect to login or show admin panel, not maintenance page
        $this->assertNotEquals(503, $response->getStatusCode());

        // Clean up
        $this->artisan('up');
    }
}
