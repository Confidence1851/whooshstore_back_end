<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderItem = 
        [
            [
                'order_id' =>1,
                'user_id' => 3,
                'product_id' => 1,
                'amount' => 1499,
                'quantity' => 2,
                'discount' => 10,
            ],
            [
                'order_id' =>1,
                'user_id' => 3,
                'product_id' => 2,
                'amount' => 1499,
                'quantity' => 1,
                'discount' => 20,
            ],
            [
                'order_id' =>1,
                'user_id' => 3,
                'product_id' => 1,
                'amount' => 1499,
                'quantity' => 2,
                'discount' => 10,
            ],
            [
                'user_id' => 3,
                'product_id' => 3,
                'amount' => 1499,
                'quantity' => 1,
                'discount' => 10,
            ]
        ];
        foreach ($orderItem as $key => $value) {
            OrderItem::create($value);
        }
    }
}
