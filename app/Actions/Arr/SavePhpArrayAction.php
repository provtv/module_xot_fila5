<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Arr;

use function Safe\file_put_contents;
use function Safe\mkdir;
use function Safe\rename;
use function Safe\tempnam;

use Spatie\QueueableAction\QueueableAction;
use Symfony\Component\VarExporter\VarExporter;

class SavePhpArrayAction
{
    use QueueableAction;

    /**
     * @param array<int|string, mixed> $data
     */
    public function execute(array $data, string $filename): bool
    {
        $exported = VarExporter::export($data);
        // $exported = var_export($data, true);
        $content = "<?php\n\ndeclare(strict_types=1);\n\nreturn ".$exported.";\n";

        // Scrittura atomica: evita ParseError se un altro processo fa require a metà write
        // (campagna coverage parallela / AutoLabel su lang_service.php).
        $directory = dirname($filename);
        if (! is_dir($directory)) {
            mkdir($directory, 0o755, true);
        }

        $tempFile = tempnam($directory, 'php_arr_');
        $bytes = file_put_contents($tempFile, $content);
        rename($tempFile, $filename);

        return $bytes > 0;
    }
}
