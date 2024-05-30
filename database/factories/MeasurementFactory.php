<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MeasurementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'temperature' => mt_rand(1,100),
            'ph' => mt_rand(1,10),
            'moisture' => mt_rand(30,70),
            'nitrogen' => mt_rand(1,60),
            'phosporus' => mt_rand(1,60),
            'potassium' => mt_rand(1,60),
            'ec' => mt_rand(1,60),
            'idLocation' => mt_rand(1,10)
        ];
    }
}
