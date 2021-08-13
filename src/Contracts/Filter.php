<?php

namespace PG\Filter\Contracts;

interface Filter
{
    public static function apply($query, $value);
}
