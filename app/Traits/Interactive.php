<?php

namespace App\Traits;

use App\Events\Interaction;

trait Interactive {

    public function interact(string $type, array $data = []) {
        Interaction::dispatch($type, $this, $data);
    }

}
