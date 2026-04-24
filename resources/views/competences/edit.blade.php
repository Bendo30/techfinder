@extends('template')
@section('content')
<div class="container mt-5" align="center">
    <h1>Modifier la compétence</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('web.competences.update', $competence_edit->code_comp) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="label_comp" class="form-label">Label</label>
                    <input type="text" class="form-control" id="label_comp" name="label_comp" value="{{ $competence_edit->label_comp }}" required>
                </div>
                <div class="mb-3">
                    <label for="description_comp" class="form-label">Description</label>
                    <textarea class="form-control" id="description_comp" name="description_comp" rows="3" required>{{ $competence_edit->description_comp }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
            <a href="{{ route('web.competences.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection