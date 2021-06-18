<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Device;
use App\Models\meshData;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\VarDumper\Cloner\Data;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $data = MeshData::all();
        return view('admin.datas.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $category = Category::all();
        $devices = Device::all();
        return view('admin.datas.create',compact('devices','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'device_id' => 'required',
            'category_id' => 'required'
        ]);
        $data = new MeshData();
        $data->device_id = request('device_id');
        $data->category_id = request('category_id');
        $data->data = request('data');
        $data->save();

        return redirect('data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(MeshData $data)
    {
        return view('admin.datas.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(MeshData $data)
    {
        $category = Category::all();
        $devices = Device::all();
        return view('admin.datas.edit', compact('data','category','devices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
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

        return redirect('data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(MeshData $data)
    {
        $data->delete();
        return redirect('data');

    }
}
