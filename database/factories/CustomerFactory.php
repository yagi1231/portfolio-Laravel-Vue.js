<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        DB::table('customers')->delete();
        
        $staff = [
            '青柳',
            '宍戸',
            'もも',
            'じゅんペイ',
            'こうち',
        ];

        $staff_id = [
            '1', '2', '3', '4', '5'
        ];

        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'tel' => $this->faker->phoneNumber(),
            'remarks' => $this->faker->address(),
            'staff_id' => $this->faker->randomElement($staff_id),
        ];
    }
}
