<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use App\Models\Endereco;
use App\Models\User;

class UserController extends Controller
{
    public function adminUpdate(Request $request){
        $user = User::find($request->user_id);

        if($user->role->id == 1){
            $data = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'cpf' => ['required', 'cpf', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'cidade' => ['string'],
                'rua' => ['string'],
                'bairro' => ['string'],
                'numero' => ['integer']
            ]);
        }else{
            $data = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'cpf' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'cidade' => ['string', 'nullable'],
                'rua' => ['string', 'nullable'],
                'bairro' => ['string', 'nullable'],
                'numero' => ['integer', 'nullable']
            ]);
        }

        if(Auth::user()->role->id == 1){
            $data['role_id'] = 1;
        }else{
            $data['role_id'] = 2;
        }

        $user->name = $data['name'];
        $user->cpf = $data['cpf'];
        $user->role_id = $data['role_id'];
        $user->email = $data['email'];

        if($user->endereco == null && $data['rua'] !== null){
            Endereco::create([
                'user_id' => $user->id,
                'cidade' => $data['cidade'],
                'rua' => $data['rua'],
                'bairro' => $data['bairro'],
                'numero' => $data['numero']
            ]);
        }elseif($data['rua'] !== null){
            $endereco = Endereco::all()->where('user_id', $user->id)->first();
            $endereco->cidade = $data['cidade'];
            $endereco->rua = $data['rua'];
            $endereco->bairro = $data['bairro'];
            $endereco->numero = $data['numero'];

            $endereco->save();
        }

        $user->save();

        return redirect()->route('clientesView')->with('success', 'Informações atualizadas com sucesso!');
    }

    public function update(Request $request){
        $user = Auth::user();

        if($user->role->id == 1){
            $data = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'cpf' => ['required', 'cpf', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'cidade' => ['string'],
                'rua' => ['string'],
                'bairro' => ['string'],
                'numero' => ['integer']
            ]);
        }else{
            $data = $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'cpf' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'cidade' => ['string', 'nullable'],
                'rua' => ['string', 'nullable'],
                'bairro' => ['string', 'nullable'],
                'numero' => ['integer', 'nullable']
            ]);
        }

        if(Auth::user()->role->id == 1){
            $data['role_id'] = 1;
        }else{
            $data['role_id'] = 2;
        }

        $user->name = $data['name'];
        $user->cpf = $data['cpf'];
        $user->role_id = $data['role_id'];
        $user->email = $data['email'];

        if($user->endereco == null && $data['rua'] !== null){
            Endereco::create([
                'user_id' => $user->id,
                'cidade' => $data['cidade'],
                'rua' => $data['rua'],
                'bairro' => $data['bairro'],
                'numero' => $data['numero']
            ]);
        }elseif($data['rua'] !== null){
            $endereco = Endereco::all()->where('user_id', $user->id)->first();
            $endereco->cidade = $data['cidade'];
            $endereco->rua = $data['rua'];
            $endereco->bairro = $data['bairro'];
            $endereco->numero = $data['numero'];

            $endereco->save();
        }

        $user->save();

        return redirect()->back()->with('success', 'Informações atualizadas com sucesso!');
    }
}
