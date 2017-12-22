<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/** para usar modelos **/
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\User;
use App\Post;
use App\Suscriptor;
use App\Comment;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = User::find(Auth::id());
        $posts = $usuario->posts;
        $consulta = Suscriptor::where('user_id',$usuario->id)->select('suscriptor_id')->get();
        $siguiendome = count($consulta);
        $salida=Array();
        foreach($posts as $key) 
        {
            $resultado=array();
            $resultado['id']=$key->id;
            $resultado['titulo']=$key->titulo;
            $resultado['descripcion']=$key->descripcion;
/*          echo '<br>';
            echo $key->id;
            echo '<br>';
*/          
            $comentarios=Comment::where('post_id',$key->id)->select('comentario','id')->get();
            $comm=array();
/*          echo '<br>';
            echo $comentarios->find(1);
            echo '<br>';
*/          foreach ($comentarios as $key2 ) 
            {
//              var_dump(($key));
//              echo'<br>';
                //$comm[]=$key2->id;
                $comm[]=$key2->comentario;
            }
            //var_dump($comm);
            $resultado['comentario']=$comm;
            $salida[]=$resultado;
        }

        return View('posts.index')->with('posts',$posts)->with('cantidadSeguidores',$siguiendome)->with('usuario',$usuario)->with('resultados',$salida);
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
        $post->url = $request->url;
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
        $post = Post::where('id',$id)->get();
        echo $post;
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
        $post->url = $request->url;
        $post->user_id = Auth::id();
        $post->save();
        return Redirect::to('posts')->with('notice','Post guardado correctamente =)');
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
        return Redirect::to('posts')->with('notice','Post borrado correctamente');
    }
}
