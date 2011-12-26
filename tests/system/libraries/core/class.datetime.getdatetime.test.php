<?php

/**
 * This file contains the DateTimeGetDateTimeTest class.
 *
 * PHP Version 5.3
 *
 * @category   Libraries
 * @package    Core
 * @subpackage Tests
 * @author     M2Mobi <info@m2mobi.com>
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 */

namespace Lunr\Libraries\Core;

/**
 * This class contains the tests for the get_datetime() method
 *
 * @category   Libraries
 * @package    Core
 * @subpackage Tests
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @covers     Lunr\Libraries\Core\DateTime
 */
class DateTimeGetDateTimeTest extends DateTimeTest
{

    /**
     * Test get_datetime() with the default datetime format and current timestamp as base.
     *
     * @covers Lunr\Libraries\Core\DateTime::get_datetime
     */
    public function testGetDatetimeWithDefaultDatetimeFormat()
    {
        $this->assertEquals(strftime('%Y-%m-%d'), $this->datetime->get_datetime());
    }

    /**
     * Test get_datetime() with a custom datetime format and current timestamp as base.
     *
     * @depends Lunr\Libraries\Core\DateTimeBaseTest::testSetCustomDatetimeFormat
     * @covers  Lunr\Libraries\Core\DateTime::get_datetime
     */
    public function testGetDatetimeWithCustomDatetimeFormat()
    {
        $value = $this->datetime->set_datetime_format('%A. %d.%m.%Y')->get_datetime();
        $this->assertEquals(strftime('%A. %d.%m.%Y'), $value);
    }

    /**
     * Test get_datetime() with a custom but invalid datetime format and current timestamp as base.
     *
     * @param mixed $format DateTime format
     *
     * @depends      Lunr\Libraries\Core\DateTimeBaseTest::testSetCustomDatetimeFormat
     * @dataProvider invalidDatetimeFormatProvider
     * @covers       Lunr\Libraries\Core\DateTime::get_datetime
     */
    public function testGetDatetimeWithCustomInvalidDatetimeFormat($format)
    {
        $this->assertEquals($format, $this->datetime->set_datetime_format($format)->get_datetime());
    }

    /**
     * Test get_datetime() with a custom datetime format, custom locale and current timestamp as base.
     *
     * @runInSeparateProcess
     *
     * @depends Lunr\Libraries\Core\DateTimeBaseTest::testSetCustomDatetimeFormat
     * @depends Lunr\Libraries\Core\DateTimeBaseTest::testSetCustomLocaleWithDefaultCharset
     * @covers  Lunr\Libraries\Core\DateTime::get_datetime
     */
    public function testGetDatetimeWithLocalizedCustomDatetimeFormat()
    {
        $day = strftime('%u');
        $localized_day = $this->datetime->set_datetime_format('%A')->set_locale('de_DE')->get_datetime();
        $this->assertTrue($this->check_localized_day($day, $localized_day));
    }

    /**
     * Test get_datetime() with the default datetime format and a custom timestamp as base.
     *
     * @param Integer $timestamp UNIX Timestamp
     *
     * @dataProvider validTimestampProvider
     * @covers       Lunr\Libraries\Core\DateTime::get_datetime
     */
    public function testGetDatetimeWithCustomTimestampAsBase($timestamp)
    {
        $this->assertEquals(strftime('%Y-%m-%d', $timestamp), $this->datetime->get_datetime($timestamp));
    }

    /**
     * Test get_datetime() with the default datetime format and a custom but invalid timestamp as base.
     *
     * @param mixed $timestamp Various invalid timestamp values
     *
     * @dataProvider invalidTimestampProvider
     * @covers       Lunr\Libraries\Core\DateTime::get_datetime
     */
    public function testGetDatetimeWithCustomInvalidTimestampAsBase($timestamp)
    {
        $this->assertFalse($this->datetime->get_datetime($timestamp));
    }

}

?>