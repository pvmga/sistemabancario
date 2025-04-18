@extends('layouts.main_layout')
@section('content')
    <div class="max-w-3xl mx-auto">

        @include('layouts.top_bar')

        <div class="flex justify-between bg-white p-6 rounded-2xl shadow mb-4">
            <div>
                <h3 class="text-lg font-medium">Olá, {{ ucwords($user->name) }} 👋</h3>
                <p class="text-sm font-normal">Conta Corrente: {{ $user->account }}</p>
                <p class="text-xl font-bold text-green-600">Saldo atual: R$ {{ number_format($user->balance, 2, ',', '.') }}</p>
            </div>
            <div></div>
            <div>
                @if(session('success'))
                    <div class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full mt-5">{{ session('success') }}</div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Depositar -->
            <form action="{{ route('newSaqueAndDepositoAndTransfer') }}" method="POST">
                <input type="hidden" name="text_type" value="Deposito">
                <input type="hidden" name="text_account_deposit" value="{{ $user->account }}">
                @csrf
                <div class="bg-green-100 p-4 rounded-xl shadow">
                    <h4 class="font-semibold text-green-700 mb-2">💰 Depositar</h4>
                    <input type="text" placeholder="Valor (R$)" class="w-full p-2 mb-2 border rounded" name="text_deposit" value="{{ old('text_deposit') }}" id="depositar" />
                    <button class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Depositar</button>
                </div>
                @error('text_deposit')
                    <div class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full mt-5">{{ $message }}</div>
                @enderror
            </form>
            <!-- Sacar -->
            <form action="{{ route('newSaqueAndDepositoAndTransfer') }}" method="POST">
                <input type="hidden" name="text_type" value="Saque">
                <input type="hidden" name="text_account_sake" value="{{ $user->account }}">
                @csrf
                <div class="bg-yellow-100 p-4 rounded-xl shadow">
                    <h4 class="font-semibold text-yellow-700 mb-2">📤 Sacar</h4>
                    <input type="text" placeholder="Valor (R$)" class="w-full p-2 mb-2 border rounded" name="text_sake" value="{{ old('text_sake') }}" id="sacar" />
                    <button class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600">Sacar</button>
                </div>

                @error('text_sake')
                    <div class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full mt-5">{{ $message }}</div>
                @enderror
            </form>
            <!-- Transferir -->
            <form action="{{ route('newSaqueAndDepositoAndTransfer') }}" method="POST">
                @csrf
                <input type="hidden" name="text_type" value="Transferencia">
                <div class="bg-purple-100 p-4 rounded-xl shadow">
                    <h4 class="font-semibold text-purple-700 mb-2">🔄 Transferir</h4>
                    <input name="text_account" type="text" placeholder="N° CC" class="w-full p-2 mb-2 border rounded" value="{{ old('text_account') }}" maxlength="4" />
                    <input name="text_value" type="text" placeholder="Valor (R$)" class="w-full p-2 mb-2 border rounded" value="{{ old('text_value') }}" id="transferir"/>
                    <button class="w-full bg-purple-500 text-white py-2 rounded hover:bg-purple-600">Transferir</button>
                </div>

                @error('text_type')
                    <div class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full mt-5">{{ $message }}</div>
                @enderror
                @error('text_value')
                    <div class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full mt-5">{{ $message }}</div>
                @enderror
                @error('text_account')
                    <div class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full mt-5">{{ $message }}</div>
                @enderror
                @if(session('newTransferError'))
                    <div class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full mt-5">{{ session('newTransferError') }}</div>
                @endif
            </form>
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
                    @foreach($transactions as $transaction)
                        @include('transactions')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
