<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Cashier;

class Price extends Model
{
    use HasFactory;

    public function item() {
        return $this->morphTo('priceable');
    }

    public function getFormattedAttribute() {
        return Cashier::formatAmount((int) $this->price * 100,
            config('cashier.currency'),
            config('cashier.currency_locale'),
            ['min_fraction_digits' => 0]
        );
    }
}
