<?php

namespace App\Contracts\Services;

interface EasyBrokerServiceInterface
{
    /*
     * Obtiene toda una lista de contactos de prueba
     * @param int $page
     * @param int $limit
     */
    public function getContactRequests($page, $limit);

}
