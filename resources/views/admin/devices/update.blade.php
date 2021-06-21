<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Existing Device!') }}
            </h2>

            <a class="btn btn-secondary" href="{{route('devices.index')}}">Exit</a>
        </div>
    </x-slot>

    <!--Your View Table here-->

    <!--NO ID assuming autoIncrementing-->

    <form class="container p-3 card bg-dark" style="width:20rem;" id="devicesUpdateForm" method="POST"
          action="{{route('devices.update', $device)}}">
        @csrf
        @method('PUT')

        <div class="text-light form-group">
            <label for="name">Enter Updated Device Name Here:</label>
            <input id="name" name="name" type="text" placeholder="Environment 1 Device">
        </div>
        <div class="text-light form-group">
            <label for="address">Enter Updated MAC Address Here:</label>
            <input id="address" name="address" type="text" placeholder="example = 00:1B:44:11:3A:B7">
        </div>
        <input class="btn btn-primary" type="submit">
    </form>

</x-app-layout>
