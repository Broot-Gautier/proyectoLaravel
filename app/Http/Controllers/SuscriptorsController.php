<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Suscriptor;
use Illuminate\Support\Facades\Redirect;


class SuscriptorsController extends Controller
{
	    public function __construct()
    {
        $this->middleware('auth');
    }


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
        //return Redirect::to('suscriptors/news');
        return  View('suscriptors.save')->with('usuarios',$usuarios)->with('suscripcion',$suscripcion)->with('method','POST');
    }

	public	function consulta_seguimiento(Request $request)
		{
			$id=$request->id;
		    $where['id']=$this->input->post('id');
		    if($consulta)
		    {
		            $data['success']=true;
		            $data['mensaje']='Ahora estas siguiendo a este usuario';

		    }
		    else
		    {
		            $data['success']=False;
		            $data['mensaje']='Ya estas siguiendo a este usuario';
		    }
		            echo json_encode($data);

		}

}
