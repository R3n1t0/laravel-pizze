@extends('layouts.admin')

@section('content')


<div class="container bg-info py-1">
  {{-- Posts --}}
  <!-- Titolo contenitore -->
  <h2 class="title-content">Pizze</h2>
  <!-- /Titolo contenitore -->
  <table class="table bg-light py-3">
      <thead>
      <tr>
          <th scope="col">#id</th>
          <th scope="col">Nome</th>
          <th scope="col">Prezzo</th>
          <th scope="col">Popolarita`</th>
          <th scope="col">Ingredienti</th>
          <th scope="col">Vegetariana</th>
          <th scope="col">Azioni</th>
      </tr>
      </thead>
      <tbody>
          @foreach ($pizzas as $pizza )
              <tr>
                  <th scope="row">{{$pizza->id}}</th>
                  <td>{{ $pizza->nome }}</td>
                  <td>{{ $pizza->prezzo }}</td>
                  <td>{{ $pizza->popolarita }}</td>
                  <td>
                    @foreach ($pizza->ingredients as $ingredient)
                        {{$ingredient->name}}
                    @endforeach
                  </td>
                  <td>
                    @if ($pizza->vegetariana == 1)
                    {{ $pizza->vegetariana = 'si' }}
                    @else {{ $pizza->vegetariana = 'no' }}
                    @endif
                   </td>
                  <td class="d-flex">
                      <a class="btn btn-success mx-1" href="{{ route('admin.pizzas.show', $pizza) }}">SHOW</a>
                      <a class="btn btn-primary mx-1" href="{{ route('admin.pizzas.edit', $pizza) }}">EDIT</a>
                      <form class="d-inline mx-1"
                          onsubmit="return confirm('confermi l\'eliminazione di: {{ $pizza->nome }}?')"
                          action="{{ route('admin.pizzas.destroy', $pizza) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger" >DELETE</button>
                      </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>

  {{ $pizzas->links() }}

@endsection
