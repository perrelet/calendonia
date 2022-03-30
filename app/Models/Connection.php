<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Utils\TagUtils;

class Connection extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tags' => 'array',
    ];

    protected $appends = ['status'];

    protected function tags() : Attribute {

        return new Attribute(
            //get: fn ($value) => TagUtils::parse($this->castAttribute('tags', $value)),
            get: fn ($value) => $this->castAttribute('tags', $value),
        );

    }

    //

    public function getStatusAttribute () {

        return !$this->error;

    }

    //

    public static function get_status_options () {

        return [
            1 => 'Enabled',
            0 => 'Disabled',
        ];

    }

}
