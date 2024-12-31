@extends('layouts.app')
@section('title', 'Notes de l\'élève')
@section('content')
<div class="container">
    <h1>Moyenne de l'eleve : {{ $eleve->moyenne() }}/20</h1>
    <div class="accordion" id="moduleAccordion">
        @foreach($eleve->evaluationEleves->groupBy('evaluation.module.id') as $moduleId => $moduleEvaluations)
            <div class="card">
                <div class="card-header" id="heading{{ $loop->iteration }}">
                    <h2 class="mb-0">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
                            Module : {{ $moduleEvaluations->first()->evaluation->module->code }} (coef : {{ $moduleEvaluations->first()->evaluation->module->coefficient }})
                        </button>
                    </h2>
                </div>

                <div id="collapse{{ $loop->iteration }}" class="collapse show" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#moduleAccordion">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Titre Evaluation</th>
                                    <th>Note</th>
                                    <th>Coefficient</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($moduleEvaluations as $evaluationEleve)
                                    <tr>
                                        <td>{{ $evaluationEleve->evaluation->titre }}</td>
                                        <td>{{ $evaluationEleve->note }}</td>
                                        <td>{{ $evaluationEleve->evaluation->coeficient }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection