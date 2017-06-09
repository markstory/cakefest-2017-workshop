<?php
namespace App\Middleware;

use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class QueryLogger
{
    public $log = [];

    public function log($logged)
    {
        $this->log[] = $logged;
    }

    public function getCount()
    {
        return count($this->log);
    }
}

class MetricsMiddleware
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
    {
        $logger = $this->enableLogging();

        $start = microtime(true);
        $response = $next($request, $response);
        $end = microtime(true);

        $duration = $end - $start;
        $url = $request->getUri()->getPath();
        $count = $logger->getCount();
        Log::info("request to=$url took=$duration(s) queries=$count");
        return $response;
    }

    protected function enableLogging()
    {
        $logger = new QueryLogger();
        // Add other connections if you have them
        $connection = ConnectionManager::get('default');
        $connection->logger($logger);
        $connection->logQueries(true);

        return $logger;
    }
}
