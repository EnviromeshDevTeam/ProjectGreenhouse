<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Environment Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-1">
                <a class="m-1 btn btn-success" href="data/create">Create</a>
                <form class="form-group" method="GET" action="data">
                    <select class="form-select mb-3" name="search">
                        @if(request('search') == 0)
                         <option selected value="0">none</option>
                        @else
                            <option value="0">none</option>
                        @endif
                        @foreach($category as $cat)
                            @if($cat->id == request('search'))
                                <option selected value="{{$cat->id}}">{{$cat->name}}</option>
                            @else
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit">Filter</button>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Device</th>
                            <th>Category</th>
                            <th>Value</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->device->name}}</td>
                            <td>{{$item->category->name}}</td>
                            <td>{{$item->data}}</td>
                            <td class="btn-group"><a class="btn btn-primary" href="data/{{$item->id}}">show</a>
                            <a class="btn btn-warning" href="data/{{$item->id}}/edit">edit</a>
                                <form method="POST" action="{{route('data.destroy', $item)}}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">delete</button>
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
