@extends('layouts.app')
@section('title', "Modifier Évaluation")
@section('content')
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('evaluation.update', $evaluation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="module_id" class="form-label">Module</label>
                <select class="form-control" id="module_id" name="module_id" required>
                    @foreach(App\Models\Module::all() as $module)
                        <option value="{{ $module->id }}" {{ old('module_id', $evaluation->module_id) == $module->id ? 'selected' : '' }}>
                            {{ $module->code }} - {{ $module->name }}
                        </option>
                    @endforeach
                </select>
                @error('module_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="coeficient" class="form-label">Coefficient</label>
                <input type="number" class="form-control" id="coeficient" name="coeficient" value="{{ old('coeficient', $evaluation->coeficient) }}" required>
                @error('coeficient')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre', $evaluation->titre) }}" required>
                @error('titre')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date_evaluation" class="form-label">Date de l'Évaluation</label>
                <input type="date" class="form-control" id="date_evaluation" name="date_evaluation" value="{{ old('date_evaluation', $evaluation->date_evaluation) }}" required>
                @error('date_evaluation')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('evaluation.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
