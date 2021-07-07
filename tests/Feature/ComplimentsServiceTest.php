<?php


namespace Tests\Feature;


use App\Models\Category;
use App\Models\Compliment;
use App\Services\API\ComplimentsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComplimentsServiceTest extends TestCase
{
    use RefreshDatabase;

    private ComplimentsService $complimentsService;

    public function setUp(): void
    {
        parent::setUp();
        $this->complimentsService = $this->app->make(ComplimentsService::class);
    }

    public function testCreate()
    {
        $compliment = $this->complimentsService->create('hello');
        $this->assertDatabaseHas(
            'compliments',
            [
                'text' => 'hello',
                'id' => $compliment->id,
            ]
        );
    }

    public function testGetRandomByCategory()
    {
        $category = Category::factory()->create();
        $compliment = Compliment::factory()->create();
        $compliment->categories()->attach($category->id);
        $complimentRandom = $this->complimentsService->getRandomByCategory($category->id);
        $this->assertTrue($complimentRandom[0]->category_id == $category->id);
    }

    public function testGetAll()
    {
        Compliment::factory()->count(10)->create();
        $compliments = $this->complimentsService->getAll();
        $this->assertTrue(count($compliments) == 10);
    }

    public function testGetAllByCategory()
    {
        $category = Category::factory()->create();
        for ($i = 0; $i < 100; $i++) {
            $c = Compliment::factory()->create();
            $c->categories()->attach($category->id);
        }
        $compliments = $this->complimentsService->getAllByCategory($category->id);
        $this->assertTrue(count($compliments) == 100);
    }

    public function testDelete()
    {
        $compliment = Compliment::factory()->create();
        $compliment->save();
        $this->complimentsService->delete($compliment->id);
        $this->assertDatabaseMissing(
            'compliments',
            [
                'id' => $compliment->id,
            ]
        );
    }

    public function testAttachComplimentToCategories()
    {
        $compliment = Compliment::factory()->create();
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();
        $categoryIds =
            [
                $category1->id,
                $category2->id,
            ];
        $this->complimentsService->attachComplimentToCategories($compliment->id, $categoryIds);

        $this->assertDatabaseHas(
            'compliments_categories_pivot',
            [
                'compliment_id' => $compliment->id,
                'category_id' => $category1->id
            ]
        );
    }
}
