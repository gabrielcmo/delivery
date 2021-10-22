<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use App\Models\Endereco;

class UserController extends Controller
{
    public function update(Request $request){
        $user = Auth::user();

        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'cpf', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'cidade' => ['string'],
            'rua' => ['string'],
            'bairro' => ['string'],
            'numero' => ['integer']
        ]);

        if(Auth::user()->role->id !== 2){
            $data['role_id'] = 1;
        }

        $user->name = $data['name'];
        $user->cpf = $data['cpf'];
        $user->role_id = $data['role_id'];
        $user->email = $data['email'];

        if($user->endereco == null){
            Endereco::create([
                'user_id' => $user->id,
                'cidade' => $data['cidade'],
                'rua' => $data['rua'],
                'bairro' => $data['bairro'],
                'numero' => $data['numero']
            ]);
        }else{
            $endereco = Endereco::all()->where('user_id', $user->id)->first();
            $endereco->cidade = $data['cidade'];
            $endereco->rua = $data['rua'];
            $endereco->bairro = $data['bairro'];
            $endereco->numero = $data['numero'];

            $endereco->save();
        }

        $user->save();

        return redirect('/')->with('success', 'Informações atualizadas com sucesso!');
    }
}
