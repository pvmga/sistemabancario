<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard()
    {
        $title = 'MiniBank Dashboard';

        $id = Operations::decryptId(session('user.id'));
        $user = User::where('id', $id)->first();

        return view('dashboard', compact('title', 'user'));
        // Both the top and bottom views are correct, but the one that is not commented is clearer when we have many variables being sent to the view.
        // return view('dashboard', compact('title'), ['user' => $user]);
    }

    public function editUser()
    {
        $id = Operations::decryptId(session('user.id'));
        
        if ($id == null) {
            return redirect()->route('dashboard');
        }

        $user = User::find($id);
        
        return view('edit_user', ['user' => $user]);
    }

    public function newUser(Request $request) 
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'name.min' => 'O nome deve ter no mínimo :min caracteres.',
            'email.email' => 'O e-mail deve ser válido.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
        ]);
        

        $id = Operations::decryptId(session('user.id'));

        // update
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->account = rand(1, 2999);
        $user->balance = rand(150.00, 3505.00);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Usuario criado com sucesso!');
    }

    public function editUserSubmit(Request $request) {

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
        ]);

        $id = Operations::decryptId(session('user.id'));
        $user = User::find($id);

        // update
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Senha atualizada com sucesso!');
    }
}
