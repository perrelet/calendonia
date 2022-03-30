<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Utils\TagUtils;
use Spatie\Tags\HasTags;

use ArrayAccess;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Tags\Tag;

class Event extends Model
{
    use HasFactory, HasTags;

    protected $guarded = ['id'];

    protected $casts = [
        /* 'tags' => 'array', */
        'links' => 'array',
        'medias' => 'array',
        'organisers' => 'array',
        'artists' => 'array',
        'contact_other' => 'array',
        'tickets' => 'array',
        'meta' => 'array',
    ];

    protected $appends = ['injested'];

    //

    public function getInjestedAttribute () {

        return $this->connection_id ? true : false;

    }

    //

    public function scopeWithoutTags(
        Builder $query,
        array | ArrayAccess | Tag $tags,
        string $type = null,
    ): Builder {

        $tags = static::convertToTags($tags, $type);
        $tagIds = collect($tags)->whereNotNull()->pluck('id');
        if ($tagIds->isEmpty()) return $query;
        $tagIds = Tag::all()->pluck('id')->diff($tagIds);

        collect($tagIds)->each(function ($tag) use ($query) {
            $query->whereHas('tags', function (Builder $query) use ($tag) {
                $query->where('tags.id', $tag);
            });
        });

        return $query; 
    }

    /* protected function tags() : Attribute {

        return new Attribute(
            get: fn ($value) => TagUtils::parse($this->castAttribute('tags', $value)),
            //set: fn ($value) => ($value instanceof \Illuminate\Support\Collection) ? $value : TagUtils::parse($value), 
        );

    } */

    //

    /* protected function get_primary_tag () {

        return $this->tags[0];

    } */

    public function get_start_date ($format = "Y-m-d H:i:s") {

        $datetime = new \DateTime($this->start_date, new \DateTimeZone($this->timezone));
        //if () $datetime->setTimezone(new \DateTimeZone('Pacific/Chatham'))
        return $datetime->format($format);
        
    }

}
