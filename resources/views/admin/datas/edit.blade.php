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
                <form class="form-group" method="POST" action="{{route('data.update',$data)}}">
                    @csrf
                    @method('PUT')
                    <label for="name">Device</label>
                    <select name="device_id">
                        @foreach($devices as $item)
                            @if($item->id == $data->device_id)
                                <option selected="{{$item->id}}" value="{{$item->id}}">{{$item->address}}</option>
                            @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select><br>
                    <label>Category</label>
                    <select name="category_id">
                        @foreach($category as $point)
                            @if($point->id == $data->category_id)
                                <option selected value="{{$point->id}}">{{$point->name}}</option>
                            @else
                                <option value="{{$point->id}}">{{$point->name}}</option>
                            @endif
                        @endforeach
                    </select><br>
                    <label>Value</label>
                    <Input type="number" name="data" value="{{$data->data}}"><br>
                    <a class="btn btn-danger" href="./">back</a>
                    <button class="btn btn-success" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
