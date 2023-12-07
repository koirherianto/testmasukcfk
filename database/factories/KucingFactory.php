<?php

namespace Database\Factories;

use App\Models\Kucing;
use Illuminate\Database\Eloquent\Factories\Factory;


class KucingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kucing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'nama' => $this->faker->text($this->faker->numberBetween(5, 124)),
            'tanggal_lahir' => $this->faker->date('Y-m-d'),
            'penjelasa' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'is_boy' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
