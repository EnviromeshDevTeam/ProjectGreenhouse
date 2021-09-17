<?php

namespace App\Http\Controllers\api\api;

use App\Http\Controllers\api\Controller;
use App\Models\Device;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Device[]|Collection|Response
     */
    public function index()
    {
        return Device::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request //Request should look like \api\JSON\?
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        request()->validate([
            'name'=>'required',
            'address'=>'required'
        ]);

        $device = new Device();
        $device->name = $request->name;//Change this to $request->device->name?
        $device->address = $request->address;
        $device->save();
        return response()->json("New Device - {$device->name} has been saved", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $device = Device::findOrFail($id);
        return $device;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name'=>'required',
            'address'=>'required'
        ]);

        $device = Device::findOrFail($id);
        $device->name = $request->name;
        $device->address = $request->address;
        $device->save();
        return response()->json("Updated Device - {$device->name} has been saved", 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        $device->delete();
        return response()->json("Deleted Device - {$device->name} changes has been saved", 201);
    }
}
