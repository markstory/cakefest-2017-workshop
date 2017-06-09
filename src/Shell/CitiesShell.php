<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Log\Log;

/**
 * Cities shell command.
 */
class CitiesShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->description('Get a list of cities')
            ->addOption('page', [
                'short' => 'p',
                'help' => 'The page you want',
                'default' => 1
            ]);

        return $parser;
    }

    protected function _welcome()
    {
        $this->out('Hi!');
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->loadModel('Cities');

        $page = $this->param('page');
        $q = $this->Cities->find()
            ->hydrate(false)
            ->limit(20)
            ->page($page);

        $r = $q->all()->toArray();
        $this->helper('Table')->output($r);
    }

    public function import()
    {
        
    }
}
