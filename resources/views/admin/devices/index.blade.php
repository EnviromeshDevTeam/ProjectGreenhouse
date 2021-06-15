<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Device Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Your View Table here-->

                <!--div.mt-8.mx-auto>table.w-100>tr>(th*4)Press TAB after the bracket to get a basic table with 4 headers -->
                <div class="mt-8 mx-auto">
                    <table class="w-100">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Updated_At</th>
                            <th>Created_At</th>
                        </tr>

                        @forelse($devices as $device)
                            <tr>
                                <td class="text-center">{{$device->id}}</td>
                                <td class="text-center">{{$device->name}}</td>
                                <td class="text-center">{{$device->address}}</td>
                                <td class="text-center">{{$device->updated_at}}</td>
                                <td class="text-center">{{$device->created_at}}</td>

                                <td class="flex justify-center">

                                    <!--Show func for specific device-->
                                    <a href="./{{$device->id}}">show</a>

                                    <!--Delete func for specific device-->
                                    <form method="POST" action="{{route('devices.destroy', $device)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button class="button button-red" type="submit">DELETE</button>
                                    </form>

                                    <!--If Array empty-->
                                    @empty
                                        <p>'No Devices found!' <a href="{{route('devices.create')}}">Click here to add a new Device</a></p>
                                    @endforelse
                                </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
