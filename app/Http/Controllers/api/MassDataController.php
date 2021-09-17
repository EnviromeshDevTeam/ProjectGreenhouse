<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\MeshData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


//TODO: WHOLE FILE UNUSED
class MassDataController extends Controller
{
    /**
     * Return corresponding data of that timescale and category number.
     *
     * @param $_carbonHours
     * @param $_catNum
     * @return array
     */
    private function filter($_timeInterval, $_carbonHours, $_catNum): array
    {
        //Starting point, On deployment of live data change to Carbon::now()
        $neededTimeScale = Carbon::createFromFormat('Y-m-d H:i:s', '2021-08-31 00:00:00')
            ->subHours($_carbonHours);
        //above where statement gets approx most recent time, takes off a set amount of hours and then we get all results
        //that are greater than that subtraction

        //Multiple Queries innefficient? Should we fetch all 864k Items or do these multiple queries?
        $retrievedData = MeshData::where('created_at', '>', $neededTimeScale)
                                    ->where('category_id', $_catNum)
                                    ->get();

        //process Bulk timescale data to 6 averaged plotpoints
        //probably best if we keep adding minutes

        //Can we run model query on collection
        for ($i = 0; $i<=6; $i++){
            //TODO: EACH LOOP add $_timeInterval to $neededTimeScale
        }

        $averagedData = [];//6 Averaged plotpoints

        return $averagedData;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        //Massive 150 point json return
        //return json_encode($massedJson)

        //6 Timeplot points for each, average of the elapsed interval data for each
        //1 hour Timescale - 10 Minute Intervals
        //4 hour Timescale - 40 Minute Intervals
        //12 hour Timescale - 120 Minute Intervals
        //24 hour Timescale - 240 Minute Intervals
        //6 Day Timescale - Every Day Intervals
        //30 Day Timescale - Every 5 Days Intervals

        //TODO: UNUSED, Pass these timescales as key values to filter methods calls
        $TIME_SCALES = array(
            "1H"=>10,
            "4H"=>40,
            "12H"=>120,
            "24H"=>240,
            "6D"=>1440,
            "30D"=>7200
    );

        //Maybe we can reduce array structure to be returned from filter func?
        $massedJson = array("Devices" =>
            array(1 =>
                array("Temperature" =>
                    array("1H" => array()),
                    array("4H" => array()),
                    array("12H" => array()),
                    array("24H" => array()),
                    array("6D" => array()),
                    array("30D" => array())
                ),
                array("Humidity" =>
                    array("1H" => array()),
                    array("4H" => array()),
                    array("12H" => array()),
                    array("24H" => array()),
                    array("6D" => array()),
                    array("30D" => array())
                ),
                array("CO2" =>
                    array("1H" => array()),
                    array("4H" => array()),
                    array("12H" => array()),
                    array("24H" => array()),
                    array("6D" => array()),
                    array("30D" => array())
                ),
                array("TVOC" =>
                    array("1H" => array()),
                    array("4H" => array()),
                    array("12H" => array()),
                    array("24H" => array()),
                    array("6D" => array()),
                    array("30D" => array())
                ),
                array("Moisture" =>
                    array("1H" => array()),
                    array("4H" => array()),
                    array("12H" => array()),
                    array("24H" => array()),
                    array("6D" => array()),
                    array("30D" => array())
                ),
            )
        );
    }

    /**
     * Show specific data from specified device
     *
     * @param $device_id
     * @return Response
     */
    public function show($device_id): Response
    {
        //
    }
}
