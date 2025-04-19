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
        Schema::table('transactions', function (Blueprint $table) {
            // Adiciona a foreign key vinculando conta_corrente_destino à coluna account da tabela users
            $table->foreign('conta_corrente_destino')
                  ->references('account')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Remove a foreign key
            $table->dropForeign(['conta_corrente_destino']);
        });
    }
};
