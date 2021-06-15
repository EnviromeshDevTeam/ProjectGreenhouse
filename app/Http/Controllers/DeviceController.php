<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $devices = Device::all();
        return view('admin.devices.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.devices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function store(Request $request)
    {

//        Device::create($request->validated());//THIS WILL NOT WORK
        $validated = $request->validate([
            'address'=>'required'
        ]);

        $device = new Device();
        $device->address = $request->address;
//        $device->attach(Carbon::now());//TODO: Will these work? which one?
//        $device->created_at = Carbon::now();

        $device->save();
        //TODO: FIGURE OUT how yo assign new
//        Device::create($this->address = $request['address'],
//            $this->updated_at = Carbon::now(),
//            $this->created_at = Carbon::now()
//        );

        return redirect(route('admin.devices.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Device $device
     * @return Application|Factory|View|Response
     */
    public function show(Device $device)
    {
        return view('admin.devices.show', compact('device'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Device $device
     * @return RedirectResponse
     */
    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('admin.devices.index');
    }
}
