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
    
	/*
	$consulta = sprintf("SELECT user_id, suscriptor_id FROM suscriptors WHERE suscriptor_id=%d ", $usuario);
	echo $consulta;
	$resultado = mysqli_query("bd18",$consulta);
	if (!$resultado) 
	{
	    $mensaje  = 'Consulta no válida: ' . mysql_error() . "\n";
	    $mensaje .= 'Consulta completa: ' . $consulta;
	    die($mensaje);
	}
	//usando el resultado
	/*while ($fila = mysql_fetch_assoc($resultado)) 
	{
	    echo $fila['user_id'];
	    echo $fila['suscriptor_id'];
	}*/
    //$suscritos = Suscriptor::all()->where('suscriptor_id','=',Auth::id());
  
  /*  echo 'suscritos' .$suscritos->user_id;
    foreach ($suscritos as $suscrito => $suscriptor_id) {
    	if ( $suscriptor_id == $aseguir)
    	{
			echo 'Ya estas suscrito a ese usuario' .$aseguir->name;
			return View('/home');
    	}
    }
	$suscripcion = new Suscriptor();
	$suscripcion->user_id=$aseguir;
	$suscripcion->suscriptor_id=Auth::id();
	$suscripcion->save();
	return View('suscriptors.save')->with('usuarios',User::all())->with('suscripcion',$suscripcion)->with('method','POST');
	//return View('suscriptors.store')->with('suscriptores',User::all());
   */
});

Route::get('suscriptors/suscritos', function()
{
	$misuscritos2 = App\Suscriptor::where('user_id',Auth::id())->select('suscriptor_id');
	$vector = $misuscritos2->get();

	echo $vector[0]->suscriptor_id;
	echo $vector[1]->suscriptor_id;
	$suscritos = [];
	$contador = 0;
	//echo $suscritos[0];
	foreach ($vector as $vec) {
		$suscritos[$contador] = User::find($vec->suscriptor_id)->name;
		echo $suscritos[$contador];
		echo '<br>';
		$contador += 1;
		//echo ' ';
	}
	return View('suscriptors/suscritos')->with('suscritos',$suscritos);
});

Route::get('YoursSuscriptions', function()
{
	$seguidores = App\Suscriptor::where('suscriptor_id',Auth::id())->select('user_id')->get();
	//$vector = $seguidores->get();
	echo $seguidores[0]->user_id;
	echo '<br>';
	echo $seguidores[1]->user_id;

	$siguiendo = [];
	$contador = 0;
	foreach ($seguidores as $vec) {
		$siguiendo[$contador] = User::find($vec->user_id)->name;
		echo $siguiendo[$contador];
		echo '<br>';
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
	$siguiendome = count($consulta);
	$posts = $usuario->posts;
	return View('profile/otherProfiles')->with('posts',$posts)->with('cantidadSeguidores',$siguiendome)->with('usuario',$usuario);
});