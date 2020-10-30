<?php


namespace Hsy\Store;


use Hsy\Store\Models\Product;
use Illuminate\Support\Collection;

class Products
{
    private int $perPage = 100;

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
    public function filterQuery($term = null, $category_id = null, $tags = null): Product
    {
        return Product
            ::when(!is_null($term), function ($q) use ($term) {
                return $q->where("title", "like", "%{$term}%")
                    ->where("body", "like", "%{$term}%");
            })
            ->when(!is_null($category_id), function ($q) use ($category_id) {
                return $q->whereCategoryId($category_id);
            })
            ->when(!is_null($tags), function ($q) use ($tags) {
                return $q->withAnyTags($tags);
            });
    }

    /**
     * @param null $term
     * @param null $category_id
     * @param null $tags
     * @return Collection
     */
    public function filter($term = null, $category_id = null, $tags = null): Collection
    {
        $query = $this->filterQuery($term, $category_id, $tags);
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


}