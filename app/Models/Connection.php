<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Utils\TagUtils;

class Connection extends Model
{
    use HasFactory;

    protected $casts = [
        'tags' => 'array',
    ];

    protected function tags() : Attribute {

        return new Attribute(
            //get: fn ($value) => TagUtils::parse($this->castAttribute('tags', $value)),
            get: fn ($value) => $this->castAttribute('tags', $value),
        );

    }

}
