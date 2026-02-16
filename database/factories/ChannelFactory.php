<?php

namespace Database\Factories;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelFactory extends Factory
{
    protected $model = Channel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->paragraph,
            'category' => $this->faker->word,
            'language' => $this->faker->languageCode,
            'target_audience' => $this->faker->word,
            'user_id' => 1,
            'branding_assets' => [
                'logo' => $this->faker->imageUrl(100, 100),
                'banner' => $this->faker->imageUrl(800, 200),
                'color_scheme' => $this->faker->hexColor,
            ],
            'metadata' => [
                'seo_title' => $this->faker->sentence,
                'seo_description' => $this->faker->paragraph,
                'tags' => $this->faker->words(5),
            ],
            'status' => $this->faker->randomElement(['active', 'inactive', 'archived']),
        ];
    }
}