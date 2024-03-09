<?php

namespace Database\Factories;

use App\Models\SuratPerintahLembur;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Karyawan;

class SuratPerintahLemburFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SuratPerintahLembur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $karyawan = Karyawan::first();
        if (!$karyawan) {
            $karyawan = Karyawan::factory()->create();
        }

        return [
            'karyawan_id' => $this->faker->word,
            'mulai' => $this->faker->date('Y-m-d H:i:s'),
            'selesai' => $this->faker->date('Y-m-d H:i:s'),
            'total_jam_lembur' => $this->faker->date('H:i:s'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
