<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationEleve extends Model
{
    use HasFactory;

    protected $table = 'evaluation_eleve';

    protected $fillable = [
        'eleve_id',
        'evaluation_id',
        'note',
    ];

    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
}
