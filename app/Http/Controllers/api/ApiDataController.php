<?php

namespace App\Http\Controllers\api;

use App\Classes\MeshDataParser;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


//TODO: DO NOT USER UNTIL QUERIES ARE OPTIMISED
class ApiDataController extends Controller
{
    /**
     * Return Mass Array for Phone App.
     *
     * TODO: Once Laravel Eloquent Queries are more optimized then assign Xamarin app Timescale buttons to individually call a timescale and update
     * TODO: (Continued) instead of one massed unneccessary array
     *
     * @param int $device_id
     * @return JsonResponse
     */
    public function index($device_id = 1): JsonResponse
    {
        //Massive 150 point json return

        //6 Timeplot points for each, average of the elapsed interval data for each
        //1 hour Timescale - 10 Minute Intervals
        //4 hour Timescale - 40 Minute Intervals
        //12 hour Timescale - 120 Minute Intervals
        //24 hour Timescale - 240 Minute Intervals
        //6 Day Timescale - Every Day Intervals
        //30 Day Timescale - Every 5 Days Intervals

        $MeshDataService = new MeshDataParser();

        $massedDataArray = array("Devices" =>
            [
                array(
                    "Temperature" => array(
                        "1H" => $MeshDataService->returnFromTimeScale("1H", $device_id, 1, true),
                        "4H" => $MeshDataService->returnFromTimeScale("4H", $device_id, 1, true),
                        "12H" => $MeshDataService->returnFromTimeScale("12H", $device_id, 1, true),
                        "24H" => $MeshDataService->returnFromTimeScale("24H", $device_id, 1, true),
                        "6D" => $MeshDataService->returnFromTimeScale("6D", $device_id, 1, true),
                        "30D" => $MeshDataService->returnFromTimeScale("30D", $device_id, 1, true)
                    ),
                    "Humidity" => array(
                        "1H" => $MeshDataService->returnFromTimeScale("1H", $device_id, 2, true),
                        "4H" => $MeshDataService->returnFromTimeScale("4H", $device_id, 2, true),
                        "12H" => $MeshDataService->returnFromTimeScale("12H", $device_id, 2, true),
                        "24H" => $MeshDataService->returnFromTimeScale("24H", $device_id, 2, true),
                        "6D" => $MeshDataService->returnFromTimeScale("6D", $device_id, 2, true),
                        "30D" => $MeshDataService->returnFromTimeScale("30D", $device_id, 2, true)
                    ),
                    "CO2" => array(
                        "1H" => $MeshDataService->returnFromTimeScale("1H", $device_id, 3, true),
                        "4H" => $MeshDataService->returnFromTimeScale("4H", $device_id, 3, true),
                        "12H" => $MeshDataService->returnFromTimeScale("12H", $device_id, 3, true),
                        "24H" => $MeshDataService->returnFromTimeScale("24H", $device_id, 3, true),
                        "6D" => $MeshDataService->returnFromTimeScale("6D", $device_id, 3, true),
                        "30D" => $MeshDataService->returnFromTimeScale("30D", $device_id, 3, true)
                    ),
                    "TVOC" => array(
                        "1H" => $MeshDataService->returnFromTimeScale("1H", $device_id, 4, true),
                        "4H" => $MeshDataService->returnFromTimeScale("4H", $device_id, 4, true),
                        "12H" => $MeshDataService->returnFromTimeScale("12H", $device_id, 4, true),
                        "24H" => $MeshDataService->returnFromTimeScale("24H", $device_id, 4, true),
                        "6D" => $MeshDataService->returnFromTimeScale("6D", $device_id, 4, true),
                        "30D" => $MeshDataService->returnFromTimeScale("30D", $device_id, 4, true)
                    ),
                    "Moisture" => array(
                        "1H" => $MeshDataService->returnFromTimeScale("1H", $device_id, 5, true),
                        "4H" => $MeshDataService->returnFromTimeScale("4H", $device_id, 5, true),
                        "12H" => $MeshDataService->returnFromTimeScale("12H", $device_id, 5, true),
                        "24H" => $MeshDataService->returnFromTimeScale("24H", $device_id, 5, true),
                        "6D" => $MeshDataService->returnFromTimeScale("6D", $device_id, 5, true),
                        "30D" => $MeshDataService->returnFromTimeScale("30D", $device_id, 5, true)
                    )
                )
            ]
        );
        return response()->json($massedDataArray);
    }
}
