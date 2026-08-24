<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Cast;

<<<<<<< .merge_file_q5lCJ6
use Modules\Xot\Actions\Cast\SafeStringCastAction;

=======
>>>>>>> .merge_file_QA6JkZ
final class SafeNullableStringCastAction
{
    public function execute(mixed $value): ?string
    {
        $stringValue = SafeStringCastAction::cast($value);

        return '' !== $stringValue ? $stringValue : null;
    }

    public static function cast(mixed $value): ?string
    {
        return app(self::class)->execute($value);
    }
}
