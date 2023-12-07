<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Kucing;

class KucingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_kucing()
    {
        $kucing = Kucing::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/kucings', $kucing
        );

        $this->assertApiResponse($kucing);
    }

    /**
     * @test
     */
    public function test_read_kucing()
    {
        $kucing = Kucing::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/kucings/'.$kucing->id
        );

        $this->assertApiResponse($kucing->toArray());
    }

    /**
     * @test
     */
    public function test_update_kucing()
    {
        $kucing = Kucing::factory()->create();
        $editedKucing = Kucing::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/kucings/'.$kucing->id,
            $editedKucing
        );

        $this->assertApiResponse($editedKucing);
    }

    /**
     * @test
     */
    public function test_delete_kucing()
    {
        $kucing = Kucing::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/kucings/'.$kucing->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/kucings/'.$kucing->id
        );

        $this->response->assertStatus(404);
    }
}
