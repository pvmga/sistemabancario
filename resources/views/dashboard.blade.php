@extends('layouts.main_layout')
@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">MiniBank Dashboard</h2>
            <a href="login.html" class="text-red-500 hover:underline">Sair</a>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow mb-4">
            <h3 class="text-lg font-medium">Olá, João! 👋</h3>
            <p class="text-xl font-bold text-green-600">Saldo atual: R$ 1.250,00</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Depositar -->
            <div class="bg-green-100 p-4 rounded-xl shadow">
                <h4 class="font-semibold text-green-700 mb-2">💰 Depositar</h4>
                <input type="number" placeholder="Valor (R$)" class="w-full p-2 mb-2 border rounded" />
                <button class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Depositar</button>
            </div>
            <!-- Sacar -->
            <div class="bg-yellow-100 p-4 rounded-xl shadow">
                <h4 class="font-semibold text-yellow-700 mb-2">📤 Sacar</h4>
                <input type="number" placeholder="Valor (R$)" class="w-full p-2 mb-2 border rounded" />
                <button class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600">Sacar</button>
            </div>
            <!-- Transferir -->
            <div class="bg-purple-100 p-4 rounded-xl shadow">
                <h4 class="font-semibold text-purple-700 mb-2">🔄 Transferir</h4>
                <input type="text" placeholder="Para (ex: Maria)" class="w-full p-2 mb-2 border rounded" />
                <input type="number" placeholder="Valor (R$)" class="w-full p-2 mb-2 border rounded" />
                <button class="w-full bg-purple-500 text-white py-2 rounded hover:bg-purple-600">Transferir</button>
            </div>
        </div>

        <div class="bg-white p-4 rounded-2xl shadow">
            <h4 class="font-semibold mb-2">📋 Histórico de Transações:</h4>
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="text-gray-600 border-b">
                        <th class="py-2">Data</th>
                        <th class="py-2">Tipo</th>
                        <th class="py-2">Valor</th>
                        <th class="py-2">Conta destino</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="py-2">08/04/2025</td>
                        <td class="py-2">Depósito</td>
                        <td class="py-2">R$ 500,00</td>
                        <td class="py-2">-</td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2">08/04/2025</td>
                        <td class="py-2">Transferência</td>
                        <td class="py-2">R$ 100,00</td>
                        <td class="py-2">Maria (ID: 2)</td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2">07/04/2025</td>
                        <td class="py-2">Saque</td>
                        <td class="py-2">R$ 50,00</td>
                        <td class="py-2">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
