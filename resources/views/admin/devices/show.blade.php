<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show specific device') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Your View Table here-->

                <h2>Showing selected device</h2>
                <h3>{{$device->id}}</h3>
                <h3>{{$device->address}}</h3>
                <h3>{{$device->updated_at}}</h3>
                <h3>{{$device->created_at}}</h3>
            </div>
        </div>
    </div>
</x-app-layout>
