<?php

/**
 * This file contains the RequestGetTest class.
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
use \ReflectionClass;

/**
 * Tests for getting stored superglobal values.
 *
 * @category   Libraries
 * @package    Core
 * @subpackage Tests
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @covers     Lunr\Libraries\Core\Request
 */
class RequestGetTest extends RequestTest
{

    /**
     * TestCase Constructor.
     */
    public function setUp()
    {
        $this->setUpFilled();
    }

    /**
     * Check that request values are returned correctly by the magic get method.
     *
     * @param String $key   key for a request value
     * @param mixed  $value value of a request value
     *
     * @runInSeparateProcess
     *
     * @depends      Lunr\Libraries\Core\RequestStoreTest::test_store_base_path
     * @depends      Lunr\Libraries\Core\RequestStoreTest::test_store_domain
     * @depends      Lunr\Libraries\Core\RequestStoreTest::test_store_port
     * @depends      Lunr\Libraries\Core\RequestStoreTest::test_store_port_if_https_isset
     * @depends      Lunr\Libraries\Core\RequestStoreTest::test_store_base_url
     * @depends      Lunr\Libraries\Core\RequestStoreTest::test_store_special_get_values
     * @dataProvider properRequestValueProvider
     * @covers       Lunr\Libraries\Core\Request::__get
     */
    public function test_magic_get_method($key, $value)
    {
        $this->assertEquals($value, $this->request->$key);
    }

    /**
     * Test getting GET data.
     *
     * @param String $value the expected value
     * @param String $key   key for a GET value
     *
     * @runInSeparateProcess
     *
     * @depends      Lunr\Libraries\Core\RequestStoreTest::test_store_valid_get_values
     * @dataProvider validJsonEnumProvider
     * @covers       Lunr\Libraries\Core\Request::get_get_data
     */
    public function test_get_get_data($value, $key)
    {
        $this->assertEquals($value, $this->request->get_get_data($key));
    }

    /**
     * Test getting POST data.
     *
     * @param String $value the expected value
     * @param String $key   key for a GET value
     *
     * @runInSeparateProcess
     *
     * @depends      Lunr\Libraries\Core\RequestStoreTest::test_store_valid_post_values
     * @dataProvider validJsonEnumProvider
     * @covers       Lunr\Libraries\Core\Request::get_post_data
     */
    public function test_get_post_data($value, $key)
    {
        $this->assertEquals($value, $this->request->get_post_data($key));
    }

    /**
     * Test getting GET data.
     *
     * @param String $value the expected value
     * @param String $key   key for a GET value
     *
     * @runInSeparateProcess
     *
     * @depends      Lunr\Libraries\Core\RequestStoreTest::test_store_valid_cookie_values
     * @dataProvider validJsonEnumProvider
     * @covers       Lunr\Libraries\Core\Request::get_cookie_data
     */
    public function test_get_cookie_data($value, $key)
    {
        $this->assertEquals($value, $this->request->get_cookie_data($key));
    }

    /**
     * Test getting valid json data from post.
     *
     * @param String $index the expected value as well as the index
     *
     * @runInSeparateProcess
     *
     * @depends      Lunr\Libraries\Core\RequestBaseTest::test_set_json_enums
     * @depends      test_get_post_data
     * @dataProvider validJsonEnumProvider
     * @covers       Lunr\Libraries\Core\Request::get_json_from_post
     */
    public function test_get_valid_json_from_post($index)
    {
        $this->assertEquals($index, $this->request->get_json_from_post($index));
    }

    /**
     * Test getting non existing json data from post returns NULL.
     *
     * @param String $index the expected value as well as the index
     *
     * @runInSeparateProcess
     *
     * @depends      Lunr\Libraries\Core\RequestBaseTest::test_set_json_enums
     * @depends      test_get_post_data
     * @dataProvider invalidKeyProvider
     * @covers       Lunr\Libraries\Core\Request::get_json_from_post
     */
    public function test_get_non_existing_json_from_post_is_null($index)
    {
        $this->assertNull($this->request->get_json_from_post($index));
    }

    /**
     * Test getting valid json data from get.
     *
     * @param String $index the expected value as well as the index
     *
     * @runInSeparateProcess
     *
     * @depends      Lunr\Libraries\Core\RequestBaseTest::test_set_json_enums
     * @depends      test_get_get_data
     * @dataProvider validJsonEnumProvider
     * @covers       Lunr\Libraries\Core\Request::get_json_from_get
     */
    public function test_get_valid_json_from_get($index)
    {
        $this->assertEquals($index, $this->request->get_json_from_get($index));
    }

    /**
     * Test getting non existing json data from get returns NULL.
     *
     * @param String $index the expected value as well as the index
     *
     * @runInSeparateProcess
     *
     * @depends      Lunr\Libraries\Core\RequestBaseTest::test_set_json_enums
     * @depends      test_get_get_data
     * @dataProvider invalidKeyProvider
     * @covers       Lunr\Libraries\Core\Request::get_json_from_get
     */
    public function test_get_non_existing_json_from_get_is_null($index)
    {
        $this->assertNull($this->request->get_json_from_get($index));
    }

}

?>