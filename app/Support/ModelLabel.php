<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;

/**
 * Reads a display name from a model without assuming what its name column is called.
 * Change the candidate lists below if your tables use something else.
 */
final class ModelLabel
{
    /** @var list<string> */
    public const LOCALITY = ['locality_name', 'name'];

    /** @var list<string> */
    public const DISTRICT = ['district_name', 'name'];

    /**
     * @param  list<string>  $columns  Candidate columns, most likely first.
     */
    public static function of(?Model $model, array $columns): ?string
    {
        if ($model === null) {
            return null;
        }

        $attributes = $model->getAttributes();

        foreach ($columns as $column) {
            $value = $attributes[$column] ?? null;

            if (is_string($value) && $value !== '') {
                return $value;
            }
        }

        return null;
    }
}
