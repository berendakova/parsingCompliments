<?php


namespace Database\Factories;


use App\Models\Compliment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplimentFactory extends Factory
{
    protected $model = Compliment::class;

    public function definition()
    {
        return [
            'text' => $this->faker->name(),
        ];
    }
}
