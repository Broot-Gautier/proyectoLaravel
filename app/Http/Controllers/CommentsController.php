<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Suscriptor;
use App\Comment;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{
	//para cargar la vista de crear comentario
	public function create($post_id,$id_perfil)
	{
		$comentario = new Comment();
		$comentario->post_id = $post_id;
		return View('posts.comment')
				->with('comentario',$comentario)
				->with('id_perfil',$id_perfil)
				->with('method','POST');
	}

    public function comentar()
    {
        $comentario = new Comment();
        return View('posts.comment')
            ->with('comentario', $comentario)
            ->with('method','POST');
    }
    public function store($post_id,$id_perfil) //request debiera ser post id
    {
        //Crear nuevo comentario.
        //var_dump($post_id);
        var_dump($_POST);
        echo $_POST['comentario'];
        $comment=$_POST['comentario'];
        if ($comment)
        {
		        $comentario = new Comment();
        		$comentario->post_id = $post_id;
        		$comentario->user_id = Auth::id();
        		$comentario->comentario = $comment;
        		$comentario->save();
        		return Redirect::to('perfil/'.$id_perfil)->with('notice','Comentario guardado correctamente. =)');
        }
        else
        {

        }
        exit;
        //redirigir a lista de posts
    }
}
