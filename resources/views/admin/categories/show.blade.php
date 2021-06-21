<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Show specific Category') }}
            </h2>
            <a class="btn btn-secondary" href="{{route('categories.index')}}">Exit</a>
        </div>
    </x-slot>

    <div class="container card bg-dark border border-warning" style="width:20rem;">
        {{--Maybe we can hardcode some images depending on category?--}}
        {{--<img class="card-img-top" src="https://i.all3dp.com/cdn-cgi/image/fit=cover,w=1284,h=722,gravity=0.5x0.5,format=auto/wp-content/uploads/2020/10/20112249/Raspberry-Pi-Projects.jpeg" alt="rasp pi breadboard">--}}
        <div class="card-body text-light">
            <!--Your View Table here-->
            <h2 class="card-title">{{$category->dataname}}</h2>
            <p class="card-subtitle mb-2 text-muted">ID: {{$category->id}}</p>
        </div>
    </div>
</x-app-layout>
