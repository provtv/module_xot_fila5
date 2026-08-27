<?php

declare(strict_types=1);

namespace Modules\Xot\Exceptions\Handlers;

<<<<<<< HEAD
=======
use Throwable;
>>>>>>> laraxot/master
use Illuminate\Contracts\Debug\ExceptionHandler;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class HandlerDecorator implements ExceptionHandler
{
<<<<<<< HEAD
    /**
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
=======
    protected HandlersRepository $repository;

    public function __construct(
        protected ExceptionHandler $defaultHandler,
        HandlersRepository $repository,
    ) {
        $this->repository = $repository;
    }

>>>>>>> laraxot/master
    public function __call(string $name, array $parameters): mixed
    {
        /** @var callable */
        $callable = [$this->defaultHandler, $name];

        return \call_user_func_array($callable, $parameters);
    }

<<<<<<< HEAD
    public function report(\Throwable $e): void
    {
        foreach ($this->getReportersByException($e) as $reporter) {
=======
    public function report(Throwable $e): void
    {
        foreach ($this->repository->getReportersByException($e) as $reporter) {
>>>>>>> laraxot/master
            if (is_callable($reporter)) {
                $reporter($e);
            }
        }

        $this->defaultHandler->report($e);
    }

<<<<<<< HEAD
    public function render($request, \Throwable $e): SymfonyResponse
    {
        foreach ($this->getRenderersByException($e) as $renderer) {
=======
    public function render($request, Throwable $e): SymfonyResponse
    {
        foreach ($this->repository->getRenderersByException($e) as $renderer) {
>>>>>>> laraxot/master
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
    {
        foreach ($this->getConsoleRenderersByException($e) as $renderer) {
=======
    /**
     * @phpstan-ignore-next-line
     */
    public function renderForConsole($output, Throwable $e): void
    {
        foreach ($this->repository->getConsoleRenderersByException($e) as $renderer) {
>>>>>>> laraxot/master
            if (is_callable($renderer)) {
                $renderer($e, $output);
            }
        }

<<<<<<< HEAD
        $this->__call('renderForConsole', [$output, $e]);
=======
        /** @phpstan-ignore-next-line */
        $this->defaultHandler->renderForConsole($output, $e);
>>>>>>> laraxot/master
    }

    public function reporter(callable $reporter): int
    {
<<<<<<< HEAD
        return $this->addReporter($reporter);
=======
        return $this->repository->addReporter($reporter);
>>>>>>> laraxot/master
    }

    public function renderer(callable $renderer): int
    {
<<<<<<< HEAD
        return $this->addRenderer($renderer);
=======
        return $this->repository->addRenderer($renderer);
>>>>>>> laraxot/master
    }

    public function consoleRenderer(callable $renderer): int
    {
<<<<<<< HEAD
        return $this->addConsoleRenderer($renderer);
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

        return is_a($e, $type->getName(), true);
    }
=======
        return $this->repository->addConsoleRenderer($renderer);
    }

    public function shouldReport(Throwable $e): bool
    {
        return $this->defaultHandler->shouldReport($e);
    }
>>>>>>> laraxot/master
}
