<?php

namespace App\Traits;

trait HasNextPreviousTrait
{
    /**
     * Get the previous record.
     *
     * @param string $column
     * @param string|null $relationName
     * @param string|null $relationId
     * @return mixed
     */
    public function previous(string $column = 'created_at', ?string $relationName = null, ?string $relationId = null): mixed
    {
        return $this->newQuery()
            ->when($relationName, function ($query, $relationName) use ($relationId) {
                return $query->where("{$relationName}_id", $relationId);
            })
            ->where($column, '<', $this->getAttribute($column))
            ->orderBy($column, 'desc')
            ->first();
    }

    /**
     * Get the next record.
     *
     * @param string $column
     * @param string|null $relationName
     * @param string|null $relationId
     * @return mixed
     */
    public function next(string $column = 'created_at', ?string $relationName = null, ?string $relationId = null): mixed
    {
        return $this->newQuery()
            ->when($relationName, function ($query, $relationName) use ($relationId) {
                return $query->where("{$relationName}_id", $relationId);
            })
            ->where($column, '>', $this->getAttribute($column))
            ->orderBy($column, 'asc')
            ->first();
    }
}
