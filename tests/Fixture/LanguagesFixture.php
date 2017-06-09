<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LanguagesFixture
 *
 */
class LanguagesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'country_id' => ['type' => 'string', 'fixed' => true, 'length' => 3, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'language' => ['type' => 'string', 'fixed' => true, 'length' => 30, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'is_official' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'F', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'percentage' => ['type' => 'float', 'length' => 4, 'precision' => 1, 'unsigned' => false, 'null' => false, 'default' => '0.0', 'comment' => ''],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['country_id', 'language'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'country_id' => 'JPN',
            'language' => 'Japanese',
            'is_official' => 'T',
            'percentage' => 1
        ],
    ];
}
