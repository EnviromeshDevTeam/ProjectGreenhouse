<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\MeshData;
use Illuminate\Http\Request;

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
            'device_id' => 'required',
            'category_id' => 'required',
            'data' => 'required',
        ]);

        $data = new MeshData();
        $data->device_id = request('device_id');
        $data->category_id = request('category_id');
        $data->data = request('data');
        $data->save();

        return response()->json($data,201);
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
    public function update(Request $request, MeshData $data)
    {
        if(request('device_id') != null){
            $data->device_id = request('device_id');
        }
        if(request('category_id') != null){
            $data->category_id = request('category_id');
        }
        $data->data = request('data');
        $data->save();

        return 'data';
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
