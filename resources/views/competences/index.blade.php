@extends('template')  <!-- Si vous utilisez un template de base -->

@section('content')
    <div class="container mt-5" align="center">
        <h4>Liste des Compétences</h4>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Label</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($competence_list as $competence)
                <tr>
                    <td>{{ $competence->label_comp }}</td>
                    <td>{{ $competence->description_comp }}</td>
                    <td>
                        <a href="{{ route('web.competences.show', $competence->code_comp) }}" class="btn btn-info"><i class="fas fa-eye"style="color: rgb(59, 51, 95)" ></i></a>
                        <a href="{{ route('web.competences.edit', $competence->code_comp) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <!-- Pagination avec Bootstrap -->
<div class="d-flex justify-content-center mt-1">
    {{ $competence_list->links() }}
</div>
    </div>
@endsection