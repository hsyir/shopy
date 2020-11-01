<?php

namespace Hsy\Store\Models;

use Gloudemans\Shoppingcart\CanBeBought;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\Tappable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia,Buyable
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;
    use HasTags;
    use InteractsWithMedia;
    use CanBeBought;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    private array $translatable = ["title", "body"];

    protected $fillable = ["title", "slug", "body", "price", "weight", "category_id","extra_data"];

    public function getTags()
    {
        return $this->tags->pluck("name")->toArray();
    }

    protected $casts = [
        "extra_data" => "array"
    ];
}
