@extends('layout.app')
@section('title', 'Notes de '. $evaluations->titre)
@section('content')
<div class="container">
    <h1>Module : {{ $evaluations->module->code }}</h1>
    <table class="table table-striped">
        <thead>
            <tr>

                <th>Nom de l'eleve</th>

                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluations->evaluationEleves as $evaluationEleve)
                <tr>
                    <!-- <td>{{ json_encode($evaluationEleve) }}</td> -->
                    <td>{{ $evaluationEleve->eleve->nom }} {{ $evaluationEleve->eleve->prenom }}</td>
                    <td>{{ $evaluationEleve->note }}</td>
 
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
