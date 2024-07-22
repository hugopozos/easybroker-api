<?php

namespace Tests\Feature;

use App\Contracts\Services\EasyBrokerServiceInterface;
use App\Http\Controllers\Api\PropertyController;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tests\TestCase;
use Mockery;

class PropertyControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Prueba que el método index del controlador PropertyController funcione correctamente
     *
     * @return void
     */
    public function testIndex()
    {
        $mockService = Mockery::mock(EasyBrokerServiceInterface::class);
        $mockService->shouldReceive('getProperties')
            ->once()
            ->with(1, 20, [])
            ->andReturn([
                'content' => [
                    ['title' => 'Test Property 1'],
                    ['title' => 'Test Property 2']
                ]
            ]);

        $controller = new PropertyController($mockService);

        $request = Request::create('/api/properties', 'GET', ['page' => 1, 'limit' => 20]);

        $response = $controller->index($request);

        $this->assertInstanceOf(JsonResponse::class, $response);

        $data = $response->getData(true);
        $this->assertEquals([
            'Test Property 1',
            'Test Property 2'
        ], $data);
    }
}
