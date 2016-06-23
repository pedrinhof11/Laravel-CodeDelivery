<?php

use Illuminate\Database\Seeder;
use \CodeDelivery\Models\Order;
use \CodeDelivery\Models\OrderItem;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create()->each(function ($o){

            $o->items()->saveMany(factory(OrderItem::class)->times(2)->make([
                'product_id' => rand(1,5),
                'qtd' => 2,
                'price' => 50,
            ]));
        });
    }
}
