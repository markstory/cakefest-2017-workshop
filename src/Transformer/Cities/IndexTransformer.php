<?php
namespace App\Transformer\Cities;

use League\Fractal\TransformerAbstract;

class IndexTransformer extends TransformerAbstract
{
    public function transform($city)
    {
        return [
            'id' => $city->id,
            'name' => $city->name,
            'links' => [
                'self' => '/cities/' . $city->id
            ]
        ];
    }
}
