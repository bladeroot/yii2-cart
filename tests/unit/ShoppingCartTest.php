<?php

/*
 * Cart module for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-cart
 * @package   yii2-cart
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\yii2\cart\tests\unit;

use hiqdev\yii2\cart\ShoppingCart;
use Yii;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-11-26 at 08:00:52.
 */
class ShoppingCartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ShoppingCart
     */
    protected $object;

    protected $id       = 'fake1';
    protected $price    = 9.99;
    protected $discount = 3.33;
    protected $quantity = 5;

    protected function setUp()
    {
        $this->object = new ShoppingCart();
        $product = Yii::createObject([
            'class'    => FakeCartPosition::class,
            'id'       => $this->id,
            'price'    => $this->price,
            'discount' => $this->discount,
        ]);
        $this->object->put($product, $this->quantity);
    }

    protected function tearDown()
    {
        $this->object->removeAll();
    }

    public function testGetCount()
    {
        $this->assertSame(1, $this->object->getCount());
    }

    public function testGetQuantity()
    {
        $this->assertSame($this->quantity, $this->object->getQuantity());
    }

    public function testGetSubtotal()
    {
        $this->assertSame($this->quantity * $this->price, $this->object->getSubtotal());
    }

    public function testGetTotal()
    {
        $this->assertSame($this->quantity * ($this->price - $this->discount), $this->object->getTotal());
    }

    public function testGetDiscount()
    {
        $this->assertSame($this->quantity * $this->discount, -$this->object->getDiscount());
    }

    public function testFormatCurrency()
    {
        $this->assertSame('$9.99', $this->object->formatCurrency($this->price));
    }
}
