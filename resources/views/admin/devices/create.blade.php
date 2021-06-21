<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create new device entry') }}
            </h2>

            <a class="btn btn-secondary" href="{{route('devices.index')}}">Exit</a>
        </div>
    </x-slot>

    <form class="container p-3 card bg-dark" style="width:20rem;" id="deviceCreateForm" method="POST"
          action="{{route('devices.store')}}">
        @csrf
        @method('POST')

        <div class="text-light form-group">
            <label for="name">Enter New Device Name Here:</label>
            <input id="name" name="name" type="text" placeholder="PI 69420">
        </div>

        <div class="text-light form-group">
            <label for="address">Enter New Device Name Here:</label>
            <input id="address" name="address" type="text" placeholder="00:1B:44:11:3A:B7">
        </div>
        <input class="btn btn-primary" type="submit">
    </form>
</x-app-layout>
