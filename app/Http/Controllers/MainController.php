<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard()
    {
        $title = 'MiniBank Dashboard';

        $user = Operations::getUser();

        $transactions = Transaction::where('user_id', $user->id)->get();
        $transactions2 = Transaction::where('conta_corrente_destino', $user->account)->get();

        return view('dashboard', compact('title', 'user', 'transactions', 'transactions2'));
        // Both the top and bottom views are correct, but the one that is not commented is clearer when we have many variables being sent to the view.
        // return view('dashboard', compact('title'), ['user' => $user]);
    }

    public function editUser()
    {
        $id = Operations::decryptId(session('user.id'));

        if ($id == null) {
            return redirect()->route('dashboard');
        }

        $user = Operations::getUser();

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

    public function editUserSubmit(Request $request)
    {

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
        ]);

        $user = Operations::getUser();

        // update
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Senha atualizada com sucesso!');
    }

    // public function newTransfer(Request $request)
    // {

        // check account == '' / account == null | check value == '' / value = null or value < 1
        // if (!$request->filled('text_account') or !$request->filled('text_value') or $request->text_value < 1){
        //     return redirect()
        //         ->back()
        //         ->withInput()
        //         ->with('newTransferError', 'Dados invalidos');
        // }

        // check destination account
        // $user_account = User::where('account', $request->text_account)->first();
        // if ($user_account == null || $user->account = '') {
        //     return redirect()
        //         ->back()
        //         ->withInput()
        //         ->with('newTransferError', 'Conta inexistente');
        // }

        // formatar antes de realizar a validação
        // $request->merge([
        //     'text_value' => str_replace(',', '.', $request->text_value)
        // ]);
    // }

    public function newSaqueAndDepositoAndTransfer(Request $request) {
        $user = Operations::getUser();
        
        
        if ($request->text_type == 'Deposito') {
            $value = Operations::getValueFormater($request->text_deposit);
            $user->balance = floatval($user->balance) + floatval($value);
            $request->validate([
                'text_type' => 'required|in:Deposito,Saque,Transferencia,Recebida',
                'text_deposit' => 'required|min:0.01',
            ]);
            $account = $request->text_account_deposit;
        }

        if ($request->text_type == 'Saque') {
            $value = Operations::getValueFormater($request->text_sake);
            $user->balance = floatval($user->balance) - floatval($value);
            $request->validate([
                'text_type' => 'required|in:Deposito,Saque,Transferencia,Recebida',
                'text_sake' => 'required|min:0.01',
            ]);
            $account = $request->text_account_sake;
        }

        if ($request->text_type == 'Transferencia') {
            
            $request->validate(
                [
                    'text_type' => 'required|in:Deposito,Saque,Transferencia,Recebida',
                    'text_value' => 'required|min:0.01', // Garantir que o valor seja numérico e positivo
                    'text_account' => 'required|exists:users,account', // Verifica se a conta existe na tabela users
                ],
                [
                    'text_account.exists' => 'Conta inexistente'
                ]
            );
                
            $value = Operations::getValueFormater($request->text_value);
            // check account and value
            if (floatval($value) >= floatval($user->balance)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('newTransferError', 'Saldo insuficiente');
            }

            $account = $request->text_account;

            // user destino + acrescentado valor saldo
            $user_destino = User::where('account', $account)->first();
            $user_destino->balance = floatval($user_destino->balance) + floatval($value);
            $user_destino->save();

            // create trasaction - destination
            Transaction::create([
                'tipo_transacao' => 'Recebida',
                'valor' => $value,
                'conta_corrente_destino' => $account,
                'user_id' => $user_destino->id
            ]);

            // decrease balance
            $user->balance = floatval($user->balance) - floatval($value);
        }
        
        
        try {
            
            // create trasaction
            Transaction::create([
                'tipo_transacao' => $request->text_type,
                'valor' => $value,
                'conta_corrente_destino' => $account,
                'user_id' => $user->id
            ]);
                        
            $user->save();
        } catch (QueryException $e) {
            // Captura de exceção específica do banco de dados
            return back()->with('error', 'Erro ao realizar transação: ' . $e->getMessage());
        } catch (\Throwable $th) {
            // Captura de qualquer outro erro inesperado
            return back()->with('error', 'Erro desconhecido: ' . $th->getMessage());
        }

        // redirect view
        return redirect()->back()->with('success', 'Transação criada com sucesso!');

    }
}
