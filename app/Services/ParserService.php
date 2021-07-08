<?php


namespace App\Services;


use App\Models\Category;
use App\Models\Compliment;
use DOMDocument;
use Illuminate\Database\Eloquent\Model;

class ParserService
{
    private const URL = 'https://xochew.ru';
    private const PAGES = [74, 6261, 6263, 5913, 5470, 6453, 6200, 5467];

    private function getHtml(int $page)
    {
        $urlPage = self::URL . '/?p=' . $page;
        return file_get_contents($urlPage);
    }

    public function parse()
    {
        libxml_use_internal_errors(true);

        foreach (self::PAGES as $page) {
            $dom = new DOMDocument();
            $html = $this->getHtml($page);
            $dom->loadHTML($html);
            $category = $this->parseCategory($dom);
            $this->parseCompliment($dom, $category);
        }
    }

    private function parseCategory($dom): Category
    {
        $categoryName = $dom->getElementsByTagName('h1');
        foreach ($categoryName as $c) {
            $category = new Category();
            $category->name = $c->textContent;
            $category->save();
        }
        return $category;
    }

    private function parseCompliment($dom, Category $category): void
    {
        $compliments = $dom->getElementsByTagName('p');
        foreach ($compliments as $c) {
            if ($this->checkTextContent($c)) {
                $compliment = new Compliment();
                $compliment->text = $c->textContent;
                $compliment->save();
                $compliment->categories()->attach($category->id);
            }
        }
    }

    private function checkTextContent($c): bool
    {
        return ((strlen($c->textContent) > 30) && ($c->textContent[0] !== ' ') && ($c->textContent[0] !== '2'));
    }
}

