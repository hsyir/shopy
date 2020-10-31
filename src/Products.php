<?php


namespace Hsy\Store;


use Hsy\Store\Models\Product;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class Products
{
    private $query;

    private $perPage = 100;
    private array $with = [];

    public function __construct()
    {
        $this->reset();
    }

    public function reset(){
        $this->perPage = 100;
        $this->with = [];
        $this->query = Product::query();
        return $this;
    }

    /**
     * @param $data
     * @param Product $product
     * @return Product
     */
    public function store($data, $product = null)
    {
        $productModel = config("store.products.model");
        $product = ($product instanceof $productModel) ? $product : new $productModel;

        $product->fill($data);
        $product->save();
        if (isset($data["tags"]) and is_array($data["tags"]))
            $product->attachTags($data["tags"]);

        if (isset($data["cover_image"]))
            $product->addMediaFromRequest("cover_image")->toMediaCollection("cover_image");

        return $product;

    }

    /**
     * @param Product $product
     * @param string $requestKey
     * @param string $collection
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function addMediaFromRequest($product, $requestKey = "cover_image", $collection = "cover_image")
    {
        $product->addMediaFromRequest($requestKey)->toMediaCollection($collection);
    }


    /**
     * @param null $term
     * @param null $category_id
     * @param null $tags
     * @return Product
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
        return ($this->perPage === false) ? $query->get() : $query->paginate($this->perPage);
    }

    /**
     * @param $count
     * @return $this
     */
    public function perPage($count): Products
    {
        $this->perPage = $count;
        return $this;
    }

    /**
     * @return $this
     */
    public function withoutPagination(): Products
    {
        $this->perPage = false;
        return $this;
    }


    public function withMedias()
    {
        $this->with[] = "media";
        return $this;
    }


    public function withTags()
    {
        $this->with[] = "tags";
        return $this;
    }

    public function priceGreaterThan($price)
    {
        $this->query = $this->query->where("price", ">=", $price);
        return $this;
    }

    public function priceLessThan($price)
    {
        $this->query = $this->query->where("price", "<=", $price);
        return $this;
    }

    public function priceEqual($price)
    {
        $this->query = $this->query->where("price", "=", $price);
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

    public function filter($term)
    {
        $this->query = $this->query->where(function ($q) use ($term) {
            return $q->where("title", "LIKE", "%{$term}%")
                ->orWhere("body", "LIKE", "%{$term}%");
        });
        return $this;
    }

}