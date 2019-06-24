<?php


namespace App\Service;


class slugify
{
    public static function generate(string $input) : string
    {
        // replace non letter or digits by -
        $input = preg_replace('~[^\pL\d]+~u', '-', $input);

        $input = preg_replace('~[^-\w]+~', '', $input);
        // trim
        $input = trim($input, '-');
        // remove duplicated - symbols
        $input = preg_replace('~-+~', '-', $input);
        // lowercase
        $input = strtolower($input);
        if (empty($input)) {
            return 'NA';
        }
        
        return $input;
    }
}