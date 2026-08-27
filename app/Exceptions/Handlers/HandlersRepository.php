<?php

declare(strict_types=1);

namespace Modules\Xot\Exceptions\Handlers;

<<<<<<< HEAD
=======
use Throwable;
use Closure;
use ReflectionFunction;
use ReflectionClass;

>>>>>>> laraxot/master
/**
 * The handlers repository.
 */
class HandlersRepository
{
    /**
     * The custom handlers reporting exceptions.
<<<<<<< HEAD
     *
     * @var array<int, callable>
=======
>>>>>>> laraxot/master
     */
    protected array $reporters = [];

    /**
     * The custom handlers rendering exceptions.
<<<<<<< HEAD
     *
     * @var array<int, callable>
=======
>>>>>>> laraxot/master
     */
    protected array $renderers = [];

    /**
     * The custom handlers rendering exceptions in console.
<<<<<<< HEAD
     *
     * @var array<int, callable>
=======
>>>>>>> laraxot/master
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
     * @return array<int, callable>
     */
    public function getReportersByException(\Throwable $e): array
    {
        return array_filter(
            $this->reporters,
            fn (callable $handler): bool => $this->handlesException($handler, $e),
=======
     */
    public function getReportersByException(Throwable $e): array
    {
        return array_filter(
            $this->reporters,
            fn(mixed $handler) => is_callable($handler) && $this->handlesException($handler, $e),
>>>>>>> laraxot/master
        );
    }

    /**
     * Retrieve all renderers handling the given exception.
<<<<<<< HEAD
     *
     * @return array<int, callable>
     */
    public function getRenderersByException(\Throwable $e): array
    {
        return array_filter(
            $this->renderers,
            fn (callable $handler): bool => $this->handlesException($handler, $e),
=======
     */
    public function getRenderersByException(Throwable $e): array
    {
        return array_filter(
            $this->renderers,
            fn(mixed $handler) => is_callable($handler) && $this->handlesException($handler, $e),
>>>>>>> laraxot/master
        );
    }

    /**
     * Retrieve all console renderers handling the given exception.
<<<<<<< HEAD
     *
     * @return array<int, callable>
     */
    public function getConsoleRenderersByException(\Throwable $e): array
    {
        return array_filter(
            $this->consoleRenderers,
            fn (callable $handler): bool => $this->handlesException($handler, $e),
=======
     */
    public function getConsoleRenderersByException(Throwable $e): array
    {
        return array_filter(
            $this->consoleRenderers,
            fn(mixed $handler) => is_callable($handler) && $this->handlesException($handler, $e),
>>>>>>> laraxot/master
        );
    }

    /**
     * Determine whether the given handler can handle the provided exception.
     */
<<<<<<< HEAD
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

        $type = $params[0]->getType();
        if (! $type instanceof \ReflectionNamedType || $type->isBuiltin()) {
            return true;
        }

        return is_a($e, $type->getName(), true);
<<<<<<< .merge_file_hV0aMb
=======
    protected function handlesException(callable $handler, Throwable $e): bool
    {
        if ($handler instanceof Closure) {
            $reflection = new ReflectionFunction($handler);
        } else {
            $reflection = new ReflectionFunction(Closure::fromCallable($handler));
        }

        if (!($params = $reflection->getParameters())) {
            return false;
        }

        return ($params[0]->getClass() instanceof ReflectionClass) ? $params[0]->getClass()->isInstance($e) : true;
>>>>>>> laraxot/master
=======
>>>>>>> .merge_file_hYg3Kw
    }
}
