<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class Evaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluations';
    protected $fillable = [
        'module_id',
        'coeficient',
        'titre',
        'date_evaluation', 
    ];


    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function evaluationEleves()
    {
        return $this->hasMany(EvaluationEleve::class);
    }
}
