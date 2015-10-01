<?php
namespace Payments\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ChargesFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer'],
        'name' => ['type' => 'string', 'null' => false],
        '_constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]]
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        ['name' => 'Philippe Lafrance'],
        ['name' => 'Yannick Cadoret'],
    ];
}
