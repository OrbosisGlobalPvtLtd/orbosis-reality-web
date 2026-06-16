<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model {
    protected $fillable = ['translatable_type', 'translatable_id', 'lang_code', 'key', 'value'];

    // Morph relationship for the parent model
    public function translatable() {
        return $this->morphTo();
    }
}

