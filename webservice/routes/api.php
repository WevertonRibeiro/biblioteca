<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Livros;
use App\Reservas;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/usuarios', 'UserController@getUsuarios');
Route::get('/usuario/{id}', 'UserController@getUsuario');
Route::delete('/deleteusuario/{id}', 'UserController@deleteUsuario');
Route::post('/update-usuario', 'UserController@updateUsuario');
Route::post('/cadastro', 'UserController@cadastroUsuario');
Route::post('/login', function (Request $request){

    $data = $request->all();

    $validacao = Validator::make($data, [

        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string'],

    ]);

    if($validacao->fails()){

        return $validacao->errors();

    }

    if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){

        $user = auth()->user();
        $user->token = Hash::make($data['email']);
        return $user;

    }else{

        return ['status'=>false];

    }

});

Route::post('/reservar/livro', function (Request $request) {
    
    $data = $request->all();

    $reservas = User::find($data['userId'])->reservas()->create([
        'livro_id' => $data['livroId'],
        'status' => $data['status']
    ]);

    Livros::find($data['livroId'])->update([

        'status' => 'R',

    ]);
    
});

Route::get('/reservas/{id}', function ($id) {

    return $reservas = DB::table('reservas')
            ->where('user_id', $id)
            ->leftJoin('livros', 'reservas.livro_id', '=', 'livros.id')
            ->get();
    
});

Route::post('/cancelar/reserva', function (Request $request) {

    $data = $request->all();

    Livros::find($data['livroId'])->update([
        'status' => 'D'
    ]);

    return $data['reservaId'];
    
});

Route::delete('/delete/reserva/{id}', function ($id) {

    $reserva = DB::table('reservas')
        ->where('livro_id', $id)
        ->delete();
    
});

Route::get('/livros', function (Request $request) {
    
    $livros = Livros::all();
    return $livros;
    
});

Route::get('/livro/{id}', function ($id) {
    
    return Livros::find($id);
    
});

Route::post('/livro/update', function (Request $request) {
    
    $data = $request->all();

    Livros::find($data['id'])->update([

        'titulo' => $data['titulo'],
        'descricao' => $data['descricao'],
        'ano' => $data['ano'],
        'autor' => $data['autor'],
        'editora' => $data['editora'],
        'status' => $data['status'],
        'imagem' => $data['imagem']

    ]);

    return "Livro Atualizado com sucesso!";
    
});

Route::delete('/livro/delete/{id}', function ($id) {

    Livros::find($id)->delete();

    return Livros::all();

});

Route::post('/cadastro/livro', function(Request $request) {

    $data = $request->all();

    $validacao = Validator::make($data, [

        'titulo' => ['required', 'string', 'max:255'],
        'descricao' => ['required', 'string', 'max:255'],
        'ano' => ['required', 'string'],
        'autor' => ['required', 'string'],
        'editora' => ['string']
        
    ]);

    if($validacao->fails()){
        return $validacao->errors();
    }

    Livros::create([
        'titulo' => $data['titulo'],
        'descricao' => $data['descricao'],
        'ano' => $data['ano'],
        'autor' => $data['autor'],
        'editora' => $data['editora'],
        'status' => $data['status'],
        'imagem' => $data['imagem']
    ]);

    return "Livro Adicionado com sucesso!";

});

