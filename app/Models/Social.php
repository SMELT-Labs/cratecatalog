<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    protected $fillable = [
        "service",
        "identifier",
        "name",
        "username",
        "email",
        "avatar",
        "user",
    ];

    public function item() {
        return $this->morphTo('sociable');
    }
}
