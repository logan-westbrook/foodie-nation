<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Throwable;

class UpdaterModel extends Model
{
    public function saveModel(): ?static
    {
        try {
            $this->save();
        } catch (Throwable $t) {
            error_log("Error updating user: {$t->getMessage()}");

            return null;
        }

        return $this;
    }

    static function createNewModel()
    {
        return new static();
    }
}
