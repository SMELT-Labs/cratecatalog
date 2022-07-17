<?php

namespace App\Models;

use App\Traits\HasPrices;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Laravel\Cashier\Cashier;
use Laravel\Scout\Searchable;
use Spatie\Comments\Models\Concerns\HasComments;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Box extends Model
{
    use HasFactory, HasComments, Searchable, HasSlug, HasPrices;

    protected $appends = [
        "detail",
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
        "detail"
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

    public function header() : Attribute {
        return $this->storageCast('header');
    }

    public function logo() : Attribute {
//        $this->header()->
        return $this->storageCast('logo');
    }
//
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
