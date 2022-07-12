@extends('layouts.admin')

@section('content')

<div class="container">


  <h1>Nome: {{ $pizza->nome }}</h1>
  <p>Slug: {{ $pizza->slug }}</p>
  <p>Prezzo:{{ $pizza->prezzo }}</p>
  <p>Ingredienti:

    @foreach ($pizza->ingredients as $ingredient)
    {{ $ingredient->name }}
    @endforeach


    </p>

  @if ($pizza->popolarita != 0)

    <p>Popolarita`: {{ $pizza->popolarita }}  </p>

  @endif


  <p>Vegetariana:
    @if ($pizza->vegetariana == 1)
      {{ $pizza->vegetariana = 'si' }}
    @else {{ $pizza->vegetariana = 'no' }}
    @endif
  </p>

  <a class="btn btn-success" href="{{ route('admin.pizzas.index') }}">GO BACK</a>
  <a class="btn btn-primary mx-1" href="{{ route('admin.pizzas.edit', $pizza) }}">EDIT</a>
  <form class="d-inline mx-1"
      onsubmit="return confirm('confermi l\'eliminazione di: {{ $pizza->nome }}?')"
      action="{{ route('admin.pizzas.destroy', $pizza) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" >DELETE</button>
  </form>

</div>


@endsection
