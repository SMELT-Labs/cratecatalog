<?php

namespace App\Traits;

use App\Models\Price;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasPrices  {

    public function initializeHasPrices () {
        $this->appends = array_merge($this->appends, [
            "priceRange",
            "priceCount",
            "minPrice",
            "maxPrice",
        ]);

        $this->indexable = array_merge($this->indexable, [
            "priceRange",
            "priceCount",
            "minPrice",
            "maxPrice",
        ]);
    }

    public function prices(): MorphMany {
        return $this->morphMany(Price::class, 'priceable');
    }

    public function getHasPricesAttribute() {
        return  $this->prices->count() > 0;
    }

    public function getPriceCountAttribute() {
        return  $this->prices->count();
    }

    public function getMinPriceAttribute() {
        return $this->prices()->orderBy('price')->first()?->formatted;
    }

    public function getMaxPriceAttribute() {
        return $this->prices()->orderByDesc('price')->first()?->formatted;
    }

    public function getPriceRangeAttribute() {
        $count = $this->priceCount;
        if ($count <= 0) return "-";
        if ($count === 1) return $this->minPrice;
        else return $this->minPrice . " - " . $this->maxPrice;
    }
}
