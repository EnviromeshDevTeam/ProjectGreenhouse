<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Device;
use App\Models\MeshData;
use Carbon\Carbon;
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

//NOT IMPLEMENTED YET
    public function dashboard_graphing()
    {

        //Y AXIS = ENVVARIABLENAME Unit of measurement
        //X AXIS = Timestamp of data
        //Title = Last Measurements From Device of Variable Name
        //Legend = Env VariableName

        //Find just for debugging
//        $envName = MeshData::where('category_id', 1)
//                            ->select('category_id', 'data', 'created_at')
//                            ->get();

        //Couldn't get direct model working so after exhaustion ive got this code thats

        //Experimental below: Pseudo code and testing


//        for($id = 1; $id <= 6; $i++){
//            $env = MeshData::all()->where('category_id', 2)->makeHidden(['id','category_id', 'device_id', 'updated_at']);
//        }

        //NOT EFFICIENT need better direct select solution
        $env = MeshData::all()->where('category_id', 2)->makeHidden(['id','category_id', 'device_id', 'updated_at']);

        //$catName = Category::findOrFail(1);
        //Use catName

        //Below we want array(['data', 'created_at'], [22, timestamp here], [22, timestamp here],[22, timestamp here])
        $envValArray = $env->unique('id')->values();

        $envName = array(['created_at', 'data']);

        //TODO: remove str_replace... its working but then our json_encode function auto converts it anyway
        foreach ($envValArray as $envIterable)
            $datarow[] = array(str_replace('""', "'", ($envIterable['created_at']->toTimeString())), $envIterable['data']);
                $envName = array_merge($envName, $datarow);

        return view('dashboard')->with('envName', $envName);
    }
}
