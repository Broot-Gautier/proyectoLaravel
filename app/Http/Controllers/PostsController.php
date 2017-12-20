<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/** para usar modelos **/
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\User;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = User::find(Auth::id())->posts;
        return View('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        return View('posts.save')
            ->with('post',$post)
            ->with('method','POST');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Crear nuevo post.
        $post = new Post();
        $post->titulo = $request->titulo;
        $post->privado = $request->privado;
        $post->descripcion = $request->descripcion;
        $post->user_id = Auth::id();
        $post->save();
        //redirigir a lista de posts
        return Redirect::to('posts')->with('notice','Publicacion guardada correctamente. =)');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where(array(
            'id' => $id,
            'user_id' => Auth::id()))->first();
        return View('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where(array(
            'id' => $id,
            'user_id' => Auth::id()))->first();
        return View('posts.save')
            ->with('post',$post)
            ->with('method','PUT');
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
         $post = Post::where(array(
            'id' => $id,
            'user_id' => Auth::id()))->first();
        $post->titulo = $request->titulo;
        $post->privado = $request->privado;
        $post->descripcion = $request->descripcion;
        $post->user_id = Auth::id();
        $post->save();
        return Redirect::to('posts')->with('notice','post guardado correctamente =)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $post = Post::where(array(
            'id' => $id,
            'user_id' => Auth::id()
        ))->first();
        $post->delete();
    }
}
