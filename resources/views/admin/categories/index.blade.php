<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Data') }}
        </h2>
        <a class="btn btn-primary" href="{{route('categories.create')}}">Create New Category</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Your View Table here-->

                <!--div.mt-8.mx-auto>table.w-100>tr>(th*4)Press TAB after the bracket to get a basic table with 4 headers -->

                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Dataname</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    @forelse($categories as $category)
                        <tr>
                            <td class="text-center">{{$category->id}}</td>
                            <td class="text-center">{{$category->dataname}}</td>

                            <td>
                                <form action="{{route('categories.show', $category)}}">
                                    @csrf
                                    @method('GET')
                                    <button class="w-100 btn btn-success" type="submit">VIEW</button>
                                </form>
                            </td>

                            <td>
                                <form action="{{route('categories.edit', $category)}}">
                                    @csrf
                                    @method('GET')
                                    <button class="w-100 btn btn-warning" type="submit">UPDATE</button>
                                </form>
                            </td>
                            <td>

                                <!--Delete func for specific device-->
                                <form method="POST" action="{{route('categories.destroy', $category)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-100 btn btn-danger" type="submit">DELETE</button>
                                </form>
                            </td>
                            @empty
                                <p>'No Devices found!' <a href="{{route('categories.create')}}">Click here to add a
                                        new Category</a></p>
                            @endforelse
                        </tr>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
