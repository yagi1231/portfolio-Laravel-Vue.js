<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
    
        $staff = [
            '青柳',
            '宍戸',
            'もも',
            'じゅんペイ',
            'こうち',
        ];

        $status = [
            '準備中',
            '配達中',
            '完了'
        ];

        $customer_id = [
            '1', '2', '3', '4', '5'
        ];

        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'tel' => $this->faker->phoneNumber(),
            'order' => $this->faker->realText(20),
            'sumprice' => $this->faker->randomNumber(4),
            'time' => $this->faker->date('Y-m-d H:i:s'),
            'end_time' => $this->faker->date('Y-m-d H:i:s'),
            'delivery' => $this->faker->randomElement($staff),
            'status' => $this->faker->randomElement($status),
            'staff_id' => $this->faker->randomElement($customer_id),
            'customer_id' => $this->faker->randomElement($customer_id),
        ];
    }
}
