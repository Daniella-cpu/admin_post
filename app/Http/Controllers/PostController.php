<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function create(){

        $this->authorize('create', Post::class);

        return view('admin.post.create');
    }

    public function index(){
//        $posts = Post::all();

        $posts = auth()->user()->posts()->paginate(2);

        return view('admin.post.index', compact('posts'));
    }


    public function show($id){
        $post = Post::findOrFail($id);
        return view('blog-post', compact('post'));
    }

    public function store(){

        $this->authorize('create', Post::class);

       $inputs = request()->validate([
            'title' => 'required',
            'post_image' => ['required', 'image'],
            'body' => 'required',
        ]);

        if (request('post_image')){

            $inputs['post_image'] = request('post_image')->store('images');

        }
        auth()->user()->posts()->create($inputs);

//        $request->session()->flash('creat-post-message', 'New post was created');

        return redirect()->route('post.index');
    }



    public function edit(Post $post){

        $this->authorize('view', $post);

        return view('admin.post.edit', compact('post'));
    }

    public function update($id, Request $request){

        $post = Post::findOrFail($id);

        if ($request->post_image){

            $post->post_image = $request->post_image->store('images');

        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'post_image' => $request->post_image
        ]);

        $request->session()->flash('post-message', 'Post is updated');

        return redirect()->route('post.index');

    }

    public function delete($id, Request $request){

        $post = Post::findOrFail($id);
        $post->delete();


        $request->session()->flash('message', 'post was deleted');

        return back();
    }



//    Or you inject
//    public function show(Post $post){
//        return view('blog-post', $post)
//    }



}
