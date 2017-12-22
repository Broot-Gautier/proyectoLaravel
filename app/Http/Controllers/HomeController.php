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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = User::find(Auth::id());
        $siguiendo = Suscriptor::where('suscriptor_id',$usuario->id)->get();
        //echo count($siguiendo);
        $suscritos = []; //este es un arreglo con cada post de cada usuarioq ue sigo
        $contador = 0;
        if(count($siguiendo)>0)
        {
            foreach ($siguiendo as $seguido ) {
                //echo $seguido->user_id;
                echo 'br <br>';
                $consulta = Post::where('user_id', $seguido->user_id)->get();
                if(count($consulta)!=0)
                {
                    $consulta['name_id'] = User::find($seguido->user_id)->name;
                    $suscritos[$contador] = $consulta;
                    echo $suscritos[$contador];
                    $contador+=1;
                }
            }
        }
        //$posts = Post::where()
        return view('home')->with('username',$usuario->name)->with('suscritos',$suscritos);
    }
}
