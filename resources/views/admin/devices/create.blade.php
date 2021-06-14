<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new device entry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Your View Table here-->

                <!--NO ID assuming autoIncrementing-->

                <!--TODO: THIS WILL PROBABLY NOT WORK-->
                <form method="POST" action="{{route('/store')}}">
                    @csrf
                    <label for="address">Enter Address Here:</label>
                    <input id="address" name="address" type="text" value="default">
                    <input type="submit" value="submit">
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
