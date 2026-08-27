<?php

/**
 * @see https://dev.to/jackmiras/laravels-exceptions-part-2-custom-exceptions-1367
 */

declare(strict_types=1);

namespace Modules\Xot\Exceptions;

<<<<<<< HEAD
=======
use JsonSerializable;
use Override;
>>>>>>> laraxot/master
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

use function Safe\json_encode;

<<<<<<< HEAD
/**
 * @implements Arrayable<string, string>
 */
readonly class ApplicationError implements \JsonSerializable, Arrayable, Jsonable
{
    public function __construct(
        private string $help = '',
        private string $error = '',
    ) {
    }

    /** @return array<string, string> */
=======
readonly class ApplicationError implements JsonSerializable, Arrayable, Jsonable
{
    public function __construct(
        private  string $help = '',
        private  string $error = '',
    ) {}

>>>>>>> laraxot/master
    public function toArray(): array
    {
        return [
            'error' => $this->error,
            'help' => $this->help,
        ];
    }

<<<<<<< HEAD
    /** @return array<string, string> */
    #[\Override]
=======
    #[Override]
>>>>>>> laraxot/master
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toJson($options = 0): string
    {
<<<<<<< HEAD
        return json_encode($this->jsonSerialize(), $options);
=======
        $jsonEncoded = json_encode($this->jsonSerialize(), $options);
        // throw_unless($jsonEncoded, JsonEncodeException::class);

        return $jsonEncoded;
>>>>>>> laraxot/master
    }
}
