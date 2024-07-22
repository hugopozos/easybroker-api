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
     * Tests the index method of the ContactRequestController.
     *
     * @return void
     */
    public function testIndex()
    {
        // Mock the EasyBrokerServiceInterface to return predefined data
        $mockService = Mockery::mock(EasyBrokerServiceInterface::class);
        $mockService->shouldReceive('getContactRequests')
            ->once()
            ->with(1, 20)
            ->andReturn([
                'data' => [
                    ['id' => 1, 'name' => 'Test Contact Request']
                ]
            ]);

        // Instantiate the controller with the mocked service
        $controller = new ContactRequestController($mockService);

        // Simulate a GET request to the index method
        $request = Request::create('/api/contact-requests', 'GET', ['page' => 1, 'limit' => 20]);

        // Call the index method and capture the response
        $response = $controller->index($request);

        // Assert the response is of type JsonResponse
        $this->assertInstanceOf(JsonResponse::class, $response);

        // Decode the response data and verify it matches the expected structure
        $data = $response->getData(true);
        $this->assertEquals([
            'data' => [
                ['id' => 1, 'name' => 'Test Contact Request']
            ]
        ], $data);
    }
}
