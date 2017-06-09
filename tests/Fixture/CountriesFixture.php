<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CountriesFixture
 *
 */
class CountriesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'string', 'fixed' => true, 'length' => 3, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'name' => ['type' => 'string', 'fixed' => true, 'length' => 52, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'continent' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => 'Asia', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'region' => ['type' => 'string', 'fixed' => true, 'length' => 26, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'surface_area' => ['type' => 'float', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => ''],
        'independence_year' => ['type' => 'integer', 'length' => 6, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'population' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'life_expectancy' => ['type' => 'float', 'length' => 3, 'precision' => 1, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'gnp' => ['type' => 'float', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'gnp_oid' => ['type' => 'float', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'local_name' => ['type' => 'string', 'fixed' => true, 'length' => 45, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'government_form' => ['type' => 'string', 'fixed' => true, 'length' => 45, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'head_of_state' => ['type' => 'string', 'fixed' => true, 'length' => 60, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'capital_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'code' => ['type' => 'string', 'fixed' => true, 'length' => 2, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'is_active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'capital_id' => ['type' => 'index', 'columns' => ['capital_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
            'id' => 'JPN',
            'name' => 'Lorem ipsum dolor sit amet',
            'continent' => 'Lorem ipsum dolor sit amet',
            'region' => 'Lorem ipsum dolor sit am',
            'surface_area' => 1,
            'independence_year' => 1,
            'population' => 1,
            'life_expectancy' => 1,
            'gnp' => 1,
            'gnp_oid' => 1,
            'local_name' => 'Lorem ipsum dolor sit amet',
            'government_form' => 'Lorem ipsum dolor sit amet',
            'head_of_state' => 'Lorem ipsum dolor sit amet',
            'capital_id' => 1,
            'code' => '',
            'is_active' => 1,
            'created' => '2017-06-07 21:34:35',
            'modified' => '2017-06-07 21:34:35'
        ],
    ];
}
