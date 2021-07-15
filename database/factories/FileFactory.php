<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'user_id' => $this->faker->uuid(),
            'original_name' => $this->faker->file,
            'system_name' => $this->faker->uuid(),
            'file_extension' => $this->faker->fileExtension(),
            'file_type' => $this->faker->mimeType(),
            'file_size' => $this->faker->randomNumber(),
            'mime_type' => $this->faker->mimeType(),
            'storage_provider' => 'local',
        ];
    }
}
