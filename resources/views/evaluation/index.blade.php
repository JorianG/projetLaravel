@extends('layouts.app')  {{-- Changed from layout.app --}}
@section('title', 'Liste des Evaluations')
@section('content')
    <div class="mt-2">

        {{-- Message flash pour les notifications --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('evaluation.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle-fill me-1"></i> Ajouter une Evaluation</a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Module</th>
                <th>Titre</th>
                <th>Coefficient</th>
                <th>Date d'Evaluation</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($evaluations as $evaluation)
                <tr>
                    <td>{{ $evaluation->id }}</td>
                    <td>{{ $evaluation->module->code }} - {{ $evaluation->module->name }}</td>
                    <td>{{ $evaluation->titre }}</td>
                    <td>{{ $evaluation->coeficient }}</td>
                    <td>{{ $evaluation->date_evaluation }}</td>
                    <td>
                        <a href="{{ route('evaluation.show', $evaluation->id) }}" class="btn btn-primary btn-sm">Liste des notes</a>
                        <a href="{{ route('evaluation.notesInf10', $evaluation->id) }}" class="btn btn-primary btn-sm">Inf a 10</a>
                        <a href="{{ route('evaluation.edit', $evaluation->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('evaluation.destroy', $evaluation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette évaluation?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <ul class="pagination justify-content-end">
            {{ $evaluations->links('pagination::bootstrap-4') }}
        </ul>
    </div>
@endsection
