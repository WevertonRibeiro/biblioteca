<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class UserController extends Controller{
    
    public function getUsuarios(Request $request){

        return User::all();

    }

    public function getUsuario($id){

        return User::find($id);

    }

    public function deleteUsuario($id){

        User::find($id)->delete();
        return User::all();

    }

    public function cadastroUsuario(Request $request){

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

    }

    public function updateUsuario(Request $request){

        $data = $request->all();
        $teste = false;

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

    }

}
