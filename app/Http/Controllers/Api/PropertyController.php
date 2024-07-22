<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\EasyBrokerServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct(
        protected readonly EasyBrokerServiceInterface $easyBrokerService
    ){}

    /**
     * Despliega una lista de propiedades mostrando solamente sus titulos
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', 20);
        $search = $request->query('search', []);

        $properties = $this->easyBrokerService->getProperties($page, $limit, $search);

        $titles = array_map(function($property) {
            return $property['title'];
        }, $properties['content']);

        return response()->json($titles);
    }
}
