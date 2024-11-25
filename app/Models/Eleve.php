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
        // TODO : Implementer les coef dans la moyenne
        $notes = $this->evaluationEleves->pluck('note');
        $moyenne = round($notes->avg(),1);
        return $moyenne;
    }
}
