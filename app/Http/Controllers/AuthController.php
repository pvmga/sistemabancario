<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        $title = 'Login - MiniBank';
        return view('login', compact('title'));
    }

    public function register()
    {
        $title = 'Cadastro - MiniBank';
        return view('register', compact('title'));
    }

    public function loginSubmit(Request $request)
    {

        $request->validate(
            [
                'text_email' => 'required|email',
                'text_password' => 'required|min:6|max:200'
            ],
            [
                'text_email.required' => 'O usuário é obrigatorio',
                'text_email.email' => 'Usuário deve ser um email válido',
                'text_password.required' => 'O senha é obrigatorio',
                'text_password.min' => 'O senha deve ter pelo menos :min caracteres',
                'text_password.max' => 'O senha deve ter no máximo :max caracteres'
            ]
        );

        $email = $request->input('text_email');
        $password = $request->input('text_password');

        // check if user exists
        $user = User::where('email', $email)
            ->where('deleted_at', NULL)
            ->first();

        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Email ou senha incorretos.');
        }

        // check if password is correct
        if (!password_verify($password, $user->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Email ou senha incorretos.');
        }

        // update last login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        $id = Operations::encryptId($user->id);

        // login user
        session([
            'user' => [
                'id' => $id,
                'email' => $user->email,
                'name' => $user->name,
                'account' => $user->account,
                'balance' => $user->balance // For now it is displayed as session, but this data must be retrieved every time the page is refreshed.
            ]
        ]);

        return redirect()->route('dashboard');
    }

    public function logout() {
        session()->forget('user');
        return redirect()->to('');
    }
}
