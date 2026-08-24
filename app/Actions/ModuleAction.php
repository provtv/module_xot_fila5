<?php

declare(strict_types=1);

namespace Modules\Xot\Actions;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Nwidart\Modules\Facades\Module;
use Spatie\QueueableAction\QueueableAction;

/**
 * Class ModuleAction.
 */
class ModuleAction
{
    use QueueableAction;

    public string $name = '';

    private static ?self $_instance = null;

    public function __construct(string $name = '')
    {
        $this->name = $name;
    }

    public static function getInstance(): self
    {
        if (! self::$_instance instanceof self) {
<<<<<<< .merge_file_NfuRwK
            self::$_instance = new self;
=======
            self::$_instance = new self();
>>>>>>> .merge_file_bcIdwM
        }

        return self::$_instance;
    }

    public static function make(): self
    {
        return static::getInstance();
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array<string, class-string>
     */
    public function getModels(): array
    {
        $mod = Module::find($this->name);
        if (! $mod instanceof \Nwidart\Modules\Module) {
            return [];
        }

        $mod_path = $mod->getPath().'/Models';
        $mod_path = str_replace(['\\', '/'], [\DIRECTORY_SEPARATOR, \DIRECTORY_SEPARATOR], $mod_path);

        $files = File::files($mod_path);
        $data = [];
        $ns = 'Modules\\'.$mod->getName().'\\Models';
        foreach ($files as $file) {
            $filename = $file->getRelativePathname();
            $ext = '.php';
            if (Str::endsWith($filename, $ext)) {
<<<<<<< .merge_file_NfuRwK
                $tmp = new \stdClass;
=======
                $tmp = new \stdClass();
>>>>>>> .merge_file_bcIdwM

                $name = mb_substr($filename, 0, -mb_strlen($ext));

                /**
                 * @var class-string
                 */
                $class = $ns.'\\'.$name;
                $tmp->class = $class;
                $name = Str::snake($name);
                $tmp->name = $name;

                try {
                    $reflection_class = new \ReflectionClass($tmp->class);
                    if (! $reflection_class->isAbstract()) {
                        $data[$tmp->name] = $tmp->class;
                    }
                } catch (\Exception) {
                    // Skip files whose class name does not resolve to an existing/valid class.
                }
            }
        }

        return $data;
    }

<<<<<<< .merge_file_NfuRwK
    public function execute(): void {}
=======
    public function execute(): void
    {
    }
>>>>>>> .merge_file_bcIdwM
}
