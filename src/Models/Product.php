<?php

namespace Hsy\Shopy\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Hsy\Shopy\Facades\Shopy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia, Buyable
{
    use HasFactory;
    use HasTranslations;
    use Sluggable;
    use HasTags;
    use InteractsWithMedia;

    private array $translatable = ['name', 'description'];

    protected $fillable = ['name', 'slug', 'description', 'price', 'weight', 'category_id', 'extra_data'];

    public function getTags()
    {
        return $this->tags->pluck('name')->toArray();
    }

    protected $casts = [
        'extra_data' => 'array',
    ];

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    public function getBuyableWeight($options = null)
    {
        return $this->weight ?: 0;
    }

    public function addToCart($quantity = 1)
    {
        Shopy::cart()->add($this, $quantity);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection("cover_image")->singleFile();
    }
}
