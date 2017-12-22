<?php
Use App\User;
Use App\Suscriptor;
use App\Comment;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('comentarios', 'ComentariosController');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/comentar/{id_post}/{id_perfil}','CommentsController@create');

Route::post('/comentarlo/{post_id}/{id_perfil}','CommentsController@store');

//**Definimos que solo puede ver posts un usario autentificado**//
Route::group( ['middleware'=>'auth'],function()
{
	Route::resource('/posts','PostsController');
});

Route::get('/suscribirse','SuscriptorsController@index');

Route::get('/suscriptors/news','SuscriptorsController@news');


Route::get('/newsuscripcion/{aseguir}',function($aseguir)
{
	$usuario = Auth::id();
	$consulta = Suscriptor::where('suscriptor_id',$usuario)->where('user_id',$aseguir)->get(); //busca los usuarios que sigue este usuario
	if(count($consulta->first()) == 0) //si(no contiene datos)
	{
		$suscripcion = new Suscriptor();
		$suscripcion->user_id=$aseguir;
		$suscripcion->suscriptor_id=$usuario;
		$suscripcion->save();
		return view('tester',['usuario'=>$usuario,'aseguir'=>$aseguir]);
	}
	else
		{		
			return view('tester',['usuario'=>$usuario,'aseguir'=>$aseguir]);
		}
});

Route::get('suscriptors/suscritos', function()
{
	$misuscritos2 = App\Suscriptor::where('user_id',Auth::id())->select('suscriptor_id');
	$vector = $misuscritos2->get();
	$suscritos = [];
	$contador = 0;
	foreach ($vector as $vec) {
		$suscritos[$contador] = User::find($vec->suscriptor_id);//->name;
		$contador += 1;
	}
	return View('suscriptors/suscritos')->with('suscritos',$suscritos);
});

Route::get('YoursSuscriptions', function()
{
	$seguidores = App\Suscriptor::where('suscriptor_id',Auth::id())->select('user_id')->get();
	$siguiendo = [];
	$contador = 0;
	foreach ($seguidores as $vec) {
		$siguiendo[$contador] = User::find($vec->user_id);
		$contador += 1;
	}
	return View('suscriptors/suscriptores')->with('suscritos',$siguiendo);
});

Route::get('perfil',function()
{
	$usuario = User::find(Auth::id());
	//cant de seguidores que posee(que lo siguen)
	$consulta = App\Suscriptor::where('user_id',$usuario->id)->select('suscriptor_id')->get();
	$siguiendome = count($consulta);
	//mostrar info del usuario
	//muestra posts
	$posts = $usuario->posts;
    return View('profile/perfil')->with('posts',$posts)->with('cantidadSeguidores',$siguiendome)->with('usuario',$usuario);
});

Route::get('perfil/{id}',function($id)
{
	$usuario = User::find($id);
	$consulta = App\Suscriptor::where('user_id',$usuario->id)->select('suscriptor_id')->get();
	//debier
	$siguiendome = count($consulta);
	$posts = $usuario->posts;
	$salida=Array();
	foreach($posts as $key) 
	{
			$resultado=array();
			$resultado['id']=$key->id;
			$resultado['titulo']=$key->titulo;
			$resultado['descripcion']=$key->descripcion;
			
			$comentarios=App\Comment::where('post_id',$key->id)->select('comentario','id')->get();
			$comm=array();
			foreach ($comentarios as $key2 ) 
				{
						$comm[]=$key2->comentario;
				}
			$resultado['comentario']=$comm;
			$salida[]=$resultado;

	}
	return View('profile/otherProfiles')->with('posts',$posts)->with('cantidadSeguidores',$siguiendome)->with('usuario',$usuario)->with('resultados',$salida);
});

Route::get('deletesuscripcion/{id}',function($id)
	{
		$usuario = User::find(Auth::id());
		 $suscriptor = Suscriptor::where(array(
            'suscriptor_id' => $id,
            'user_id' => $usuario->id
        ))->first();
		 $suscriptor->delete();
		//$consulta = App\Suscriptor::delete('suscriptor_id',$id)->where('user_id',$usuario->id);
		return Redirect::to('posts')->with('notice','Seguidor eliminado correctamente. =)');
	});

Route::get('dejarseguir/{id}',function($id){
	$usuario = User::find(Auth::id());
	$suscrito = Suscriptor::where(array(
			'suscriptor_id' => $usuario->id,
			'user_id' => $id
	))->first();
	$suscrito->delete();
	return Redirect::to('posts')->with('notice','Seguido eliminado correctamente. =)');
});