<?php

namespace Database\Factories;

use App\Models\Pasien;
use Illuminate\Database\Eloquent\Factories\Factory;

class RekamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'pasien' => rand(0, 10),
            'dokter' => rand(0, 10),
            'kondisi' => substr(fake()->text(150), 0, 150),
            'suhu' => fake()->randomFloat(1, 35, 45.5),
            'picture' => 'https://source.unsplash.com/random/300×200/?medical' .'&sig=' . rand(0, 1000),
        ];
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter');
    }
}