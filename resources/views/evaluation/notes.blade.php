@extends('layouts.app')
@section('title', 'Notes de '. $evaluations->titre)
@section('content')
<div class="container">
    <h3>Module : {{ $evaluations->module->code }} - {{ $evaluations->module->name }}</h3>
    
    {{-- Add Grade Form --}}
    <div class="card mb-4">
        <div class="card-header">
            <h4>Add New Grade</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('evaluation.addGrade', $evaluations->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="eleve_id">Student</label>
                            <select name="eleve_id" class="form-control" required>
                                <option value="">Select Student</option>
                                @foreach(App\Models\Eleve::all() as $eleve)
                                    <option value="{{ $eleve->id }}">{{ $eleve->nom }} {{ $eleve->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="note">Grade</label>
                            <input type="number" name="note" class="form-control" min="0" max="20" step="0.5" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mt-4">Add Grade</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Existing Grades Table --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom de l'eleve</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluations->evaluationEleves as $evaluationEleve)
                <tr>
                    <td>{{ $evaluationEleve->eleve->nom }} {{ $evaluationEleve->eleve->prenom }}</td>
                    <td>{{ $evaluationEleve->note }}</td>
                    <td>
                        <form action="{{ route('evaluation.deleteGrade', [$evaluations->id, $evaluationEleve->id]) }}" 
                              method="POST" 
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Are you sure you want to delete this grade?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
