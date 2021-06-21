<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Show specific device') }}
            </h2>

            <a class="btn btn-secondary" href="{{route('devices.index')}}">Exit</a>
        </div>
    </x-slot>

    <div class="container card bg-dark border border-warning" style="width:21rem;">
        <img class="card-img-top"
             src="https://i.all3dp.com/cdn-cgi/image/fit=cover,w=1284,h=722,gravity=0.5x0.5,format=auto/wp-content/uploads/2020/10/20112249/Raspberry-Pi-Projects.jpeg"
             alt="rasp pi breadboard">
        <div class="card-body text-light">
            <!--Your View Table here-->
            <h2 class="card-title">Showing {{$device->name}}</h2>
            <p class="card-subtitle mb-2 text-muted">ID: {{$device->id}}</p>
            <p class="card-text">Mac Address: {{$device->address}}</p>
            <p class="card-text">Last Updated on: {{$device->updated_at}}</p>
            <p class="card-text">Created at: {{$device->created_at}}</p>
        </div>
    </div>
</x-app-layout>
