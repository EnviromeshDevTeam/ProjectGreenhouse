<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show specific timestamp or device ID?') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table>
                    <tr>
                        <td>Device</td>
                        <td>{{$data->device_id}}</td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>{{$data->category_id}}</td>
                    </tr>
                    <tr>
                        <td>Value</td>
                        <td>{{$data->data}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
