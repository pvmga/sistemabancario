@extends('layouts.login_register_layout')
@section('content')
  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-sm text-center">
    <h1 class="text-2xl font-bold mb-6">Criar Conta no MiniBank</h1>
    <input type="text" placeholder="Nome completo" class="w-full mb-4 p-2 border rounded" />
    <input type="email" placeholder="Email" class="w-full mb-4 p-2 border rounded" />
    <input type="password" placeholder="Senha" class="w-full mb-4 p-2 border rounded" />
    <input type="password" placeholder="Confirmar Senha" class="w-full mb-6 p-2 border rounded" />
    <a href="/">
      <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full">Cadastrar</button>
    </a>
    <p class="text-sm text-gray-600 mt-4">
      Já tem conta? <a href="/" class="text-blue-500 hover:underline">Entrar</a>
    </p>
  </div>
@endsection
