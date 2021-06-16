<?php

namespace App\Http\Controllers;

use App\Models\Device;
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
        //How do we integrate this validated sequence
        //if validated ?
        $validated = $request->validate([
            'name'=>'required',
            'address'=>'required'
        ]);

        $device = new Device();
        $device->name = $request->name;
        $device->address = $request->address;

        $device->save();

        return redirect()->route('devices.index');
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
     * @param Device $device
     * @return Application|Factory|View|Response
     */
    public function edit(Device $device)
    {
        return view('admin.devices.update', compact('device'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Device $device
     * @return RedirectResponse
     */
    public function update(Device $device, Request $request): RedirectResponse
    {
        //How do we integrate this validated sequence
        //if validated ?
        $validated = $request->validate([
            'name'=>'required',
            'address'=>'required'
        ]);



        $device->name = $request->name;
        $device->address = $request->address;

        $device->save();

        return redirect()->route('devices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Device $device
     * @return RedirectResponse
     */
    public function destroy(Device $device): RedirectResponse
    {
        $device->delete();
        return redirect()->route('devices.index');
    }
}
