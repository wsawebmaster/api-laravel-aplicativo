<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    // Indicar o nome da tabela
    protected $table = 'bills';

    // Indicar os campos que podem ser preenchidos em massa
    protected $fillable = ['name', 'bill_value', 'due_date'];

    // Ocultar colunas específicas ao serializar o modelo
    protected $hidden = [
        // 'bill_value',
    ];
}
