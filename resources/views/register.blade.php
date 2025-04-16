@extends('layouts.login_register_layout')
@section('content')
    <form action="{{ route('newUser') }}" method="post" novalidate>
        @csrf
        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-sm text-center">
            <h1 class="text-2xl font-bold mb-6">Criar Conta no MiniBank</h1>
            <input name="name" type="text" placeholder="Nome completo" class="w-full mb-4 p-2 border rounded" value="" />
            <input name="email" type="email" placeholder="Email" class="w-full mb-4 p-2 border rounded" value="" />
            <input name="password" type="password" placeholder="Senha" class="w-full mb-4 p-2 border rounded" value="" />
            <input name="password_confirmation" type="password" placeholder="Confirmar Senha" class="w-full mb-6 p-2 border rounded" value="" />
            <button type="submit"
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full">Criar</button>
            <p class="text-sm text-gray-600 mt-4">
                Já tem uma conta? <a href="/" class="text-blue-500 hover:underline">Entrar</a>
            </p>
        </div>
        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full mt-5">{{ session('success') }}
            </div>
        @endif

        @error(session('password'))
            <div class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full mt-5">{{ $message }}</div>
        @enderror
    </form>
@endsection
