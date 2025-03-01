<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $colors = collect([
            '3d4070',
            'f5a623',
            'f8e71c',
            '8b572a',
            '7ed321',
            '417505',
            'bd10e0',
            '9013fe',
            '4a90e2',
            '50e3c2',
            'b8e986',
            '000000',
        ]);

        $color = $colors->random();

        return [
            'title' => $this->faker->sentence(),
            'image' => "https://placehold.jp/{$color}/ffffff/1024x600.png",
            'extract' => $this->faker->text(200),
            'body' => $this->faker->text(2000),
        ];
    }
}
