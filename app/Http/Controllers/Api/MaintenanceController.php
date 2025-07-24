<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\MaintenanceHelper;
use Illuminate\Http\JsonResponse;

class MaintenanceController extends Controller
{
    /**
     * Get maintenance status
     */
    public function status(): JsonResponse
    {
        return response()->json(MaintenanceHelper::getMaintenanceStatus());
    }
}
