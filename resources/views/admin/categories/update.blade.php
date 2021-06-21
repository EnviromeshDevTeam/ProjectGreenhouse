<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Existing Category!') }}
            </h2>

            <a class="btn btn-secondary" href="{{route('categories.index')}}">Exit</a>
        </div>
    </x-slot>

    <form class="container p-3 card bg-dark" style="width:20rem;" id="categoryUpdateForm" method="POST"
          action="{{route('categories.update', $category)}}">
        @csrf
        @method('PUT')

        <div class="text-light form-group">
            <label for="name">Enter Updated Category Name Here:</label>
            <input id="name" name="name" type="text" placeholder="Carbon PPM">
        </div>
        <input class="btn btn-primary" type="submit">
    </form>
</x-app-layout>
