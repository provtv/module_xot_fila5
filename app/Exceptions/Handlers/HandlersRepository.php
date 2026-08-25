<?php

declare(strict_types=1);

namespace Modules\Xot\Exceptions\Handlers;

/**
 * The handlers repository.
 */
class HandlersRepository
{
    /**
     * The custom handlers reporting exceptions.
<<<<<<< HEAD
    *
=======
     *
>>>>>>> laraxot/dev
     * @var array<int, callable>
     */
    protected array $reporters = [];

    /**
     * The custom handlers rendering exceptions.
<<<<<<< HEAD
    *
=======
     *
>>>>>>> laraxot/dev
     * @var array<int, callable>
     */
    protected array $renderers = [];

    /**
     * The custom handlers rendering exceptions in console.
<<<<<<< HEAD
    *
=======
     *
>>>>>>> laraxot/dev
     * @var array<int, callable>
     */
    protected array $consoleRenderers = [];

    /**
     * Register a custom handler to report exceptions.
     */
    public function addReporter(callable $reporter): int
    {
        return array_unshift($this->reporters, $reporter);
    }

    /**
     * Register a custom handler to render exceptions.
     */
    public function addRenderer(callable $renderer): int
    {
        return array_unshift($this->renderers, $renderer);
    }

    /**
     * Register a custom handler to render exceptions in console.
     */
    public function addConsoleRenderer(callable $renderer): int
    {
        return array_unshift($this->consoleRenderers, $renderer);
    }

    /**
     * Retrieve all reporters handling the given exception.
<<<<<<< HEAD
    *
=======
     *
>>>>>>> laraxot/dev
     * @return array<int, callable>
     */
    public function getReportersByException(\Throwable $e): array
    {
        return array_filter(
            $this->reporters,
<<<<<<< HEAD
           fn (callable $handler): bool => $this->handlesException($handler, $e),
=======
            fn (callable $handler): bool => $this->handlesException($handler, $e),
>>>>>>> laraxot/dev
        );
    }

    /**
     * Retrieve all renderers handling the given exception.
<<<<<<< HEAD
    *
=======
     *
>>>>>>> laraxot/dev
     * @return array<int, callable>
     */
    public function getRenderersByException(\Throwable $e): array
    {
        return array_filter(
            $this->renderers,
<<<<<<< HEAD
           fn (callable $handler): bool => $this->handlesException($handler, $e),
=======
            fn (callable $handler): bool => $this->handlesException($handler, $e),
>>>>>>> laraxot/dev
        );
    }

    /**
     * Retrieve all console renderers handling the given exception.
<<<<<<< HEAD
    *
=======
     *
>>>>>>> laraxot/dev
     * @return array<int, callable>
     */
    public function getConsoleRenderersByException(\Throwable $e): array
    {
        return array_filter(
            $this->consoleRenderers,
<<<<<<< HEAD
           fn (callable $handler): bool => $this->handlesException($handler, $e),
=======
            fn (callable $handler): bool => $this->handlesException($handler, $e),
>>>>>>> laraxot/dev
        );
    }

    /**
     * Determine whether the given handler can handle the provided exception.
     */
    protected function handlesException(callable $handler, \Throwable $e): bool
    {
        if ($handler instanceof \Closure) {
            $reflection = new \ReflectionFunction($handler);
        } else {
            $reflection = new \ReflectionFunction(\Closure::fromCallable($handler));
        }

        if (! ($params = $reflection->getParameters())) {
            return false;
        }

<<<<<<< HEAD
       $type = $params[0]->getType();
=======
        $type = $params[0]->getType();
>>>>>>> laraxot/dev

        if (! $type instanceof \ReflectionNamedType || $type->isBuiltin()) {
            return true;
        }

        $class = $type->getName();

        return $e instanceof $class;
    }
}
