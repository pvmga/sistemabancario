<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ou implemente lógica de permissão se necessário
    }

    public function rules(): array
    {
        $type = $this->input('text_type');

        // regra comum entre as transações
        $common = [
            'text_type' => 'required|in:Deposito,Saque,Transferencia,Recebida',
        ];

        // regra especifica de cadas transação
        // match -> para verificar tipo de transação, caso encontre alguma das regras aplicará, caso contrário, entrará no default
        $typeRules = match ($type) {
            'Deposito' => ['text_deposit' => 'required|min:0.01'],
            'Saque' => ['text_sake' => 'required|min:0.01'],
            'Transferencia' => [
                'text_value' => 'required|min:0.01',
                'text_account' => 'required|exists:users,account'
            ],
            default => [],
        };

        // merge retorna sa regras comuns e especificas
        return array_merge($common, $typeRules);
    }

    public function messages(): array
    {
        return [
            'text_account.exists' => 'Conta inexistente.',
            'text_value.min' => 'Valor mínimo da transferência é R$ 0,01.',
        ];
    }
}
