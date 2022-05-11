<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shippings')->insert([
            'id' => 1,
            'name' => 'Paczkomaty 24/7',
            'img' => 'inpost',
            'price' => 10.99,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('shippings')->insert([
            'id' => 2,
            'name' => 'Kurier DPD',
            'img' => 'dpd',
            'price' => 18.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('shippings')->insert([
            'id' => 3,
            'name' => 'Kurier DPD pobranie',
            'img' => 'dpd',
            'price' => 22.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('payments')->insert([
            'id' => 1,
            'name' => 'PayU',
            'img' => 'payu',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('payments')->insert([
            'id' => 2,
            'name' => 'Płatność przy odbiorze',
            'img' => 'odbior',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('payments')->insert([
            'id' => 3,
            'name' => 'Przelew bankowy - zwykły',
            'img' => 'zwykly',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 1,
            'name' => 'Testowy produkt',
            'price' => 115.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'name' => 'Testowy produkt dwa',
            'price' => 155.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('carts')->insert([
            'id' => 1,
            'total' => 155.00,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('cart_items')->insert([
            'id' => 1,
            'cart_id' => 1,
            'product_id' => 1,
            'quantity' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('cart_items')->insert([
            'id' => 2,
            'cart_id' => 1,
            'product_id' => 2,
            'quantity' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


    }
}
