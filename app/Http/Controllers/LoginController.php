<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Login
    public function index()
    {
        // Carregar a VIEW
        return view('login.index');
    }

    //validar os dados do usuário no login
    public function loginProcess(LoginRequest $request)
    {
        //validar o formulário
        $request->validated();
        
        //VALIDAR O USUÁRIO E SENHA COM AS INFORMAÇÕES DO BD (email igual ao do bd e email igual ao formulário)
       $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

       //validar se o usuário foi autenticado
        if(!$authenticated)
        {
            //se as credenciais estiver incorretos: redirecionar o usuário para pagina "login", enviar a msg de erro
            return back()->withInput()->with('error', 'E-mail ou senha inválido!');
        }
            //Se as credencias estão corretas, redirecionar o usuário
            return redirect()->route('dashboard.index');

    }
    //Deslogar o usuário
    public function destroy(){
        //Deslogar usuário
        Auth::logout();
        //Redirecionar o usuáiro, enviar a mgs de sucesso
        return  redirect()->route('login.index')->with('success', 'Deslogado com sucesso!');
    }
}
