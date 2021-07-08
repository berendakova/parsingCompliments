<?php


$url = 'https://xochew.ru';
$pages = [74,6261,6263,5913,];

foreach ($pages as $page)
{
    libxml_use_internal_errors(true);
    $urlPage = $url . '/?p=' . $page;
    $html = file_get_contents($urlPage);
    $dom = new DOMDocument();
    $dom->loadHTML($html);

    $categoryNames = $dom->getElementsByTagName('h1');
    foreach ($categoryNames as $name)
    {
        \Illuminate\Support\Facades\DB::table('categories')->insert(['name' => $name]);

    }

}