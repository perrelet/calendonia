<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        if ($connection->tags) $this->tags = $this->tags ? array_merge($this->tags, $connection->tags) : $connection->tags;
        //$this->tags = null;

    }

}
