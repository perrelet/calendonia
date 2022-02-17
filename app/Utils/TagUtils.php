<?php

namespace App\Utils;

class TagUtils {

    static function parse ($data) {

        $tags = [];

        if ($data) foreach ($data as $tag_data) {

            $tags[] = self::struct($tag_data);

        }

        return collect($tags)->unique('slug');

    }

    static function struct ($tag_data) {

        if (is_array($tag_data)) {

            $name = isset($tag_data['name']) ? $tag_data['name'] : null;

        } else {

            $name = null;
            $slug = $tag_data;

        }

        if (!$name) $name = ucwords(str_replace('-', ' ', $slug));

        return [
            'name' => $name,
            'slug' => $slug,
        ];
            

    }

}
