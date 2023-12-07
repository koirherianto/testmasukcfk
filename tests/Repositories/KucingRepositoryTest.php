<?php

namespace Tests\Repositories;

use App\Models\Kucing;
use App\Repositories\KucingRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class KucingRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected KucingRepository $kucingRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->kucingRepo = app(KucingRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_kucing()
    {
        $kucing = Kucing::factory()->make()->toArray();

        $createdKucing = $this->kucingRepo->create($kucing);

        $createdKucing = $createdKucing->toArray();
        $this->assertArrayHasKey('id', $createdKucing);
        $this->assertNotNull($createdKucing['id'], 'Created Kucing must have id specified');
        $this->assertNotNull(Kucing::find($createdKucing['id']), 'Kucing with given id must be in DB');
        $this->assertModelData($kucing, $createdKucing);
    }

    /**
     * @test read
     */
    public function test_read_kucing()
    {
        $kucing = Kucing::factory()->create();

        $dbKucing = $this->kucingRepo->find($kucing->id);

        $dbKucing = $dbKucing->toArray();
        $this->assertModelData($kucing->toArray(), $dbKucing);
    }

    /**
     * @test update
     */
    public function test_update_kucing()
    {
        $kucing = Kucing::factory()->create();
        $fakeKucing = Kucing::factory()->make()->toArray();

        $updatedKucing = $this->kucingRepo->update($fakeKucing, $kucing->id);

        $this->assertModelData($fakeKucing, $updatedKucing->toArray());
        $dbKucing = $this->kucingRepo->find($kucing->id);
        $this->assertModelData($fakeKucing, $dbKucing->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_kucing()
    {
        $kucing = Kucing::factory()->create();

        $resp = $this->kucingRepo->delete($kucing->id);

        $this->assertTrue($resp);
        $this->assertNull(Kucing::find($kucing->id), 'Kucing should not exist in DB');
    }
}
