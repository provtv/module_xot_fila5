<?php

/**
 * ---.
 *
 * @see https://github.com/johnnyfreeman/laravel-custom-relation/blob/master/src/Relations/Custom.php
 */

declare(strict_types=1);

namespace Modules\Xot\Relations;

<<<<<<< HEAD
=======
use Exception;
>>>>>>> laraxot/master
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Webmozart\Assert\Assert;

<<<<<<< HEAD
/**
 * Class CustomRelation.
 *
 * @extends Relation<Model, Model, Collection<int, Model>>
 *
 * @method Builder<Model> when(mixed $value = null, ?callable $callback = null, ?callable $default = null)
 * @method Builder<Model> whereBetween(string $column, iterable<int, mixed> $values, string $boolean = 'and', bool $not = false)
 * @method Builder<Model> selectRaw(string $expression, array<int|string, mixed> $bindings = [])
 * @method Builder<Model> where(string|\Closure|\Illuminate\Contracts\Database\Query\Expression $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
=======
use function call_user_func;

/**
 * Class CustomRelation.
 *
 * @method static Builder when($value = null, callable $callback = null, callable $default = null)
 * @method static Builder whereBetween($column, iterable<int, mixed> $values, $boolean = 'and', $not = false)
 * @method static Builder selectRaw($expression, array<int, mixed> $bindings = []) ;
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
>>>>>>> laraxot/master
 */
class CustomRelation extends Relation
{
    /**
     * Create a new belongs to relationship instance.
     */
    public function __construct(
        Builder $query,
        Model $model,
        /* implements BuilderContract */
        /**
         * The baseConstraints callback.
         */
        protected Closure $baseConstraints,
        /**
         * The eagerConstraints callback.
         */
<<<<<<< HEAD
        protected ?Closure $eagerConstraints,
        /**
         * The eager constraints model matcher.
         */
        protected ?Closure $eagerMatcher,
=======
        protected null|Closure $eagerConstraints,
        /**
         * The eager constraints model matcher.
         */
        protected null|Closure $eagerMatcher,
>>>>>>> laraxot/master
    ) {
        parent::__construct($query, $model);
    }

    /**
     * Set the base constraints on the relation query.
     */
    public function addConstraints(): void
    {
        \call_user_func($this->baseConstraints, $this);
    }

    /**
     * Set the constraints for an eager load of the relation.
     */
<<<<<<< HEAD
    /**
     * @param  array<int, Model>  $models
     */
    public function addEagerConstraints(array $models): void
    {
        // Parameter #1 $function of function call_user_func expects callable(): mixed, Closure|null given.
        if (! \is_callable($this->eagerConstraints)) {
            throw new \Exception('eagerConstraints is not callable');
=======
    public function addEagerConstraints(array $models): void
    {
        // Parameter #1 $function of function call_user_func expects callable(): mixed, Closure|null given.
        if (!\is_callable($this->eagerConstraints)) {
            throw new Exception('eagerConstraints is not callable');
>>>>>>> laraxot/master
        }

        \call_user_func($this->eagerConstraints, $this, $models);
    }

    /**
     * Initialize the relation on a set of models.
<<<<<<< HEAD
     */
    /**
     * @param  array<int, Model>  $models
     * @return array<int, Model>
     */
    public function initRelation(array $models, mixed $relation): array
    {
        if (! \is_string($relation)) {
            throw new \Exception('relation is not a string');
        }

=======
     *
     * @param  string  $relation
     */
    public function initRelation(array $models, $relation): array
    {
>>>>>>> laraxot/master
        foreach ($models as $model) {
            $model->setRelation($relation, $this->related->newCollection());
        }

        return $models;
    }

    /**
     * Match the eagerly loaded results to their parents.
     *
<<<<<<< HEAD
     * @return array<int, Model>
     */
    /**
     * @param  array<int, Model>  $models
     * @param  Collection<int, Model>  $collection
     * @return array<int, Model>
     */
    public function match(array $models, Collection $collection, mixed $relation): array
    {
        // Trying to invoke Closure|null but it might not be a callable.
        if (! \is_callable($this->eagerMatcher)) {
            throw new \Exception('eagerMatcher is not callable');
        }

        $res = ($this->eagerMatcher)($models, $collection, $relation, $this);
        Assert::isArray($res);
        Assert::allIsInstanceOf($res, Model::class);

        /** @var array<int, Model> $models */
        $models = array_values($res);

        return $models;
=======
     * @param  string  $relation
     * @return array<int, Model>
     */
    public function match(array $models, Collection $collection, $relation): array
    {
        // Trying to invoke Closure|null but it might not be a callable.
        if (!\is_callable($this->eagerMatcher)) {
            throw new Exception('eagerMatcher is not callable');
        }

        Assert::isArray($res = ($this->eagerMatcher)($models, $collection, $relation, $this));

        // @phpstan-ignore return.type
        return $res;
>>>>>>> laraxot/master
    }

    /**
     * Get the results of the relationship.
     *
     * @return Collection<int, Model>
     */
<<<<<<< HEAD
    public function getResults(): Collection
=======
    public function getResults()
>>>>>>> laraxot/master
    {
        return $this->get();
    }

    /**
     * Execute the query as a "select" statement.
<<<<<<< HEAD
     */
    /**
     * @param  array<int, string>|string  $columns
     * @return Collection<int, Model>
=======
     *
     * @param  array<int, string>  $columns
>>>>>>> laraxot/master
     */
    public function get($columns = ['*']): Collection
    {
        // First we'll add the proper select columns onto the query so it is run with
        // the proper columns. Then, we will get the results and hydrate out pivot
        // models with the result of those columns as a separate model relation.
        $columns = $this->query->getQuery()->columns ? [] : $columns;
        if ($columns === ['*']) {
<<<<<<< HEAD
            $columns = [$this->related->getTable().'.*'];
=======
            $columns = [$this->related->getTable() . '.*'];
>>>>>>> laraxot/master
        }

        $query = $this->query->applyScopes();
        $models = $query->addSelect($columns)->getModels();
        // If we actually found models we will also eager load any relationships that
        // have been specified as needing to be eager loaded. This will solve the
        // n + 1 query problem for the developer and also increase performance.
        if ((is_countable($models) ? \count($models) : 0) > 0) {
            $models = $query->eagerLoadRelations($models);
        }

<<<<<<< HEAD
        Assert::isArray($models);
        Assert::allIsInstanceOf($models, Model::class);

        /* @var array<int, Model> $models */
=======
>>>>>>> laraxot/master
        return $this->related->newCollection($models);
    }

    /*
     * Add a basic where clause to the query.
     *
     * @param \Closure|string|array|\Illuminate\Database\Query\Expression $column
     * @param mixed                                                       $operator
     * @param mixed                                                       $value
     * @param string $boolean
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public function where($column, $operator = null, $value = null, $boolean = 'and') {
    //    return $this->query->where($column, $operator, $value, $boolean);
    // }
}
