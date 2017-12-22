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
//Route::get('/comentar/{id_post}','CommentsController@comentar');

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
	//var_dump($consulta);
	//$users = DB::table('users')->where('votes', '>', 100)->get();
	if(count($consulta->first()) == 0) //si(no contiene datos)
	{
		echo 'asegiur:';
		echo $aseguir;
		echo 'usr:';
		echo $usuario;
		$suscripcion = new Suscriptor();
		$suscripcion->user_id=$aseguir;
		$suscripcion->suscriptor_id=$usuario;
		$suscripcion->save();
		return view('tester',['usuario'=>$usuario,'aseguir'=>$aseguir]);
	}
	else
		{		
			echo 'dos';
			echo count($consulta);
			echo count($consulta->first());
			return view('tester',['usuario'=>$usuario,'aseguir'=>$aseguir]);
		}
});

Route::get('suscriptors/suscritos', function()
{
	$misuscritos2 = App\Suscriptor::where('user_id',Auth::id())->select('suscriptor_id');
	$vector = $misuscritos2->get();

	//echo $vector[0]->suscriptor_id;
	//echo $vector[1]->suscriptor_id;
	$suscritos = [];
	$contador = 0;
	//echo $suscritos[0];
	foreach ($vector as $vec) {
		$suscritos[$contador] = User::find($vec->suscriptor_id);//->name;
	//	echo $suscritos[$contador];
	//	echo '<br>';
		$contador += 1;
		//echo ' ';
	}
	return View('suscriptors/suscritos')->with('suscritos',$suscritos);
});

Route::get('YoursSuscriptions', function()
{
	$seguidores = App\Suscriptor::where('suscriptor_id',Auth::id())->select('user_id')->get();
	//$vector = $seguidores->get();
	//echo $seguidores[0]->user_id;
	//echo '<br>';
	//echo $seguidores[1]->user_id;

	$siguiendo = [];
	$contador = 0;
	foreach ($seguidores as $vec) {
		$siguiendo[$contador] = User::find($vec->user_id);
	//	echo $siguiendo[$contador];
	//	echo '<br>';
		$contador += 1;
	}
	return View('suscriptors/suscriptores')->with('suscritos',$siguiendo);
});

Route::get('perfil',function()
{
	$usuario = User::find(Auth::id());
	echo $usuario->name;
	echo "<br>";
	echo $usuario->email;
	echo "<br>";
	echo $usuario->cantSeguidores;
	echo "<br>";
	echo $usuario->cantSeguidos;
	//cant de seguidores que posee(que lo siguen)
	$consulta = App\Suscriptor::where('user_id',$usuario->id)->select('suscriptor_id')->get();
	$siguiendome = count($consulta);
	echo $consulta->first();
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
	//echo $posts;
	//tengo problema: es que posts es un arreglo, y pueden haber muchos
	//$comentarios=Comments::where('post_id',$posts->id)->select(id);
	$salida=Array();
	foreach($posts as $key) 
	{
			$resultado=array();
			$resultado['id']=$key->id;
			$resultado['titulo']=$key->titulo;
			$resultado['descripcion']=$key->descripcion;
/*			echo '<br>';
			echo $key->id;
			echo '<br>';
*/			
			$comentarios=App\Comment::where('post_id',$key->id)->select('comentario','id')->get();
			$comm=array();
/*			echo '<br>';
			echo $comentarios->find(1);
			echo '<br>';
*/			foreach ($comentarios as $key2 ) 
				{
//					var_dump(($key));
//					echo'<br>';
						//$comm[]=$key2->id;
						$comm[]=$key2->comentario;
				}
			//var_dump($comm);
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