<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit data entry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Your View Table here-->
                <form method="PATCH" action=".">
                    <h1>To be updated when Cat and Devices are up-to-date</h1>
                    @csrf
                    <label>Device</label>
                    <select id="device_id">
                        @foreach($devices as $item)
                            @if($item->id == $data->device_id)
                                <option selected value="{{$item->id}}">{{$item->address}}</option>
                            @else
                                <option value="{{$item->id}}">{{$item->address}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label>Category</label>
                    <select id="category" >
                        @foreach($category as $point)
                            @if($point->id == $data->category_id)
                                <option selected value="{{$point->id}}">{{$point->name}}</option>
                            @else
                                <option value="{{$point->id}}">{{$point->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label>Value</label>
                    <td><Input type="number" name="data" value="{{$data->data}}"></td>
                    <a href="./">back</a>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
