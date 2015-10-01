<?php
namespace Payments\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class LaptopsFixture extends TestFixture
{
    public $table = 'laptops';

    /**
     * fields property
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer'],
        'name' => ['type' => 'string', 'null' => false],
        'price' => ['type' => 'integer', 'null' => false],
        '_constraints' => ['primary' => ['type' => 'primary', 'columns' => ['id']]]
    ];

    /**
     * records property
     *
     * @var array
     */
    public $records = [
        ['name' => 'First Laptop', 'price' => '5'],
        ['name' => 'Second Laptop', 'price' => '6'],
        ['name' => 'Third Laptop', 'price' => '7'],
    ];
}
