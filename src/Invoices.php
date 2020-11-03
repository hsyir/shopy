<?php


namespace Hsy\Store;

use Hsy\Store\Facades\Store;
use Hsy\Store\Models\Invoice;
use Gloudemans\Shoppingcart\Facades\Cart;
use Ramsey\Uuid\Uuid;

class Invoices
{

    private $query;

    private array $with = [];
    private array $withCount = [];
    public function __construct()
    {
        $this->reset();
    }

    public function reset(){
        $this->with = [];
        $this->withCount= [];
        $productModel = config("store.invoices.model");
        $this->query = $productModel::query();
        return $this;
    }

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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        $query = $this->query();
        return  $query->get();
    }

    /**
     * @param null $term
     * @param null $category_id
     * @param null $tags
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function paginate($count)
    {
        $query = $this->query();
        return $query->paginate($count);
    }

    public function with($relations)
    {
        if(is_array($relations))
        {
            array_merge($this->with,$relations);
            return $this;
        }

        $this->with[]=$relations;
        return $this;

    }

    public function withCount($relations)
    {
        if(is_array($relations))
        {
            array_merge($this->withCount,$relations);
            return $this;
        }

        $this->withCount[]=$relations;
        return $this;

    }


    public function getByUniqueCode($uniqueCode)
    {
        return Invoice::whereUniqueCode($uniqueCode)->first();
    }



}