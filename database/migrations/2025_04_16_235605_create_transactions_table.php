<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->enum('tipo_transacao', ['Deposito', 'Saque', 'Transferencia']); // Tipo da transação
            $table->decimal('valor', 15, 2); // Valor da transação (ex: 9999999999.99)
            $table->string('conta_corrente_destino'); // Conta Corrente de Destino
            $table->unsignedBigInteger('user_id'); // Relacionamento com a tabela users (id do usuário)
            $table->timestamps();

            // Chave estrangeira
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
