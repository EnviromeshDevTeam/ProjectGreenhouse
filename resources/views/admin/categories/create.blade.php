<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create new Category') }}
            </h2>
            <a class="btn btn-secondary" href="{{route('categories.index')}}">Exit</a>

        </div>
    </x-slot>

    <form class="container p-3 card bg-dark" style="width:20rem;" id="categoryCreateForm" method="POST"
          action="{{route('categories.store')}}">
        @csrf
        @method('POST')

        <div class="text-light form-group">
            <label for="dataname">Enter New Category Name Here:</label>
            <input id="dataname" name="dataname" type="text" placeholder="Carbon PPM">
        </div>
        <input class="btn btn-primary" type="submit">
    </form>
</x-app-layout>
