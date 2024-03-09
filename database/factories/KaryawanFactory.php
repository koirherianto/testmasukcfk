<?php

namespace Database\Factories;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Dapartement;

class KaryawanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Karyawan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dapartement = Dapartement::first();
        if (!$dapartement) {
            $dapartement = Dapartement::factory()->create();
        }

        return [
            'dapartement_id' => $this->faker->word,
            'name' => $this->faker->text($this->faker->numberBetween(5, 100)),
            'nik' => $this->faker->text($this->faker->numberBetween(5, 45)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
