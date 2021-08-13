<?php

namespace PG\Filter;

use Illuminate\Support\Facades\Request;
use RuntimeException;

trait Filter
{
    abstract public function getFilters();

    public function hasFilter($name)
    {
        $filters = $this->getFilters();

        if (array_key_exists($name, $filters)) {
            return true;
        }

        return false;
    }

    public function getFilter($name)
    {
        $filters = $this->getFilters();

        if (array_key_exists($name, $filters)) {
            return $filters[$name];
        }

        return null;
    }

    public function scopeFilter($query)
    {
        $params = Request::all();

        foreach ($params as $name => $value) {

            $filter = $this->getFilter($name);

            if (!$filter) {
                throw new RuntimeException('Could not found filter.');
            }

            $filter::apply($query, $value);
        }
    }
}
