<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new data entry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Your View Table here-->
                <form class="form-group" method="POST" action="{{route('data.store')}}">
                    @csrf
                    @method('POST')
                    <table>
                        <tr>
                            <td>Device</td>
                            <td>
                                <select id="device_id">
                                    @foreach($devices as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>
                                <select id="category" >
                                    @foreach($category as $point)
                                        <option value="{{$point->id}}">{{$point->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Value</td>
                            <td><Input type="number" name="data" value="0"></td>
                        </tr>
                        <tr>
                            <td><a href="./">back</a></td>
                            <td><button>Submit</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
