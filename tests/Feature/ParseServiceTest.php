<?php


namespace Tests\Feature;


use App\Services\ParserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParseServiceTest extends TestCase
{
    private ParserService $parserService;

    public function setUp(): void
    {
        parent::setUp();
        $this->parserService = $this->app->make(ParserService::class);
    }

    public function testParse()
    {
        $this->parserService->parse();
        $this->assertTrue();
    }
}