<?php


namespace App\Http\Traits;


use Illuminate\Support\Str;

trait HasFiltersWithPagination
{

    function __call($func, $params)
    {
        if (Str::startsWith("updated", $func) && in_array($params[0], $this->filters) && (in_array("App\Http\Traits\WithPagination", (new \ReflectionClass(self::class))->getTraitNames()))) {
            $this->gotoPage(1);
        }
    }
}