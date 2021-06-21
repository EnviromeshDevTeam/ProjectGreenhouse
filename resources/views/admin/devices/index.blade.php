<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Device Data') }}
            </h2>
            <a class="btn btn-primary" href="{{route('devices.create')}}">Create New Device</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Your View Table here-->

                <!--div.mt-8.mx-auto>table.w-100>tr>(th*4)Press TAB after the bracket to get a basic table with 4 headers -->
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="thead-dark">
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Updated_At</th>
                        <th class="text-center">Created_At</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    @forelse($devices as $device)
                        <tr>
                            <td class="text-center">{{$device->id}}</td>
                            <td class="text-center">{{$device->name}}</td>
                            <td class="text-center">{{$device->address}}</td>
                            <td class="text-center">{{$device->updated_at}}</td>
                            <td class="text-center">{{$device->created_at}}</td>

                            <td>
                                <!--Show func for specific device-->

                                <form action="{{route('devices.show', $device)}}">
                                    @method('GET')
                                    @csrf
                                    <button class="w-100 btn btn-success" type="submit">VIEW</button>
                                </form>

                            </td>
                            <td>
                                <form action="{{route('devices.edit', $device)}}">
                                    @method('GET')
                                    @csrf
                                    <button class="w-100 btn btn-warning" type="submit">UPDATE</button>
                                </form>
                            </td>
                            <td>
                                <!--Delete func for specific device-->
                                <form method="POST" action="{{route('devices.destroy', $device)}}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="w-100 btn btn-danger" type="submit">DELETE</button>
                                </form>
                            </td>

                            <!--If Array empty-->
                            @empty
                                <p>'No Devices found!' <a href="{{route('devices.create')}}">Click here to add a new
                                        Device</a></p>
                            @endforelse

                        </tr>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
