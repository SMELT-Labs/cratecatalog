<?php

namespace App\Traits;

use App\Models\Price;
use App\Models\Social;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Sociable  {

    public function sociables(): MorphMany {
        return $this->morphMany(Social::class, 'sociable');
    }

}
