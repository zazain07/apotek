<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $units = ['Botol', 'Strip', 'Ampul', 'Kotak', 'Pot', 'Sachet', 'Tube'];

        return [
            'unit_id' => fake()->uuid,
            'unit' => fake()->unique()->randomElement($units),
        ];
    }
}
