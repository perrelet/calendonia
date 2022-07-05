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

    public function get_date_obj ($date_string, $timezone = null) {

        if (!$date_string) return;
        $date = new \DateTime($date_string, new \DateTimeZone($this->timezone));
        if ($timezone) $date->setTimeZone(new \DateTimeZone($timezone));
        return $date;

    }

    public function get_start_obj ($timezone = null) {

        return $this->get_date_obj($this->start_date, $timezone);

    }

    public function get_end_obj ($timezone = null) {

        return $this->get_date_obj($this->end_date, $timezone);

    }

    public function get_start_date ($format = "Y-m-d H:i:s", $timezone = null) {

        return $this->start_date ? $this->get_start_obj($timezone)->format($format) : null;
        //if () $datetime->setTimezone(new \DateTimeZone('Pacific/Chatham'))
        
    }

    public function get_end_date ($format = "Y-m-d H:i:s", $timezone = null) {

        return $this->end_date ? $this->get_end_obj($timezone)->format($format) : null;
        
    }

    public function get_time_range ($timezone = null) {

        $start_obj = $this->get_start_obj($timezone);

        if ($this->end_date) {

            // Has End...

            $end_obj = $this->get_end_obj($timezone);

            if ($start_obj->format("Y-m-d") == $end_obj->format("Y-m-d")) {

                // Same Day...

                if ($start_obj->format("a") == $end_obj->format("a")) {

                    return $start_obj->format("h:i") . " - " . $end_obj->format("h:i a") . " " . $start_obj->format("T");

                } else {

                    return $start_obj->format("h:i a") . " - " . $end_obj->format("h:i a") . " " . $start_obj->format("T");

                }

            } else {

                if ($start_obj->format("m") == $end_obj->format("m")) {

                    return $start_obj->format("j") . " - " . $end_obj->format("j M");

                } else {

                    return $start_obj->format("j M") . " - " . $end_obj->format("j M");

                }

                

                // Longer than a Day...

                /* $end_midnight = clone $end_obj;
                $end_midnight->setTime(23,59);
                $interval = $end_midnight->modify("+1 days")->diff($start_obj);
                $days = $interval->format("%a");

                if ($days < 14) {

                    return "{$days} days";

                } else {

                    $weeks = round($days / 7);
                    return "{$weeks} weeks";

                } */

            }
 
        } else {

            return $start_obj->format("h:i a T");

        }

        //$start_day = $this->get_start_date("Y-m-d");
       //$start_day = $this->get_end_date("Y-m-d");

    }

    public function get_thumb ($default = "img/default-thumb.jpg") {

        return $this->attributes['thumb'] ? $this->attributes['thumb'] : $default;

    }

    public function get_location () {

        if ($this->virtual)     return "Online";
        if ($this->venue)       return $this->venue;
        if ($this->address_3)   return $this->address_3;
        if ($this->country)     return $this->country;
        if ($this->address_2)   return $this->address_2;
        if ($this->address_1)   return $this->address_1;

        return null;

    }

    public function get_url ($type = false) {

        switch ($type) {
            case "access":
                return $this->access_url ? $this->access_url : $this->url;
            case "admin":
                return $this->admin_url ? $this->admin_url : $this->url;
        }

        return $this->url;

    }

    /* public function get_url () {

        return 

    } */

    public function to_full_calendar () {

        $classes = ["type-" . str($this->type)->slug()];

        //'auto', 'block', 'list-item', 'background', 'inverse-background', or 'none'

        foreach ($this->tags as $tag) $classes[] = "tag-{$tag->slug}";

        return [
            'id' => $this->id,
            'groupId' => null,
            'allDay' => null,
            'start' => $this->get_start_date("Y-m-d"),
            'end' => $this->get_end_date("Y-m-d"),
            'title' => $this->title,
            'url' => $this->url,
            'classNames' => $classes,
            'editable' => false,
            'display' => 'auto',
            // 'overlap' => $this->,
            // 'constraint' => $this->,
            // 'backgroundColor' => null,
            // 'borderColor' => null,
            // 'textColor' => null,
        ];

    }

    // STATIC METHODS

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
