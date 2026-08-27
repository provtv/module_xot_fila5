<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Models\Feed;

<<<<<<< HEAD
/**
 * @extends Factory<Feed>
 */
=======
>>>>>>> laraxot/master
class FeedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var class-string<Feed>
=======
     * @var class-string<Model>
>>>>>>> laraxot/master
     */
    protected $model = Feed::class;

    /**
     * Define the model's default state.
     */
<<<<<<< HEAD
    /**
     * @return array<string, mixed>
     */
=======
>>>>>>> laraxot/master
    public function definition(): array
    {
        return [
            // 'created_at' => $this->faker->dateTime,
            // 'updated_at' => $this->faker->dateTime,
        ];
    }
}
