<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginUserRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;

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

    public function create(){
        //carregar a view
        return view('login.create');
    }

    public function store(LoginUserRequest $request){
        //validar o formulário
        $request->validated();

        //marca o ponto inicial de uma transação
        DB::beginTransaction();
        
        try{
            //Cadastrar no bd na tabela usuários
           $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            // Salvar log
            Log::info('Usuário cadastrado.', ['id' => $user->id ]);

            //operação é concluída com êxito
            DB::commit();

            //Redirecionar o usuário, enviar a msg de sucesso
            return redirect()->route('login.index')->with('success', 'Usuário cadastrado com sucesso!');

        } catch (Exception $e) {
            //throw $th;
             // Salvar log
             Log::info('Usuário não cadastrado.', ['error' => $e->getMessage()]);

             // Operação não é concluída com êxito
             DB::rollBack();
 
             // Redirecionar o usuário, enviar a mensagem de erro
             return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }
    //Deslogar o usuário
    public function destroy(){
        //Deslogar usuário
        Auth::logout();
        //Redirecionar o usuáiro, enviar a mgs de sucesso
        return  redirect()->route('login.index')->with('success', 'Deslogado com sucesso!');
    }
}
