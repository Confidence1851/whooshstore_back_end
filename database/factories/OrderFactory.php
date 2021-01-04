<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $reference = $this->faker->bothify('#?#??##>#');
        $amount = $this->faker->numberBetween($min = 2000, $max = 15000);
        return [
            'user_id' => 3,
            'reference' => $reference,
            'amount' => $amount,
            'discount' => 10,
            'payment_type' => 'Paystack',
        ];
    }
}
