<!-- resources/views/evaluation/create.blade.php -->

@extends('layouts.app')

@section('title', 'Ajouter une Evaluation')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">



        <form action="{{ route('evaluation.store') }}" class="form-control mt-2" method="POST">
            @csrf

            <div class="form-group">
                <label for="module_id">Module</label>
                <select name="module_id" class="form-control" required>
                    <!-- Assuming you have a list of modules to populate the dropdown -->
                    @foreach(App\Models\Module::all() as $module)
                        <option value="{{ $module->id }}">{{ $module->code }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="coeficient">Coefficient</label>
                <input type="number" name="coeficient" class="form-control" value="{{ old('coeficient') }}" required>
            </div>

            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" class="form-control" value="{{ old('titre') }}" required>
            </div>

            <div class="form-group">
                <label for="date_evaluation">Date de l'Évaluation</label>
                <input type="date" name="date_evaluation" class="form-control" value="{{ old('date_evaluation') }}" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary mt-2"><i class="bi bi-plus-circle-fill me-1"></i>Ajouter l'évaluation</button>
            </div>
        </form>
    </div>
@endsection
