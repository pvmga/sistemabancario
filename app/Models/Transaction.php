<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_transacao',
        'valor',
        'conta_corrente_destino',
        'user_id',
    ];

    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class); // A transaction belongs to a user
    }
}
