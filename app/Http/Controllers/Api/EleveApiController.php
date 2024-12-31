<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Eleve;
use Illuminate\Http\Request;

class EleveApiController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10); // Default limit of 10 if not specified
        
        $eleves = Eleve::select('id', 'nom', 'prenom', 'email', 'numeroEtudiant')
            ->limit($limit)
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $eleves,
            'count' => $eleves->count()
        ]);
    }

    public function exportNotes($id)
    {
        $eleve = Eleve::with('evaluationEleves.evaluation.module')->findOrFail($id);

        // Prepare data for export
        $grades = [];
        foreach ($eleve->evaluationEleves as $evaluationEleve) {
            $grades[] = [
                
                'Titre' => $evaluationEleve->evaluation->titre,
                'Note' => $evaluationEleve->note,
                'Date' => $evaluationEleve->evaluation->date_evaluation,
            ];
        }

        // Return as JSON or CSV
        return response()->json($grades);
    }
} 