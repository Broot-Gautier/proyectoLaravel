<?php
Use App\User;
Use App\Suscriptor;
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

Route::get('/home', 'HomeController@index')->name('home');

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
	$consulta = Suscriptor::where('suscriptor_id',$usuario); //busca los usuarios que sigue este usuario

	foreach ($consulta as $suscriptor => $user_id) {
		echo $suscriptor;
	}
	echo count($consulta);
	echo $consulta->find(1);
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
	return view('tester',['usuario'=>$usuario,'aseguir'=>$aseguir,'consulta' => $consulta->find(1)]);
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