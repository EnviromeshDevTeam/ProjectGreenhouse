<?php

namespace App\Http\Controllers;

use App\Classes\MeshDataParser;
use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

/**
 * Class WelcomeController
 *
 * Controls Initial Welcome Blade page
 * Controls Graphing Dashboard Display
 *
 * @package App\Http\Controllers
 */
class WelcomeController extends Controller
{
    //Load welcome but load all devices
    //Device stats for welcome
    private $device_success = ['dstatus' => 'Running', 'dstatus_icon' => 'fas fa-smile', 'dstatus_bg' => 'bg-success'];
    private $device_failure = ['dstatus' => 'Stopped', 'dstatus_icon' => 'fas fa-dizzy', 'dstatus_bg' => 'bg-danger'];
    private $device_unknown = ['dstatus' => 'Unknown', 'dstatus_icon' => 'fa fa-question-circle', 'dstatus_bg' => 'bg-warning'];
    //Time Scale Constants
    private $CONST_TIME_SCALES = array(
        "1H" => 10,
        "4H" => 40,
        "12H" => 120,
        "1D" => 240,
        "6D" => 1440,
        "30D" => 7200
    );

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $device_list = Device::all();
        foreach ($device_list as $device) {
            if ($device->updated_at->diffInSeconds(Carbon::now()) <= 40) {
                $device->setAttribute('status', $this->device_success);
            } elseif ($device->updated_at->diffInSeconds(Carbon::now()) > 40) {
                //$device->status = $this->device_failure;
                $device->setAttribute('status', $this->device_failure);
            } else {
                //$device->status = $this->device_unknown;
                $device->setAttribute('status', $this->device_unknown);
            }
        }
        return view('welcome')->with('devices', $device_list);
    }

    //TODO: $_device_id is currently hardcoded in
    //TODO: HTML Element passed in and default to load 1 which is device_id 1
    /**
     * @param string $_timescale
     * @return Application|Factory|View
     */
    public function dashboard_graphing($_timescale = "1H")
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

        $masterReturn = [
            ['title' => 'Temperature Graph', 'vAxis' => 'Degrees Celsius', 'htmlId' => 'tempChart', 'values' => []],
            ['title' => 'Humidity Graph', 'vAxis' => 'humidity', 'htmlId' => 'humChart', 'values' => []],
            ['title' => 'Carbon Dioxide Graph', 'vAxis' => 'co2 level', 'htmlId' => 'co2Chart', 'values' => []],
            ['title' => 'Carbon Dioxide Graph', 'vAxis' => 'co2 level', 'htmlId' => 'co2Chart', 'values' => []],
            ['title' => 'Air Quality Graph', 'vAxis' => 'Parts per', 'htmlId' => 'tvocChart', 'values' => []],
            ['title' => 'Soil Moisture Graph', 'vAxis' => 'Moisture per sq inch', 'htmlId' => 'soilMoistChart', 'values' => []],
            ['title' => 'Cpu Temperature Graph', 'vAxis' => 'Degrees Celsius', 'htmlId' => 'cpuTempChart', 'values' => []]
        ];

        //Instantiate our MeshDataParser/Handler
        $meshdata_parser = new MeshDataParser();

        //Initiate Data Fetching for each category of given Timescale
        for ($i = 0; $i <= 5; $i++) {
            $masterReturn[$i]['values'] = $meshdata_parser->returnFromTimeScale($_timescale, 1, $i + 1);
        }
        $valid_Timescales = $this->check_timeScaleButtons();
        return view('dashboard', ['envData' => $masterReturn, 'valid_Timescales' => $valid_Timescales]);
    }

    /**
     * Summary: To return an array of valid timescales for creation of timescale selection buttons on dashboard blade
     * @return array
     */
    private function check_timeScaleButtons(): array
    {
        $validTimescales = [];

//        Carbon::setTestNow('2022-02-15 07:46:32');
        $current_timestamp = Carbon::now();

        $oldest_timestamp = Carbon::parse(DB::table('mesh_data')->orderBy('created_at', 'asc')->first()->created_at);

        #WORKING
        $time_diff = $current_timestamp->copy()->diffInMinutes($oldest_timestamp->toDateTimeString());

        foreach ($this->CONST_TIME_SCALES as $time_scale => $time_interval){
            if ($time_diff > $time_interval * 6){
                array_push($validTimescales, $time_scale);
            }
        }
        return $validTimescales;
    }
}


