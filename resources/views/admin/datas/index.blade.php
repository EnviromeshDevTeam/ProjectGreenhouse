<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Environment Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table>
                    <thead>
                        <tr>
                            <th>Device</th>
                            <th>Category</th>
                            <th>Value</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{$item->device_id}}</td>
                            <td>{{$item->category_id}}</td>
                            <td>{{$item->data}}</td>
                            <td><a href="./{{$item->id}}">show</a></td>
                            <td>
                                <form method="POST" onsubmit="./{{$item->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button>delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
