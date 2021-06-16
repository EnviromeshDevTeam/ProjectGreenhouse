<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Your View Table here-->

                <!--NO ID assuming autoIncrementing-->

                <form id="categoryCreateForm" method="POST" action="{{route('categories.store')}}">
                    @method('POST')
                    @csrf
                    <label for="dataname">Enter Name of Category Here:</label>
                    <input id="dataname" name="dataname" type="text" value="RADS">
                    <input type="submit">
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
