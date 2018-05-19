<?php

/**
 * This file contains the FrontControllerDispatchTest class.
 *
 * PHP Version 5.4
 *
 * @package    Lunr\Corona
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @copyright  2013-2018, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Lunr\Corona\Tests;

/**
 * This class contains tests for dispatching controllers with the FrontController class.
 *
 * @covers     Lunr\Corona\FrontController
 */
class FrontControllerDispatchTest extends FrontControllerTest
{

    /**
     * Test that dispatch works correctly with an already instantiated controller.
     *
     * @covers Lunr\Corona\FrontController::dispatch
     */
    public function testDispatchWithInstantiatedController()
    {
        $controller = $this->getMockBuilder('Lunr\Corona\Tests\MockController')->getMock();

        $this->request->expects($this->at(0))
                      ->method('__get')
                      ->with('method')
                      ->will($this->returnValue('foo'));

        $this->request->expects($this->at(1))
                      ->method('__get')
                      ->with('params')
                      ->will($this->returnValue([1, 2]));

        $controller->expects($this->once())
                   ->method('foo')
                   ->with(1, 2);

        $this->class->dispatch($controller);
    }

    /**
     * Test that dispatch works correctly with a controller name as string.
     *
     * @covers Lunr\Corona\FrontController::dispatch
     */
    public function testDispatchWithControllerAsString()
    {
        $controller = 'Lunr\Corona\Tests\MockController';

        $this->request->expects($this->at(0))
                      ->method('__get')
                      ->with('method')
                      ->will($this->returnValue('bar'));

        $this->request->expects($this->at(1))
                      ->method('__get')
                      ->with('params')
                      ->will($this->returnValue([1, 2]));

        $this->class->dispatch($controller);
    }

    /**
     * Test that dispatch behaves well with invalid controller values.
     *
     * @param mixed $value Invalid controller name.
     *
     * @dataProvider invalidControllerNameProvider
     * @covers       Lunr\Corona\FrontController::dispatch
     */
    public function testDispatchWithInvalidControllerValues($value)
    {
        if (class_exists('\PHPUnit\Framework\Error\Error'))
        {
            // PHPUnit 6
            $this->expectException('\PHPUnit\Framework\Error\Error');
        }
        else
        {
            // PHPUnit 5
            $this->expectException('\PHPUnit_Framework_Error');
        }

        $this->request->expects($this->at(0))
                      ->method('__get')
                      ->with('method')
                      ->will($this->returnValue('bar'));

        $this->request->expects($this->at(1))
                      ->method('__get')
                      ->with('params')
                      ->will($this->returnValue([]));

        $this->class->dispatch($value);
    }

}
