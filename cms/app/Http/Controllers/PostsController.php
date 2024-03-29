<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::list();

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
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();

        if ($file = $request->file('file')){

            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $input['path'] = $name;

        }

        Post::create($input);

        //filetest
//        $file = $request->file('file');
//
//        echo "<br>";
//
//        echo $file->getClientOriginalName();
//        echo $file->getClientOriginalExtension();
        //validation
//        $this->validate($request, [
//            'title' => 'required|unique:posts|max:10',
//        ]);

        //all
        // return $request->all();

        //title
        // return $request->title;

        //insert into DB
//        Post::create($request->all());
//
//        return redirect('/posts');

        // $post = new Post;
        // $post->title = $request->title;
        // $post->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrfail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/posts');
    }

    public function contact()
    {
        $users = ['User1', 'User2', 'User3', 'User4'];
        return view('contact', compact('users'));
    }

    public function show_post($id = 0, $name = 'no name', $password = 'no pass')
    {
        return view('post', compact('id', 'name', 'password'));
    }
}
