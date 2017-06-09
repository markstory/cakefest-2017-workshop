<?php
namespace App\Model\Enricher;

use Cake\Routing\Router;

class CityLinker
{
    public function __invoke($results)
    {
        return $results->map(function ($row) {
            $row->links = [
                'self' => Router::url([
                    'controller' => 'Cities',
                    'action' => 'view',
                    $row->id,
                    '_full' => true,
                ])
            ];
            return $row;
        });
    }
}
