<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Device;
use App\Models\MeshData;
use Illuminate\Http\Request;
use function Livewire\str;


//TODO: DEPRECATED UNUSED
class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(MeshData::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'address' => 'required',
            'info' => 'required',
        ]);
        if(request('timestamp') != null)
            $timestamp = request('timestamp');
        else
            $timestamp = now();
        $device = Device::where('address',request('address'))->first();
        $dataset = json_decode($request->info);
        $added = [];
        $index = 1;
//        $added = request('info');
        foreach ($dataset as $datapoint) {
            $category = Category::where('name', $datapoint->category)->first();
            $data = new MeshData();
            $data->device_id = $device->id;
            $data->category_id = $category->id;
            $data->data = $datapoint->data;
            $added[$index] = $data->attributesToArray();
            $index += 1;
        }

        foreach($added as $data){
            MeshData::insert($data);
        }

        return response()->json($added,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MeshData $data)
    {
        return response()->json($data,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = MeshData::where('id',$id)->first();
        if(request('device_id') != null){
            $data->device_id = request('device_id');
        }
        if(request('category_id') != null){
            $data->category_id = request('category_id');
        }
        $data->data = request('data');
        $data->save();

        return response()->json($data,200);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeshData $data)
    {

        $data->delete();
        return response('','410');
    }
}
