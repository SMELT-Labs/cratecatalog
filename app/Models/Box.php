<?php

namespace App\Models;

use App\Traits\HasPrices;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Laravel\Cashier\Cashier;
use Laravel\Nova\Actions\Actionable;
use Laravel\Scout\Searchable;
use Spatie\Comments\Models\Concerns\HasComments;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

class Box extends Model
{
    use HasFactory, HasComments, Searchable, HasSlug, HasPrices, HasTags, Actionable;

    protected $appends = [
        "detail",
        "categories"
    ];

    protected $fillable = [
        "name",
        "website",
        "description",
        "short"
    ];

    protected $indexable = [
        "name",
        "short",
        "header",
        "logo",
        "detail",
        "categories"
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function searchableAs()
    {
        return config('app.env') . '_boxes';
    }

//    public function getRenderAttribute() {
//        return View::make('components.box', ["box" => $this])->render();
//    }

//    public function getHeaderAttribute() {
//        return Storage::url($this->header);
//    }

    private function storageCast($field) {
        return Attribute::make(
            get: function ($value, $attr) use ($field) {
                return isset($attr[$field]) ? Storage::url($attr[$field]) : null;
            }
        );
    }

    public function imgixCast($field, $width, $height) {
        return Attribute::make(
            get: function ($value, $attr) use ($field, $width, $height) {
                return isset($attr[$field]) ? imgix(Storage::url($attr[$field]), [
                    'h' => $height,
                    'w' => $width,
                    'fit' => 'crop',
                    'crop' => 'focalpoint',
                    'auto' => 'format,compress,enhance',
                ]) : null;
            }
        );
    }

    public function header() : Attribute {
        return $this->imgixCast('header', 450, 300);
    }

    public function logo() : Attribute {
        return $this->imgixCast('logo', 100, 100);
    }

//    public function price() : Attribute {
//        return Attribute::make(
//            get: function ($value, $attr) {
//                return Cashier::formatAmount((int) $attr['price'] * 100,
//                    config('cashier.currency'),
//                    config('cashier.currency_locale'),
//                    ['min_fraction_digits' => 0]
//                );
//            }
//        );
//    }

    public function getDetailAttribute() {
        return route('detail', ["box" => $this]);
    }

    public function getCategoriesAttribute() {
        return $this->tags->pluck("name")->join(",");
    }

    public function toArray()
    {
        return parent::toArray();
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize the data array...

        return array_intersect_key($array, array_flip($this->indexable));
    }

    public function commentableName(): string
    {
        return 'box';
    }

    public function commentUrl(): string
    {
        return $this->detail;
    }
}
