<?php

use Illuminate\Database\Seeder;
use App\Pizza;

class PizzaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // importo il file php dentro la cartella config con dentro tutte le mie pizze che useremo per popolare la tabella


        $pizzas = config('pizze');


        foreach ($pizzas as $pizza) {

            $new_pizza = new Pizza();
            $new_pizza->nome = $pizza['nome'];
            $new_pizza->slug = Pizza::generateSlug($new_pizza->nome);
            $new_pizza->prezzo = $pizza['prezzo'];

            if(!empty($pizza['popolarita'])){
                $new_pizza->popolarita = $pizza['popolarita'];
            }

            if($pizza['vegetariana'] == 'sì'){
                $new_pizza->vegetariana = 1 ;
            }else{
                $new_pizza->vegetariana = 0;
            }

            $new_pizza->save();
        }

    }
}
