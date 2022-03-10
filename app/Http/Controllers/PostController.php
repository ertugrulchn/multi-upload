<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Managers\FileUploadManager;
use App\Http\Requests\CreatePostRequest;

class PostController extends Controller {

    public function index() {
        $posts = Post::with('images')->orderByDesc('id')->paginate();

        return view('list', compact('posts'));
    }

    public function edit(Post $post) {
        $post->load('images');

        return view('editor', compact('post'));
    }

    public function create() {
        return view('editor', ['post' => new Post()]);
    }

    public function store(CreatePostRequest $request) {
        $data = $request->validated();

        $post = Post::create($data + ['user_id' => \Auth::id()]);
        $images = FileUploadManager::multiple($request, 'files', $post);

        return response()->json([
            'post' => $post,
            'images' => $images,
        ]);
    }

}
