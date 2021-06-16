<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Existing Device!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Your View Table here-->

                <!--NO ID assuming autoIncrementing-->

                <!--TODO: THIS WILL PROBABLY NOT WORK-->
                <form id="devicesUpdateForm" method="POST" action="{{route('devices.update', $device)}}">
                    @csrf
                    @method('PUT')
                    <label for="name">Enter Updated Device Name Here:</label>
                    <input id="name" name="name" type="text" value="Environment 1 Device">

                    <label for="address">Enter Updated MAC Address Here:</label>
                    <input id="address" name="address" type="text" value="example = 00:1B:44:11:3A:B7">
                    <input type="submit">
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
