@extends('template')
@section('main')


<form action="" method="POST" class="mt-5" style="max-width: 600px; margin: auto;">
       @csrf {{-- protéger les données pendant le transfert --}}
      <div class="mb-3">
            <label for="label_comp" class="form-label">Label</label>
            <input type="text" class="form-control" id="label_comp" name="label_comp">
      </div>
      <div class="mb-3">
            <label for="description_comp" class="form-label">Description</label>
            <textarea class="form-control" id="description_comp" name="description_comp"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
</form>

<h1 class="text-center mt-5">List of Competences</h1>



<table class="table table-striped mt-5"> 
      <thead class="table-primary">
         <tr>
            <th scope="col">Code</th>
            <th scope="col">Label</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
         </tr>
      </thead>
      <tbody class="table-light-white table-hover">
         @foreach($competence_list as $competence)
         <tr>
            <td>{{ $competence->code_comp}}</td>
            <td>{{ $competence->label_comp}}</td>
            <td>{{ $competence->description_comp}}</td>
            <td>
                 <a href="/web/competences/{{ $competence->code_comp }}/edit" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                 <form action="{{ route('web.competences.destroy', $competence->code_comp) }}" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger"><i class="fas fa-remove"></i></button>
                  {{-- <a href="{{ route('web.competences.edit, $competence->code_comp') }}" class="btn btn-primary"></a> --}}
            </td>
         </tr>
         @endforeach
      </tbody>
</table>



@endsection
