<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags= Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'exists:categories,id|nullable',
            'title'=> 'required| string| max:255',
            'content'=> 'required|string',
            'cover'=>'max:5000|nullable| mimes:jpeg,jpg,png,bmp,gif,svg',
            'tag_ids.*'=>'exists:tags,id'
        ]);

        
        $data = $request->all();

        $cover = NULL;
        if(array_key_exists('cover', $data)){
            $cover = Storage::put('uploads', $data['cover']);
        }
        
        $post = new Post();

        $post->fill($data);
        $post->slug= $this->genSlag($post->title);
        $post->cover = 'storage/'. $cover;
        $post->save();

        if(array_key_exists('tag_ids', $data)){
            $post->tags()->attach($data['tag_ids']);
        }

        Mail::to('post@add.gmail.it')->send(new SendNewMail());
        
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories= Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=> 'required| string| max:255',
            'content'=> 'required|string',
            'cover'=>'max:5000|nullable| mimes:jpeg,jpg,png,bmp,gif,svg',
            'tag_ids.*'=>'exists:tags,id'
        ]);
        $data = $request->all();
        $data['slug']= $this->genSlag($data['title'], $post->title != $data['title'], $post->slug);

        if(array_key_exists('cover', $data)){
            $cover = Storage::put('uploads', $data['cover']);
            $data['cover'] = 'storage/'. $cover;
        }

        $post->update($data);

        if(array_key_exists('tag_ids', $data)){
            $post->tags()->sync($data['tag_ids']);
        }else{
            $post->tags()->detach();
        }
        
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }

    private function genSlag(string $title, bool $changed = true, string $old_slug = ''){
        

        if(!$changed){
            return $old_slug;
        }
        $slug = Str::slug($title, '-');
        $slug_base=$slug;
        $counter= 1;
        $post_with_slug = Post::where('slug', '=', $slug)->first();
        while($post_with_slug){
            $slug = $slug_base . '-' . $counter;
            $counter++;

            $post_with_slug = Post::where('slug', '=', $slug)->first();
        }
        
        return $slug;
        
    }
}
