@extends('layouts.admin')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-8 offset-2">
      <h1>Crea la nuova Pizza</h1>

      {{-- campo errori debug --}}
      {{-- @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif --}}

      <form action="{{ route('admin.pizzas.store') }}" method="POST">
        @csrf
        @method('POST')
        {{-- NOME pIZZA --}}
        <div class="mb-3">
          <label for="nome" class="form-label">Nome Pizza</label>
          <input type="text"
            class="form-control @error ('nome') is-invalid @enderror"
            value="{{ old('nome') }}"
            name="nome" id="nome"
            placeholder="Inserisci un nome" required>
            @error('nome')
              <p class="invalid-feedback d-block">{{ $message }}</p>
            @enderror
        </div>



        {{-- PREZZO PIZZA --}}
        <div class="mb-3">
          <label for="prezzo" class="form-label">Prezzo</label>
          <input type="number" step=".1" class="form-control  @error ('prezzo') is-invalid @enderror"
          value="{{ old('prezzo') }}"
          name="prezzo" id="prezzo" placeholder="Inserisci il prezzo" required>
          @error('prezzo')
          <p class="invalid-feedback d-block">
            {{ $message }}
          </p>
          @enderror
        </div>



        {{-- INGREDIENTI PIZZA --}}
        <div class="mb-3">
            @foreach ($ingredients as $ingredient)
                <input
                        type="checkbox"
                        name="ingredients[]"
                        id="ingredient{{$loop->iteration}}"
                        value="{{$ingredient->id}}"
                        @if (in_array($ingredient->id, old('ingredients', [])))
                            checked
                        @endif>
                <label for="ingredient{{$loop->iteration}}" >{{$ingredient->name}}</label>
            @endforeach
            @error('ingredients')
            <p class="invalid-feedback d-block">{{ $message }}</p>
          @enderror
        </div>





        <div class="mb-3 form-check">
          {{-- <p>Vegetariana:</p> --}}
          {{-- VEGETARIAN --}}
          <input type="radio" value="1"  id="vegetariana" name="vegetariana">
          <label class="form-check-label" for="vegetariana">Vegetariana</label>

          {{-- NON-VEGETARIAN --}}

          <input type="radio" class="ml-3" value="0"  id="no-vegetariana" checked   name="vegetariana">
          <label class="form-check-label" for="no-vegetariana">Non Vegetariana</label>
        </div>
        <button type="submit" class="btn btn-primary">SUBMIT</button>
      </form>
    </div>
  </div>
</div>


@endsection
