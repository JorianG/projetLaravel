@extends('layouts.app')
@section('title', 'Notes de l\'élève')
@section('content')
<div class="container">
    <h1>Moyenne de l'eleve : {{ $eleve->moyenne() }}/20</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Module</th>
                <th>Titre Evaluation</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eleve->evaluationEleves as $evaluationEleve)
                <tr>
                    <td>{{ $evaluationEleve->evaluation->module->code }}</td>
                    <!-- <td>{{ json_encode($evaluationEleve)}}</td> -->
                    <td>{{ $evaluationEleve->evaluation->titre }}</td>
                    <td>{{ $evaluationEleve->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>    
</div>
@endsection