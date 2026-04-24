@extends('template')
@section('content')
<div class="container mt-5" align="center">
    <h1>Détails de la compétence</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $competence->label_comp }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $competence->description_comp }}</p>
        </div>
    </div>
</div>
@endsection