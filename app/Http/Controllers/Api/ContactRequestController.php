<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\EasyBrokerServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    public function __construct(
        protected readonly EasyBrokerServiceInterface $easyBrokerService
    ){}

    /**
     * Despliega una lista de contactos de prueba
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', 20);

        $contactRequests = $this->easyBrokerService->getContactRequests($page, $limit);
        return response()->json($contactRequests);
    }
}
