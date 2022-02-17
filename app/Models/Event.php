<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Utils\TagUtils;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tags' => 'array',
        'links' => 'array',
        'medias' => 'array',
        'organisers' => 'array',
        'artists' => 'array',
        'contact_other' => 'array',
        'tickets' => 'array',
        'meta' => 'array',
    ];

    public function brand (Connection $connection) {

        $this->connection_id = $connection->id;
        if ($connection->tags) $this->tags = $this->tags ? $this->tags->merge($connection->tags)->unique('slug') : $connection->tags;
        //$this->tags = null;

    }

    public function get_start_date ($format = "Y-m-d H:i:s") {

        return \DateTime::createFromFormat("Y-m-d H:i:s", $this->start_date)->format($format);

    }

    protected function tags() : Attribute {

        return new Attribute(
            get: fn ($value) => TagUtils::parse($this->castAttribute('tags', $value)),
            /* set: fn ($value) => ($value instanceof \Illuminate\Support\Collection) ? $value : TagUtils::parse($value), */
        );

    }

}
