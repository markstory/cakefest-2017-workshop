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
        $importParser = clone $parser;

        $parser->description('Interact with cities')
            ->addOption('page', [
                'short' => 'p',
                'help' => 'The page you want',
                'default' => 1
            ]);

        $importParser->addArgument('file', [
            'help' => 'The file to import',
            'required' => true
        ]);
        $parser->addSubcommand('import', [
            'help' => 'Import cities',
            'description' => 'Import cities from CSV files',
            'parser' => $importParser
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
        array_unshift($r, ['id' => 'id', 'name' => 'name', 'country_id' =>  'country', 'district' =>  'Region', 'population' =>  'Population']);
        $this->helper('Table')->output($r);
    }

    public function import()
    {
        $this->loadModel('Cities');
        $file = $this->args[0];
        if (!file_exists($file)) {
            $this->error("Your file $file doesn't exist.");
        }
        $this->out('Preparing to import');
        $csv = fopen($file, 'r');

        $lines = [];
        while (!feof($csv)) {
            $line = fgetcsv($csv, 0, "\t");
            if ($line[0] == 'id') {
                $header = $line;
                continue;
            }
            if ($line) {
                $lines[] = array_combine($header, $line);
            }
        }
        $progress = $this->helper('Progress');
        $progress->init([
            'total' => count($lines),
        ]);
        foreach ($lines as $line) {
            $city = $this->Cities->newEntity($line);
            if (!$this->Cities->save($city)) {
                $this->error('You lose ' . json_encode($city->getErrors()));
            }
            usleep(50000);
            $progress->increment();
            $progress->draw();
        }

    }
}
