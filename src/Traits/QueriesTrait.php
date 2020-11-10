<?php


namespace Hsy\Shopy\Traits;


trait QueriesTrait
{

    private $query;
    private array $with = [];
    private array $withCount = [];

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        $with = $this->with;

        return $this->query->with($with);
    }

    /**
     * @param null $term
     * @param null $category_id
     * @param null $tags
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        $query = $this->query();

        return $query->get();
    }

    /**
     * @param null $term
     * @param null $category_id
     * @param null $tags
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function paginate($count)
    {
        $query = $this->query();

        return $query->paginate($count);
    }

    public function with($relations)
    {
        if (is_array($relations)) {
            array_merge($this->with, $relations);

            return $this;
        }

        $this->with[] = $relations;

        return $this;
    }

    public function withCount($relations)
    {
        if (is_array($relations)) {
            array_merge($this->withCount, $relations);

            return $this;
        }

        $this->withCount[] = $relations;

        return $this;
    }

    public function withMedia()
    {
        $this->with[] = 'media';

        return $this;
    }

    public function withTags()
    {
        $this->with[] = 'tags';

        return $this;
    }

    public function hasAnyTags($tags)
    {
        $this->query = $this->query->withAnyTags($tags);

        return $this;
    }

    public function hasAllTags($tags)
    {
        $this->query = $this->query->withAllTags($tags);

        return $this;
    }

}