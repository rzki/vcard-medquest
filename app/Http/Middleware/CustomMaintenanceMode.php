<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class CustomMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the application is in maintenance mode
        if (!$this->isMaintenanceMode()) {
            return $next($request);
        }

        // Check if the request should be allowed during maintenance
        if ($this->shouldAllowRequest($request)) {
            return $next($request);
        }

        // Load custom maintenance data
        $customData = $this->getCustomMaintenanceData();

        // Return maintenance response
        return $this->renderMaintenancePage($customData);
    }

    /**
     * Check if the application is in maintenance mode
     */
    private function isMaintenanceMode(): bool
    {
        return File::exists(storage_path('framework/maintenance.php'));
    }

    /**
     * Check if the request should be allowed during maintenance
     */
    private function shouldAllowRequest(Request $request): bool
    {
        // Allow admin routes
        if ($request->is('admin/*') || $request->is('filament/*')) {
            return true;
        }

        // Check for secret bypass
        $maintenanceData = include storage_path('framework/maintenance.php');
        if (isset($maintenanceData['secret']) && $request->header('X-Maintenance-Secret') === $maintenanceData['secret']) {
            return true;
        }

        // Check allowed IPs
        if (isset($maintenanceData['allowed']) && in_array($request->ip(), $maintenanceData['allowed'])) {
            return true;
        }

        return false;
    }

    /**
     * Get custom maintenance data
     */
    private function getCustomMaintenanceData(): array
    {
        $customFile = storage_path('framework/maintenance_custom.json');
        
        if (File::exists($customFile)) {
            return json_decode(File::get($customFile), true) ?: [];
        }

        return [];
    }

    /**
     * Render the maintenance page
     */
    private function renderMaintenancePage(array $customData): Response
    {
        $view = view('errors.503', compact('customData'));
        
        return response($view, 503, [
            'Content-Type' => 'text/html',
            'Retry-After' => $customData['retry'] ?? 300,
        ]);
    }
}
