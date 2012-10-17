<?php

/**
 * This file contains the MySQLDMLQueryBuilderEscapeTest class.
 *
 * PHP Version 5.3
 *
 * @category   Libraries
 * @package    DataAccess
 * @subpackage Tests
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @author     Olivier Wizen <olivier@m2mobi.com>
 * @copyright  2012, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Lunr\Libraries\DataAccess;

/**
 * This class contains the tests for escaping values in queries.
 *
 * @category   Libraries
 * @package    DataAccess
 * @subpackage Tests
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @author     Olivier Wizen <olivier@m2mobi.com>
 * @covers     Lunr\Libraries\DataAccess\MySQLDMLQueryBuilder
 */
class MySQLDMLQueryBuilderEscapeTest extends MySQLDMLQueryBuilderTest
{

    /**
     * Test escaping a simple value.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithValueOnly
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::value
     */
    public function testEscapingValue()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('\'value\'', $this->builder->value('value'));
    }

    /**
     * Test escaping a value with a collation specified.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithCollation
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::value
     */
    public function testEscapingValueWithCollation()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('\'value\' COLLATE utf8_general_ci', $this->builder->value('value', 'utf8_general_ci'));
    }

    /**
     * Test escaping a value with charset specified.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithValueOnly
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::value
     */
    public function testEscapingValueWithCharset()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('ascii \'value\'', $this->builder->value('value', '', 'ascii'));
    }

    /**
     * Test escaping a value with a collation and charset specified.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithCollation
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::value
     */
    public function testEscapingValueWithCollationAndCharset()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('ascii \'value\' COLLATE utf8_general_ci', $this->builder->value('value', 'utf8_general_ci', 'ascii'));
    }

    /**
     * Test escaping a hex value.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithValueOnly
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::hexvalue
     */
    public function testEscapingHexValue()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('UNHEX(\'value\')', $this->builder->hexvalue('value'));
    }

    /**
     * Test escaping a hex value with a collation specified.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithCollation
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::hexvalue
     */
    public function testEscapingHexValueWithCollation()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('UNHEX(\'value\') COLLATE utf8_general_ci', $this->builder->hexvalue('value', 'utf8_general_ci'));
    }

    /**
     * Test escaping a hex value with charset specified.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithValueOnly
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::hexvalue
     */
    public function testEscapingHexValueWithCharset()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('ascii UNHEX(\'value\')', $this->builder->hexvalue('value', '', 'ascii'));
    }

    /**
     * Test escaping a hex value with a collation and charset specified.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithCollation
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::hexvalue
     */
    public function testEscapingHexValueWithCollationAndCharset()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('ascii UNHEX(\'value\') COLLATE utf8_general_ci', $this->builder->hexvalue('value', 'utf8_general_ci', 'ascii'));
    }

    /**
     * Test escaping a default like value.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithValueOnly
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::likevalue
     */
    public function testEscapingLikeValue()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('\'%value%\'', $this->builder->likevalue('value'));
    }

    /**
     * Test escaping a default like value with a collation specified.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithCollation
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::likevalue
     */
    public function testEscapingLikeValueWithCollation()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('\'%value%\' COLLATE utf8_general_ci', $this->builder->likevalue('value', 'both', 'utf8_general_ci'));
    }

    /**
     * Test escaping a default like value with charset specified.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithValueOnly
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::likevalue
     */
    public function testEscapingLikeValueWithCharset()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('ascii \'%value%\'', $this->builder->likevalue('value', 'both', '', 'ascii'));
    }

    /**
     * Test escaping a default like value with a collation and charset specified.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithCollation
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::likevalue
     */
    public function testEscapingLikeValueWithCollationAndCharset()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('ascii \'%value%\' COLLATE utf8_general_ci', $this->builder->likevalue('value', 'both', 'utf8_general_ci', 'ascii'));
    }

    /**
     * Test escaping a forward like value.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithValueOnly
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::likevalue
     */
    public function testEscapingLikeValueForward()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('\'value%\'', $this->builder->likevalue('value', 'forward'));
    }

    /**
     * Test escaping a backward like value.
     *
     * @depends Lunr\Libraries\DataAccess\DatabaseDMLQueryBuilderEscapeValuesTest::testCollateWithValueOnly
     * @covers  Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::likevalue
     */
    public function testEscapingLikeValueBackward()
    {
        $this->db->expects($this->once())
                 ->method('escape_string')
                 ->will($this->returnValue('value'));

        $this->assertEquals('\'%value\'', $this->builder->likevalue('value', 'backward'));
    }

    /**
     * Test escaping an integer.
     *
     * @param mixed   $value    The input value to be escaped
     * @param Integer $expected The expected escaped integer
     *
     * @dataProvider expectedIntegerProvider
     * @covers       Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::intvalue
     */
    public function testEscapeIntValue($value, $expected)
    {
        $this->assertEquals($expected , $this->builder->intvalue($value));
    }

    /**
     * Test escaping an object as integer
     *
     * @expectedException PHPUnit_Framework_Error_Notice
     * @covers            Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::intvalue
     */
    public function testEscapeObjectAsIntValue()
    {
        $this->builder->intvalue($this->builder);
    }

    /**
     * Test escaping illegal value as integer
     *
     * @param mixed   $value   The input value to be escaped
     * @param integer $illegal The illegal escaped integer
     *
     * @dataProvider illegalIntegerProvider
     * @covers       Lunr\Libraries\DataAccess\MysqlDMLQueryBuilder::intvalue
     */
    public function testEscapeIllegalAsIntValue($value, $illegal)
    {
        $this->assertEquals($illegal , $this->builder->intvalue($value));
    }

}

?>
