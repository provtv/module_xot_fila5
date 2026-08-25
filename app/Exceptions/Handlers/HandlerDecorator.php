<?php

declare(strict_types=1);

namespace Modules\Xot\Exceptions\Handlers;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class HandlerDecorator implements ExceptionHandler
{
<<<<<<< HEAD
   /**
=======
    /**
>>>>>>> laraxot/dev
     * The custom handlers reporting exceptions.
     *
     * @var array<int, callable>
     */
    protected array $reporters = [];

    /**
     * The custom handlers rendering exceptions.
     *
     * @var array<int, callable>
     */
    protected array $renderers = [];

    /**
     * The custom handlers rendering exceptions in console.
     *
     * @var array<int, callable>
     */
    protected array $consoleRenderers = [];

    public function __construct(
        protected ExceptionHandler $defaultHandler,
    ) {
    }

    /**
     * @param array<int, mixed> $parameters
     */
    public function __call(string $name, array $parameters): mixed
    {
        /** @var callable */
        $callable = [$this->defaultHandler, $name];

        return \call_user_func_array($callable, $parameters);
    }

    public function report(\Throwable $e): void
    {
<<<<<<< HEAD
       foreach ($this->getReportersByException($e) as $reporter) {
=======
        foreach ($this->getReportersByException($e) as $reporter) {
>>>>>>> laraxot/dev
            if (is_callable($reporter)) {
                $reporter($e);
            }
        }

        $this->defaultHandler->report($e);
    }

    public function render($request, \Throwable $e): SymfonyResponse
    {
<<<<<<< HEAD
       foreach ($this->getRenderersByException($e) as $renderer) {
=======
        foreach ($this->getRenderersByException($e) as $renderer) {
>>>>>>> laraxot/dev
            if (is_callable($renderer)) {
                $response = $renderer($e, $request);
                if ($response instanceof SymfonyResponse) {
                    return $response;
                }
            }
        }

        return $this->defaultHandler->render($request, $e);
    }

<<<<<<< HEAD
   public function renderForConsole($output, \Throwable $e): void
=======
    public function renderForConsole($output, \Throwable $e): void
>>>>>>> laraxot/dev
    {
        foreach ($this->getConsoleRenderersByException($e) as $renderer) {
            if (is_callable($renderer)) {
                $renderer($e, $output);
            }
        }

<<<<<<< HEAD
       $this->__call('renderForConsole', [$output, $e]);
=======
        $this->__call('renderForConsole', [$output, $e]);
>>>>>>> laraxot/dev
    }

    public function reporter(callable $reporter): int
    {
<<<<<<< HEAD
       return $this->addReporter($reporter);
=======
        return $this->addReporter($reporter);
>>>>>>> laraxot/dev
    }

    public function renderer(callable $renderer): int
    {
<<<<<<< HEAD
       return $this->addRenderer($renderer);
=======
        return $this->addRenderer($renderer);
>>>>>>> laraxot/dev
    }

    public function consoleRenderer(callable $renderer): int
    {
<<<<<<< HEAD
       return $this->addConsoleRenderer($renderer);
=======
        return $this->addConsoleRenderer($renderer);
>>>>>>> laraxot/dev
    }

    /**
     * Register a custom handler to report exceptions.
     */
    private function addReporter(callable $reporter): int
    {
        return array_unshift($this->reporters, $reporter);
    }

    /**
     * Register a custom handler to render exceptions.
     */
    private function addRenderer(callable $renderer): int
    {
        return array_unshift($this->renderers, $renderer);
    }

    /**
     * Register a custom handler to render exceptions in console.
     */
    private function addConsoleRenderer(callable $renderer): int
    {
        return array_unshift($this->consoleRenderers, $renderer);
    }

    /**
     * Retrieve all reporters handling the given exception.
     *
     * @return array<int, callable>
     */
    private function getReportersByException(\Throwable $e): array
    {
        return array_filter(
            $this->reporters,
            fn (callable $handler): bool => $this->handlesException($handler, $e),
        );
    }

    /**
     * Retrieve all renderers handling the given exception.
     *
     * @return array<int, callable>
     */
    private function getRenderersByException(\Throwable $e): array
    {
        return array_filter(
            $this->renderers,
            fn (callable $handler): bool => $this->handlesException($handler, $e),
        );
    }

    /**
     * Retrieve all console renderers handling the given exception.
     *
     * @return array<int, callable>
     */
    private function getConsoleRenderersByException(\Throwable $e): array
    {
        return array_filter(
            $this->consoleRenderers,
            fn (callable $handler): bool => $this->handlesException($handler, $e),
        );
    }

    public function shouldReport(\Throwable $e): bool
    {
        return $this->defaultHandler->shouldReport($e);
    }
<<<<<<< HEAD
=======

>>>>>>> laraxot/dev
    /**
     * Determine whether the given handler can handle the provided exception.
     */
    protected function handlesException(callable $handler, \Throwable $e): bool
    {
        $reflection = new \ReflectionFunction(
            $handler instanceof \Closure ? $handler : \Closure::fromCallable($handler),
        );

        if (! ($params = $reflection->getParameters())) {
            return false;
        }

        $type = $params[0]->getType();

        if (! $type instanceof \ReflectionNamedType || $type->isBuiltin()) {
            return true;
        }

        $class = $type->getName();

        return $e instanceof $class;
    }
}
