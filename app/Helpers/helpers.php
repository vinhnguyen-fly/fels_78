<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

if (!function_exists('short_time')) {
    function short_time($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y/m/d');
    }
}

if (!function_exists('full_time')) {
    function full_time($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y/m/d, H:i:s');
    }
}

if (!function_exists('humans_time')) {
    function humans_time($timestamp)
    {
        return Carbon::parse($timestamp)->diffForHumans();
    }
}

if (!function_exists('remaining_days')) {
    function remaining_days($finish)
    {
        $count = (int)Carbon::now()->diffInDays(Carbon::parse($finish));
        $plural = str_plural('day', $count);

        return "{$count} {$plural} remaining";
    }
}

if (!function_exists('error_text')) {
    function error_text(ViewErrorBag $errors, $field)
    {
        $html = '<span class="help-block form-error-text">:message</span>';
        if ($errors->has($field)) {
            return $errors->first($field, $html);
        }
    }
}

if (!function_exists('plural')) {
    function plural($pattern, $counter)
    {
        if (!is_numeric($counter)) {
            throw new InvalidArgumentException;
        }
        $str = str_plural($pattern, $counter);

        return "{$counter} {$str}";
    }
}

if (!function_exists('plural2')) {
    function plural2($pattern, $middle, $counter)
    {
        if (!is_numeric($counter)) {
            throw new InvalidArgumentException;
        }
        $plural = str_plural($pattern, $counter);

        return "{$counter} {$middle} {$plural}";
    }
}

if (!function_exists('counting')) {
    function counting($object)
    {
        if (!($object instanceof Collection
            || $object instanceof LengthAwarePaginator)
        ) {
            throw new InvalidArgumentException;
        }

        if ($object instanceof LengthAwarePaginator) {
            return $object->total();
        }

        return $object->count();
    }
}

if (!function_exists('blank')) {
    function blank($object)
    {
        if (!($object instanceof Collection
            || $object instanceof LengthAwarePaginator)
        ) {
            throw new InvalidArgumentException;
        }

        return $object->isEmpty();
    }
}

if (!function_exists('paginate')) {
    function paginate($collection, array $queries = null)
    {
        if (!$queries) {
            $links = $collection->render();
        } else {
            $links = $collection->appends($queries)->render();
        }

        return "<div class=\"text-center\">{$links}</div>";
    }
}

if (!function_exists('validate_query_string')) {
    function validate_query_string($query, array $queries)
    {
        return $query && in_array($query, $queries);
    }
}

if (!function_exists('verify_session_key')) {
    function verify_session_key($key, $value)
    {
        if (!session()->has($key)) {
            return false;
        }

        if (session($key) === $value) {
            return true;
        }

        return false;
    }
}

if (!function_exists('fetch_static_attributes')) {
    function fetch_static_attributes($class, array $attributes)
    {
        $results = [];
        $reflection = new ReflectionClass($class);
        foreach ($attributes as $attribute => $default) {
            if ($reflection->hasProperty($attribute)) {
                $property = $reflection->getProperty($attribute);
                $property->setAccessible(true);
                if ($property && $property->isStatic()) {
                    $results[] = $property->getValue();
                }
            } else {
                $results[] = $default;
            }
        }

        return $results;
    }
}

if (!function_exists('array_random_val')) {
    function array_random_val(array $arr)
    {
        return $arr[array_rand($arr)];
    }
}

if (!function_exists('clear_pattern')) {
    function clear_pattern($pattern, $source)
    {
        return str_replace($pattern, '', $source);
    }
}

if (!function_exists('percentage')) {
    function percentage($completed, $total)
    {
        return round($completed / $total * 100) . '%';
    }
}
