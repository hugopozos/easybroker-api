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

    /*
     * Obtiene toda una lista de propiedades
     * @param int $page
     * @param int $limit
     * @param array $search
     */
    public function getProperties($page, $limit, $search = []);

}
