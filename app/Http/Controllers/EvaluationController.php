<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\EvaluationEleve;
use App\Mail\NewNoteEmail;
use Illuminate\Support\Facades\Mail;

class EvaluationController extends Controller
{
    //
public function index()
{
    $evaluations = Evaluation::paginate(10);
    return view('evaluation.index', compact('evaluations'));
}

public function create()
{
    return view('evaluation.create');
}

public function store(Request $request)
{
    $request->validate([
        'module_id' => 'required|exists:module,id',
        'coeficient' => 'required|integer',
        'titre' => 'required|string|max:255',
        'date_evaluation' => 'required|date',
    ]);

    Evaluation::create($request->all());

    return redirect()->route('evaluation.index')
                     ->with('success', 'Evaluation created successfully.');
}

public function show(Evaluation $evaluation)
{   
    $evaluations = Evaluation::find($evaluation->id);
    $evaluations->load('evaluationEleves');

    $evaluations->load('module');
    $evaluations->load('evaluationEleves.eleve');  
    return view('evaluation.notes', compact('evaluations')); 
}

public function edit(Evaluation $evaluation)
{
    return view('evaluation.edit', compact('evaluation'));
}

public function update(Request $request, Evaluation $evaluation)
{
    $request->validate([
        'module_id' => 'required|exists:module,id',
        'coeficient' => 'required|integer',
        'titre' => 'required|string|max:255',
        'date_evaluation' => 'required|date',
    ]);

    $evaluation->update($request->all());

    return redirect()->route('evaluation.index')
                     ->with('success', 'Evaluation updated successfully.');
}

public function destroy(Evaluation $evaluation)
{
    $evaluation->evaluationEleves()->delete();
    $evaluation->delete();

    return redirect()->route('evaluation.index')
                     ->with('success', 'Evaluation deleted successfully.');
}


public function notesInf10(Evaluation $evaluation)
{
    $evaluations = Evaluation::find($evaluation->id);
    $evaluations->load(['evaluationEleves' => function($query) {
        $query->where('note', '<', 10);
    }, 'evaluationEleves.eleve', 'module']);

    return view('evaluation.notes', compact('evaluations')); 
}

public function addGrade(Request $request, Evaluation $evaluation)
{
    $request->validate([
        'eleve_id' => 'required|exists:eleves,id',
        'note' => 'required|numeric|min:0|max:20',
    ]);

    // Check if grade already exists for this student and evaluation
    $existingGrade = EvaluationEleve::where('evaluation_id', $evaluation->id)
        ->where('eleve_id', $request->eleve_id)
        ->first();

    if ($existingGrade) {
        return back()->with('error', 'A grade already exists for this student.');
    }

    // Create new grade
    $evaluationEleve = EvaluationEleve::create([
        'evaluation_id' => $evaluation->id,
        'eleve_id' => $request->eleve_id,
        'note' => $request->note,
    ]);

    // Send email notification
    $eleve = $evaluationEleve->eleve;
    Mail::to($eleve->email)->send(new NewNoteEmail(
        $eleve,
        $evaluationEleve,
        $evaluation->date_evaluation
    ));

    return back()->with('success', 'Grade added successfully.');
}

public function deleteGrade(Evaluation $evaluation, EvaluationEleve $evaluationEleve)
{
    if ($evaluationEleve->evaluation_id !== $evaluation->id) {
        return back()->with('error', 'Invalid grade deletion request.');
    }

    $evaluationEleve->delete();
    return back()->with('success', 'Grade deleted successfully.');
}




}
