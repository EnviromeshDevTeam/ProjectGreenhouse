<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Device;
use App\Models\MeshData;
use Carbon\Carbon;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    //Load welcome but load all devices

    private $device_success = ['dstatus' => 'Running', 'dstatus_icon' => 'fas fa-smile', 'dstatus_bg' => 'bg-success'];
    private $device_failure = ['dstatus' => 'Stopped', 'dstatus_icon' => 'fas fa-dizzy', 'dstatus_bg' => 'bg-danger'];
    private $device_unknown = ['dstatus' => 'Unknown', 'dstatus_icon' => 'fa fa-question-circle', 'dstatus_bg' => 'bg-warning'];

    public function index()
    {
        $device_list = Device::all();
        foreach ($device_list as $device) {
            if ($device->updated_at->diffInSeconds(Carbon::now()) <= 20) {
                $device->setAttribute('status', $this->device_success);
            } elseif ($device->updated_at->diffInSeconds(Carbon::now()) > 21) {
                //$device->status = $this->device_failure;
                $device->setAttribute('status', $this->device_failure);
            } else {
                //$device->status = $this->device_unknown;
                $device->setAttribute('status', $this->device_unknown);
            }
        }
        return view('welcome')->with('devices', $device_list);
    }

    public function dashboard_graphing()
    {
        //Hardcoded values for now, future grab these from database
        $masterReturn = [
            ['title' => 'Temperature Graph', 'vAxis' => 'Degrees Celsius', 'htmlId' => 'tempChart', 'values' => [['created_at', 'data']]],
            ['title' => 'Humidity Graph', 'vAxis' => 'humidity', 'htmlId' => 'humChart', 'values' => [['created_at', 'data']]],
            ['title' => 'Carbon Dioxide Graph', 'vAxis' => 'co2 level', 'htmlId' => 'co2Chart', 'values' => [['created_at', 'data']]],
            ['title' => 'Air Quality Graph', 'vAxis' => 'Parts per', 'htmlId' => 'tvocChart', 'values' => [['created_at', 'data']]],
            ['title' => 'Soil Moisture Graph', 'vAxis' => 'Moisture per sq inch', 'htmlId' => 'soilMoistChart', 'values' => [['created_at', 'data']]],
            ['title' => 'Cpu Temperature Graph', 'vAxis' => 'Degrees Celsius', 'htmlId' => 'cpuTempChart', 'values' => [['created_at', 'data']]]
        ];


        $allData = MeshData::all()->take(60);

        ///TODO: I dont think category_id seperation is taking place

        //->groupBy('category_id')
        $groupedCollection = $allData->groupBy('category_id');
        $i = 0;
        foreach ($groupedCollection as $gCollkey => $gCollvalue){
            $tempArray = array();
            foreach($gCollvalue as $plotArray){
                $eachPlotPoint[] = [$plotArray->created_at->toTimeString(), $plotArray->data];
                $tempArray = array_merge($tempArray, $eachPlotPoint);
            }
            $masterReturn[$i]['values'] = array_merge($masterReturn[$i]['values'], $tempArray);
            $i += 1;
        }
        return view('dashboard')->with('envData', $masterReturn);
    }
}

//TODO: An attempt was made to call the internal fake data api. Until official pi data is
// logged we are just using the pre -seeded data for laravel graphing but fake rand genned data for the mobile API

//    public function dashboard_graphing()
//    {
//        //Hardcoded values for now, future grab these from database
//        $masterReturn = [
//            ['title' => 'Temperature Graph', 'vAxis' => 'Degrees Celsius', 'htmlId' => 'tempChart', 'values' => [['created_at', 'data']]],
//            ['title' => 'Humidity Graph', 'vAxis' => 'humidity', 'htmlId' => 'humChart', 'values' => [['created_at', 'data']]],
//            ['title' => 'Carbon Dioxide Graph', 'vAxis' => 'co2 level', 'htmlId' => 'co2Chart', 'values' => [['created_at', 'data']]],
//            ['title' => 'Air Quality Graph', 'vAxis' => 'Parts per', 'htmlId' => 'tvocChart', 'values' => [['created_at', 'data']]],
//            ['title' => 'Soil Moisture Graph', 'vAxis' => 'Moisture per sq inch', 'htmlId' => 'soilMoistChart', 'values' => [['created_at', 'data']]],
//        ];
//        ini_set("allow_url_fopen", 1);
//
//        $url = 'http://127.0.0.1:8000/api/TempFakeDataCall';
//
//        $fakeDataRequest = file_get_contents($url, true);
//        $tempFakeDataJson = json_decode($fakeDataRequest);
//
//        foreach ($tempFakeDataJson as $device) {
//            for ($i = 0; $i < 5; $i++) {
//                //GRAB only the 1h data from the json's ONLY proof of concept for now
//                foreach ($device[$i]['1H'] as $plotPoint)
//                    array_push($masterReturn[$i]['values'], $plotPoint);
//            }
//        }
//        return view('dashboard');//->with('envData', $masterReturn);
//    }
//}

