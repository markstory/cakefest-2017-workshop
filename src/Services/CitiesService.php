<?php
namespace App\Services;

use Cake\Log\LogTrait;

class CitiesService
{
    use LogTrait;

    protected $cities, $redis;

    public function __construct($citiesTable, $redis, $stripe, $mq)
    {
        $this->cities = $citiesTable;
        $this->redis = $redis;
    }

    public function get($id)
    {
        $this->log('Someone got something', 'info');
        $this->redis->incrBy("$id:count", 1);
        return $this->cities->get($id);
    }

    public function add($cityData)
    {
        $this->redis->decrBy("city:add:count", 1);
        $city = $this->cities->newEntity($cityData);
        if ($city->getErrors()) {
            throw new \RuntimeException('You are bad');
        }
        $ok = $this->cities->save($city);
        $this->mq->emit('city created');
        $this->stripe->increaseUsage('city');
        if ($ok) {
            return $city;
        }
        throw new \RuntimeException('You are bad');
    }
}
