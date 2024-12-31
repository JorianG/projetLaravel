<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $table = 'eleves';
    protected $fillable = ['nom', 'prenom', 'dateNaissance', 'numeroEtudiant', 'email', 'image', 'user_id'];
    

    public function evaluationEleves()
    {
        return $this->hasMany(EvaluationEleve::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function moyenne()
    {
        $evaluationEleves = $this->evaluationEleves->load('evaluation.module');
        $totalNotes = 0;
        $totalCoef = 0;
        
        foreach ($evaluationEleves as $evaluationEleve) {
            $note = $evaluationEleve->note;
            $evalCoef = $evaluationEleve->evaluation->coeficient;
            $moduleCoef = $evaluationEleve->evaluation->module->coefficient;

            $totalNotes += $note * $evalCoef * $moduleCoef;
            $totalCoef += $evalCoef * $moduleCoef;
        }
        
        $moyenne = $totalCoef > 0 ? round($totalNotes / $totalCoef, 1) : 0; 
        return $moyenne;
    }
}
