<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Classes\MeshDataParser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TempDataController extends Controller
{
    public function randTimedArrays($catID, $_carbonHours)
    {
        //Get starting Date Value based on specified timescale ($_carbonHours)
        $neededTimeScale = Carbon::createFromFormat('Y-m-d H:i:s', '2021-08-31 00:00:00')
            ->subHours($_carbonHours);

        //We will use these intervals to ->addMinutes($designatedInterval)
        $CONST_TIME_SCALES = array(
            "1" => 10,
            "4" => 40,
            "12" => 120,
            "24" => 240,
            "144" => 1440,
            "720" => 7200
        );
        $designatedInterval = 0;

        foreach ($CONST_TIME_SCALES as $hours => $intervals) {
            if ($hours == $_carbonHours) {
                $designatedInterval = $intervals;
            }
        }

        $timedStampedArray = [];
        $moisture = 100;
        for ($i = 1; $i <= 6; $i++) {
            //We clone the initial timestamp because Carbon will change the original everytime we use a method on it
            $copiedInitTimeRef = clone $neededTimeScale;
            switch ($catID) {
                case 1:
                    $envValue = rand(10, 30);
                    break;
                case 2:
                    $envValue = rand(40, 50);
                    break;
                case 3:
                    $envValue = rand(400, 500);
                    break;
                case 4:
                    $envValue = rand(300, 400);
                    break;
                case 5:
                    $envValue = $moisture / $i;
                    break;
            }
            array_push($timedStampedArray, ["date" => $copiedInitTimeRef->addMinutes($i * $designatedInterval)->toDateTimeString(), "value" => $envValue]);
        }
        return $timedStampedArray;
    }

    /**
     * Mass FAKE JSON return
     *
     * @return false|Response|string
     */
    public function index()
    {
        //Massive 150 point json return

        //6 Timeplot points for each, average of the elapsed interval data for each
        //1 hour Timescale - 10 Minute Intervals
        //4 hour Timescale - 40 Minute Intervals
        //12 hour Timescale - 120 Minute Intervals
        //24 hour Timescale - 240 Minute Intervals
        //6 Day Timescale - Every Day Intervals
        //30 Day Timescale - Every 5 Days Intervals

        $massedDataArray = array("Devices" =>
        [
            array(
                "Temperature" => array(
                    "1H" => $this->randTimedArrays(1, 1),
                    "4H" => $this->randTimedArrays(1, 4),
                    "12H" => $this->randTimedArrays(1, 12),
                    "24H" => $this->randTimedArrays(1, 24),
                    "6D" => $this->randTimedArrays(1, 144),
                    "30D" => $this->randTimedArrays(1, 720)
                ),
                "Humidity" => array(
                    "1H" => $this->randTimedArrays(2, 1),
                    "4H" => $this->randTimedArrays(2, 4),
                    "12H" => $this->randTimedArrays(2, 12),
                    "24H" => $this->randTimedArrays(2, 24),
                    "6D" => $this->randTimedArrays(2, 144),
                    "30D" => $this->randTimedArrays(2, 720)
                ),
                "CO2" => array(
                    "1H" => $this->randTimedArrays(3, 1),
                    "4H" => $this->randTimedArrays(3, 4),
                    "12H" => $this->randTimedArrays(3, 12),
                    "24H" => $this->randTimedArrays(3, 24),
                    "6D" => $this->randTimedArrays(3, 144),
                    "30D" => $this->randTimedArrays(3, 720)
                ),
                "TVOC" => array(
                    "1H" => $this->randTimedArrays(4, 1),
                    "4H" => $this->randTimedArrays(4, 4),
                    "12H" => $this->randTimedArrays(4, 12),
                    "24H" => $this->randTimedArrays(4, 24),
                    "6D" => $this->randTimedArrays(4, 144),
                    "30D" => $this->randTimedArrays(4, 720)
                ),
                "Moisture" => array(
                    "1H" => $this->randTimedArrays(5, 1),
                    "4H" => $this->randTimedArrays(5, 4),
                    "12H" => $this->randTimedArrays(5, 12),
                    "24H" => $this->randTimedArrays(5, 24),
                    "6D" => $this->randTimedArrays(5, 144),
                    "30D" => $this->randTimedArrays(5, 720)
                )
            )
            ]
        );
        return response()->json($massedDataArray);
    }
}
