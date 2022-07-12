<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pizza;
use App\Http\Requests\PizzaRequest;
use App\Ingredient;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzas = Pizza::orderBy('id','desc')->paginate(5);
        return view('admin.pizzas.index', compact('pizzas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('admin.pizzas.create', compact('ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PizzaRequest $request)
    {
        $data = $request->all();
        $new_pizza = new Pizza();
        $data['slug'] = Pizza::generateSlug($data['nome']);
        $new_pizza->fill($data);
        $new_pizza->save();
        $new_pizza->ingredients()->attach($data['ingredients']);

        return redirect()->route( 'admin.pizzas.show', $new_pizza );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pizza = Pizza::find($id);
        return view( 'admin.pizzas.show', compact('pizza') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pizza = Pizza::find($id);
        $ingredients = Ingredient::all();
        return view( 'admin.pizzas.edit', compact('pizza', 'ingredients') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PizzaRequest $request, Pizza $pizza)
    {
        $data = $request->all();
        $data['slug'] = Pizza::generateSlug($data['nome']);
        $pizza->update($data);
        return redirect()->route( 'admin.pizzas.show', $pizza );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pizza = Pizza::find($id);
        $pizza->delete();
        return redirect()->route( 'admin.pizzas.index' );

    }
}
