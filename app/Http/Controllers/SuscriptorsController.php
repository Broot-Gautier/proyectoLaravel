<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Suscriptor;
use Illuminate\Support\Facades\Redirect;


class SuscriptorsController extends Controller
{
    public function index()
    {
        $suscriptors = User::all();
        return View('suscriptors.index')->with('suscriptores', $suscriptors);
    }

  	public function suscritos()
    {
        $suscritos = Suscriptor::where('user_id','=',Auth::id());
        return View('suscriptors.suscriptores')->with('suscritos',$suscritos);
    }

    public function news()
    {
       $usuarios = User::all();
        $suscripcion = new Suscriptor();
        return  View('suscriptors.save')->with('usuarios',$usuarios)->with('suscripcion',$suscripcion)->with('method','POST');
    }

}
