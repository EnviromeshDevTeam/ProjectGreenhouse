<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Device;
use App\Models\MeshData;
use Carbon\Carbon;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
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

//        $i = 0;
//        foreach ($groupedCollection as $sectionedCollection) {
//            //groupedcollection is currently
//            //                             [
//            //                                ['1'=>[id, created_at, data...],
//            //                                      [id, created_at, data...],
//            //                                      [id, created_at, data...]],
//            //                                ['2'=>[[id, created_at, data...],
//            //                                      [id, created_at, data...],
//            //                                      [id, created_at, data...]]]
//            //                              ]
//
//
//            $tempArray = array();
//
//            foreach ($sectionedCollection as $envArray) {
//                $eachPlotPoint[] = [$envArray->created_at->toTimeString(), $envArray->data];
//                $tempArray = array_merge($tempArray, $eachPlotPoint);
//            }
//            $masterReturn[$i]['values'] = array_merge($masterReturn[$i]['values'], $tempArray);
//            $i += 1;
//        }
//        return view('dashboard')->with('envData', $masterReturn);
//    }
//}


//        $i = 0;
//        foreach ($groupedCollection as $sectionedCollection) {
//            //groupedcollection is currently
//            //                             [
//            //                                ['1'=>[id, created_at, data...],
//            //                                      [id, created_at, data...],
//            //                                      [id, created_at, data...]],
//            //                                ['2'=>[[id, created_at, data...],
//            //                                      [id, created_at, data...],
//            //                                      [id, created_at, data...]]]
//            //                              ]
//
//
//            $tempArray = array();
//
//            foreach ($sectionedCollection as $envArray) {
//                $eachPlotPoint[] = [$envArray->created_at->toTimeString(), $envArray->data];
//                $tempArray = array_merge($tempArray, $eachPlotPoint);
//            }
//            $masterReturn[$i]['values'] = array_merge($masterReturn[$i]['values'], $tempArray);
//            $i += 1;
//        }
//        return view('dashboard')->with('envData', $masterReturn);
//    }
//}
