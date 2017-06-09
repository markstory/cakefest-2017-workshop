<?php
namespace App\Controller;

use Cake\Http\Client;
use App\Controller\AppController;

/**
 * Github Controller
 *
 * @property \App\Model\Table\GithubTable $Github
 *
 * @method \App\Model\Entity\Github[] paginate($object = null, array $settings = [])
 */
class GithubController extends AppController
{

    /**
     * View method
     *
     * @param string|null $id Github id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($username)
    {
        $http = new Client();
        $response = $http->get('https://api.github.com/users/' . $username);
        if ($response->isOk()) {
            return $this->response->withStringBody(json_encode(['success' => true]));
        }
        return $this->response->withStringBody(json_encode(['success' => false]));
    }
}
