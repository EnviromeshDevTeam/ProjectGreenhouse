<?php

namespace App\Http\Controllers\api;

use App\Classes\MeshDataParser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psy\Util\Json;
use function Livewire\str;

class DataFetchController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param $timescale
     * @param int $device_id
     * @return false|Response|string
     */
    public function show($timescale, $device_id=1)
    {
        //TODO: Experimental - Next Step is to refactor Project Greenhouse Mobile App and Implement new Fetches

        ///This Function returns API data based on timescale selected via button via new route call
        $timescaled_return = [];
        $meshdata_parser = new MeshDataParser();


        //TODO: Do Postman Tests / JSON to CSHARP class maker and see which format might be better for looping iteration less classes.
        for ($i = 1; $i < 6; $i++) {
            $category_data = $meshdata_parser->returnFromTimeScale($timescale, $device_id, $i, $is_api = true);
            array_push($timescaled_return, $category_data);
        }

        return json_encode($timescaled_return);
    }
}
//Old Ideas
//root > name of cat > array of tupled array data
//requires reformat of Mobile App
//"1" => [], "2" => [], "3" => [], "4" => [], "5" => [],
