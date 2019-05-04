<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Livros;

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

Route::get('/usuarios', function (Request $request) {
    
    $users = User::all();
    return $users;
    
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

Route::delete('/deleteusuario/{id}', function ($id) {

    User::find($id)->delete();

});

Route::get('/usuario/{id}', function ($id) {

    return User::find($id);

});

Route::post('/update-usuario', function (Request $request) {

    $data = $request->all();
    $teste = false;

    if($user = User::all()->where('email', $data['email'])->first()){
        
        if($user->id != $data['id']){

            return "Email ja existe";
    
        }else{
    
            User::find($data['id'])->update([

                'name' => $data['name'],
                'email' => $data['email'],
                'tipo' => $data['tipo'],
                'endereco' => $data['endereco'],
                'telefone' => $data['telefone'],
                'cpf' => $data['cpf'],
        
            ]);
    
        }

    }else{
        
        User::find($data['id'])->update([

            'name' => $data['name'],
            'email' => $data['email'],
            'tipo' => $data['tipo'],
            'endereco' => $data['endereco'],
            'telefone' => $data['telefone'],
            'cpf' => $data['cpf'],
    
        ]);

    }

    $validacao = Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'tipo' => ['required', 'string'],
        'endereco' => ['string'],
        'telefone' => ['string'],
        'cpf' => ['string']
    ]);

    if($validacao->fails()){
        return $validacao->errors();
    }

    

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

Route::post('/cadastro', function(Request $request) {

    $data = $request->all();

    $validacao = Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
        'tipo' => ['required', 'string'],
        'endereco' => ['string'],
        'telefone' => ['string'],
        'cpf' => ['string']
    ]);

    if($validacao->fails()){
        return $validacao->errors();
    }

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'tipo' => $data['tipo'],
        'endereco' => $data['endereco'],
        'telefone' => $data['telefone'],
        'cpf' => $data['cpf']
    ]);

    $user->token = Hash::make($data['email']);

    return $user;

});

Route::post('/login', function (Request $request) {

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

