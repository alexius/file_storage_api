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
            'user_id' => $this->faker->uuid(),
            'original_name' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'system_name' => $this->faker->sha1(),
            'file_extension' => $this->faker->fileExtension(),
            'file_source' => $this->faker->name,
            'file_size' => $this->faker->randomNumber(),
            'mime_type' => $this->faker->mimeType(),
            'storage_provider' => 'local',
        ];
    }
}
