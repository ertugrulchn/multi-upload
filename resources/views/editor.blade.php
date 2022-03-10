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
                    @if($errors)
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    @endif
                    <form action="{{$post->id ? route('posts.edit',compact('post')) : route('posts.store')}}"
                          method="POST" enctype="multipart/form-data">
                        <div class="flex flex-col gap-4">
                            @if($post->images)
                                <div class="grid grid-cols-4">
                                    @foreach($post->images as $image)
                                        <img src="{{$image->url}}">
                                    @endforeach
                                </div>
                            @endif
                            <input type="text"
                                   value="{{old('title') ?? $post->title}}"
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   name="title" required placeholder="Title">
                            @error('title')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror


                            <textarea class="block" name="content" cols="30"
                                      rows="10">{{old('content') ?? $post->content}}</textarea>
                            @error('content')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror


                            <input type="file" name="files[]" id="add_files" multiple/>
                            @error('files')
                            <span class="text-red-500">{{$message}}</span>
                            @enderror


                            <input type="submit" value="SEND"/>
                            @csrf
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
