<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;

class TransactionSeeders extends Seeder
{
    public function run()
    {
        $user = User::first(); // Ou criar um fake aqui também

        Transaction::create([
            'tipo_transacao' => 'Deposito',
            'valor' => 500.00,
            'conta_corrente_destino' => $user->account,
            'user_id' => $user->id,
        ]);
    }
}
