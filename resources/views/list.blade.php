<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td>{{$post->images->count()}} Görsel</td>
                                <td><a href="{{route('posts.edit',['post'=>$post])}}">Edit</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                {!! $posts->links() !!}
            </div>
        </div>
    </div>
</x-app-layout>
