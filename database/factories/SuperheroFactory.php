<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SuperheroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>fake()->name(),
            'fullName' =>fake()->name(),
            'strength'=>fake()->numberBetween(1, 100),
            'speed'=>fake()->numberBetween(1, 100),
            'durability'=>fake()->numberBetween(1, 100),
            'power'=>fake()->numberBetween(1, 100),
            'combat'=>fake()->numberBetween(1, 100),
            'race'=> fake()->randomElement(['Human', 'Frost Giant','Mutant / Clone','Demi-God','Symbiote','Android','Inhuman','Cyborg']),
            'height/0'=>fake()->numberBetween(5, 8).','.fake()->numberBetween(0, 9,),
            'height/1'=>fake()->numberBetween(60, 250).' cm',
            'weight/0'=>fake()->numberBetween(100, 200).' lb',
            'weight/1'=>fake()->numberBetween(70, 400).' kg',
            'eyeColor' =>fake()->colorName(),
            'hairColor' =>fake()->colorName(),
            'publisher'  =>fake()->randomElement(['Marvel Comics', 'Dark Horse Comics','DC Comics'])
        ];
    }
}
