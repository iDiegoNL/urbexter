<?php

namespace App\Actions\BladeIcons;

use Illuminate\Support\Collection;

class GetAvailableIcons
{
    /**
     * Get the available icons from a Blade Icons icon package.
     *
     * @param string $directory
     * @param string $componentPrefix
     * @return Collection
     */
    public function execute(string $directory, string $componentPrefix): Collection
    {
        // Scan the directory for files and directories
        $result = scandir(base_path($directory));

        // Collect the result
        $result = collect($result);

        // Filter out any entry that doesn't end with .svg
        $result = $result->filter(function ($value) {
            return str_ends_with($value, '.svg');
        });

        // Remove the .svg extension from each entry
        $result = $result->map(function ($value) {
            return str_replace('.svg', '', $value);
        });

        // Add the icon pack component prefix name to each entry
        $result = $result->map(function ($value) use ($componentPrefix) {
            return $componentPrefix . '-' . $value;
        });

        // Use the values as the keys, and return them
        return $result->mapWithKeys(function ($value) {
            return [$value => $value];
        });
    }
}
