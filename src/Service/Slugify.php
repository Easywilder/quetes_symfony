<?php


namespace App\Service;


class Slugify
{
    public function generate(string $slug): string
    {
        $caracteres = [ 'ç' => 'c', 'Ç' => 'c', ' ' => '-', 'À' => 'a', 'Á' => 'a', 'Â' => 'a', 'Ä' => 'a',
            'à' => 'a', 'á' => 'a', 'ä' => 'a', '$' => '', "'" => '',
            'È' => 'e', 'É' => 'e', 'Ê' => 'e', 'Ë' => 'e', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
            'Ì' => 'i', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Ö' => 'o', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'ö' => 'o',
            'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
            'Œ' => 'oe', 'œ' => 'oe', '?' => '','!' => '',',' => '','.' => '',':' => '',';' => ''];
        $result = str_replace(array_keys($caracteres), array_values($caracteres), $slug);
        $result = preg_replace ('/[0-9]+/', '', $result);
        $result = preg_replace ('/[-{2,}]+/', '-', $result);
        $slug = strtolower (trim (strip_tags ($result)));

        return $slug;
    }
}
