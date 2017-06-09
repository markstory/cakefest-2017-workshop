<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use App\Services\CitiesService;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Pimple\Container;
use Redis;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->buildContainer();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    public function buildContainer()
    {
        $this->container = new Container();
        $this->container['citiesService'] = function($c) {
            return new CitiesService($c['citiesTable'], $c['redis']);
        };
        $this->container['citiesTable'] = function($c) {
            return TableRegistry::get('Cities');
        };
        $this->container['redis'] = function($c) {
            $redis = new Redis();
            $redis->connect('localhost', 6379);
            return $redis;
        };
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        if (isset($this->viewVars['_serialize']) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->viewBuilder()->className('FractalEntities.Transformer');
        }
    }

    /**
     * Dispatches the controller action. Checks that the action
     * exists and isn't private.
     *
     * @return mixed The resulting response.
     * @throws \LogicException When request is not set.
     * @throws \Cake\Controller\Exception\MissingActionException When actions are not defined or inaccessible.
     */
    public function invokeAction()
    {
        $request = $this->request;
        if (!isset($request)) {
            throw new LogicException('No Request object configured. Cannot invoke action');
        }
        if (!$this->isAction($request->getParam('action'))) {
            throw new MissingActionException([
                'controller' => $this->name . 'Controller',
                'action' => $request->getParam('action'),
                'prefix' => $request->getParam('prefix') ?: '',
                'plugin' => $request->getParam('plugin'),
            ]);
        }

        $action = $this->request->getParam('action');
        $reflector = new \ReflectionMethod($this, $action);
        $params = $reflector->getParameters();
        $args = [];
        foreach ($params as $param) {
            $paramName = $param->getName();
            if (isset($this->container[$paramName])) {
                $inject = $this->container[$paramName];
                $args[] = $inject;
            }
        }
        /* @var callable $callable */
        $callable = [$this, $request->getParam('action')];

        return $callable(...array_merge(array_values($request->getParam('pass')), $args));
    }
}
