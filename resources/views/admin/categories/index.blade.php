<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Your View Table here-->

                <form action="{{route('categories.create')}}">
                    @method('GET')
                    @csrf
                    <button class="button button-primary" type="submit">CREATE NEW CATEGORY</button>
                </form>

                <!--div.mt-8.mx-auto>table.w-100>tr>(th*4)Press TAB after the bracket to get a basic table with 4 headers -->
                <div class="mt-8 mx-auto">
                    <table class="w-100">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                        </tr>

                        @forelse($categories as $category)
                            <tr>
                                <td class="text-center">{{$category->id}}</td>
                                <td class="text-center">{{$category->name}}</td>

                                <td class="flex justify-center">

                                    <!--Show func for specific device-->

                                    <form action="{{route('categories.show', $category)}}">
                                        @csrf
                                        @method('GET')
                                        <button class="button button-primary" type="submit">VIEW</button>
                                    </form>

                                    <form action="{{route('categories.edit', $category)}}">
                                        @csrf
                                        @method('GET')
                                        <button class="button button-primary" type="submit">UPDATE</button>
                                    </form>

                                    <!--Delete func for specific device-->
                                    <form method="POST" action="{{route('categories.destroy', $category)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button button-red" type="submit">DELETE</button>
                                    </form>

                                    <!--If Array empty-->
                                    @empty
                                        <p>'No Devices found!' <a href="{{route('categories.create')}}">Click here to add a new Category</a></p>
                                    @endforelse
                                </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
