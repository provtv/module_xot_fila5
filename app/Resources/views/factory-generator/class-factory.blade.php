<?php

declare(strict_types=1);

<<<<<<< HEAD
/** @var \ReflectionClass $reflection */
/** @var array<string, string> $properties */
=======
>>>>>>> laraxot/master
?>
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
@isset($properties['remember_token'])
<<<<<<< HEAD
use Illuminate\Support\Str;
=======
    use Illuminate\Support\Str;
>>>>>>> laraxot/master
@endisset
use {{ $reflection->getName() }};

class {{ $reflection->getShortName() }}Factory extends Factory
{
<<<<<<< HEAD
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = {{ $reflection->getShortName() }}::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
@foreach ($properties as $name => $property)
            '{{ $name }}' => {!! $property !!},
@endforeach
        ];
    }
=======
/**
* The name of the factory's corresponding model.
*
* @var string
*/
protected $model = {{ $reflection->getShortName() }}::class;

/**
* Define the model's default state.
*
* @return array
*/
public function definition(): array
{
return [
@foreach ($properties as $name => $property)
    '{{ $name }}' => {!! $property !!},
@endforeach
];
}
>>>>>>> laraxot/master
}
