<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reference = 'FT56ODS53F';
        $amount = 15000;
        $order = [
            'user_id' => 3,
            'reference' => $reference,
            'amount' => $amount,
            'discount' => 10,
            'payment_type' => 'Paystack',
        ];

        Order::create($order);
    }
}
