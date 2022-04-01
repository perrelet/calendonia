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

    protected $appends = ['injested', 'stars'];

    //

    public function getInjestedAttribute () {

        return $this->connection_id ? true : false;

    }

    public function getStarsAttribute () {

        if (!$this->importance || $this->importance < 1) {
            return "";
        } else if ($this->importance <= 1) {
            return "⭐";
        } else if ($this->importance <= 9) {
            return "⭐⭐";
        } else {
            return "⭐⭐⭐";
        }

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

    // STATIC

    public static function get_importance_options () {

        $importances = [];
        for ($i = 1; $i <= 9; $i++) $importances[$i] = $i;
        return $importances;

    }

    public static function get_type_options () {

        $types = [];

        $event_types = Event::distinct()->get(['type']);
        foreach ($event_types as $event_type) $types[$event_type->type] = $event_type->type;

        $types['SOMM'] = 'SOMM';

        return $types;

    }

    public static function get_virtual_options () {

        return [
            1 => 'Virtual',
            0 => 'Physical',
        ];

    }

    //

    public static function get_url_label () {

        return "Event page URL";

    }

    public static function get_virtual_label () {

        return "Is the event virtual or physical?";

    }

}
