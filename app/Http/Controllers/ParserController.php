<?php


namespace App\Http\Controllers;


use App\Services\ParserService;

class ParserController
{
    private ParserService $parserService;

    public function __construct(ParserService $parserService)
    {
        $this->parserService = $parserService;
    }

    public function parse()
    {
        $this->parserService->parse();
    }
}