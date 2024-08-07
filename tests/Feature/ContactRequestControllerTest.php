<?php

namespace Tests\Feature;

use App\Contracts\Services\EasyBrokerServiceInterface;
use App\Http\Controllers\Api\ContactRequestController;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tests\TestCase;
use Mockery;

class ContactRequestControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Prueba que el método index del controlador ContactRequestController funcione correctamente
     *
     * @return void
     */
    public function testIndex()
    {
        $mockService = Mockery::mock(EasyBrokerServiceInterface::class);
        $mockService->shouldReceive('getContactRequests')
            ->once()
            ->with(1, 20)
            ->andReturn([
                'data' => [
                    ['id' => 1, 'name' => 'Test Contact Request']
                ]
            ]);

        $controller = new ContactRequestController($mockService);

        $request = Request::create('/api/contact-requests', 'GET', ['page' => 1, 'limit' => 20]);

        $response = $controller->index($request);

        $this->assertInstanceOf(JsonResponse::class, $response);

        $data = $response->getData(true);
        $this->assertEquals([
            'data' => [
                ['id' => 1, 'name' => 'Test Contact Request']
            ]
        ], $data);
    }
}
