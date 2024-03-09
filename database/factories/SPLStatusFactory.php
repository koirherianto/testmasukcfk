<?php

namespace Database\Factories;

use App\Models\SPLStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\SuratPerintahLembur;

class SPLStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SPLStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $suratPerintahLembur = SuratPerintahLembur::first();
        if (!$suratPerintahLembur) {
            $suratPerintahLembur = SuratPerintahLembur::factory()->create();
        }

        return [
            'approved_by' => $this->faker->word,
            'surat_perintah_lembur_id' => $this->faker->word,
            'status' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'message' => $this->faker->text($this->faker->numberBetween(5, 65535)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
