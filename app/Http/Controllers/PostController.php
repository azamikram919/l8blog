<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('thumbnail') && $request->thumbnail->isValid()) {
            $extension = $request->thumbnail->extension();
            $filename = time() . "." . $extension;
            $request->thumbnail->move(public_path('images'), $filename);

        } else {
            $filename = 'no-image.jpg';
        }


        $created = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'thumbnail' => $filename,
        ]);


        if ($created) {
            $this->validate($request, [
                'title' => 'required|unique:posts|max:255|min:5',
                'body' => 'required',
            ]);
            if ($created) {
                return redirect('posts')
                    ->with('message', 'Post Successfully Created');
            }
        }

        /*$created = Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        if ($created) {
            return redirect('/posts')
                ->with('message', 'Post Successfully Created');
        } else {
            return redirect('/posts/create')->with('message', 'Post Not Created');
        }*/

        /*$this->validate($request, [
            'title' => 'required|max:255|min:5|unique:posts',
            'body' => 'required'
        ]);
        if ($request){
            return \App\Post::create($request->all());
            return redirect('/posts');
        }*/

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts/edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->body = $request->body;

        $updated = $post->save();
        if ($updated) {
            return redirect('/posts')->with('message', 'Post Successfully Updated');
        }
    }

    public function delete($id)
    {
        //
        $post = Post::findOrFail($id);
        $image = '/images/' . $post->thumbnail;
        $path = str_replace('\\', '/', public_path());


        if (file_exists($path . $image)) {

            unlink($path . $image);
            $deleted = $post->delete();

            if ($deleted) {
                return redirect('posts')->with('message', 'Post Successfully Deleted!');
            }

        } else {
            $post->delete();
            return redirect('posts')->with('message', 'Post Not Successfully Deleted!');

        }

//        dd($path . $image);


//        $deleted = $post->delete();

//        if ($deleted) {
//            return redirect('/posts')->with('message', 'Post Successfully Deleted!');
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
