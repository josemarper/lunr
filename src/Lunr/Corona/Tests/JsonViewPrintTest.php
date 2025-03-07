<?php

/**
 * This file contains the JsonViewPrintTest class.
 *
 * SPDX-FileCopyrightText: Copyright 2013 M2mobi B.V., Amsterdam, The Netherlands
 * SPDX-FileCopyrightText: Copyright 2022 Move Agency Group B.V., Zwolle, The Netherlands
 * SPDX-License-Identifier: MIT
 */

namespace Lunr\Corona\Tests;

use Lunr\Corona\Parsers\Sapi\SapiValue;
use stdClass;

/**
 * This class contains tests for the JsonView class.
 *
 * @covers Lunr\Corona\JsonView
 */
class JsonViewPrintTest extends JsonViewTestCase
{

    /**
     * JSON return value;
     * @var array
     */
    private $json;

    /**
     * Testcase Constructor.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->json = [ 'a' => 100, 'b' => [ 'z' => TRUE ], 'c' => [ NULL ], 'd' => new stdClass(), 'e' => 'みんな' ];
    }

    /**
     * Test that print_page() prints JSON with the response code as error info.
     *
     * @param mixed $errorInfo Non-integer error info value
     *
     * @dataProvider invalidErrorInfoProvider
     * @requires     PHP 5.5.12
     * @covers       Lunr\Corona\JsonView::print_page
     */
    public function testPrintPagePrintsJsonWithCode($errorInfo): void
    {
        $this->response->expects($this->once())
                       ->method('get_return_code_identifiers')
                       ->with(TRUE)
                       ->willReturn('id');

        $this->response->expects($this->once())
                       ->method('get_error_info')
                       ->with('id')
                       ->willReturn(NULL);

        $this->response->expects($this->once())
                       ->method('get_error_message')
                       ->with('id')
                       ->willReturn('Message');

        $this->response->expects($this->once())
                       ->method('get_return_code')
                       ->with('id')
                       ->willReturn(404);

        $this->response->expects($this->once())
                       ->method('get_response_data')
                       ->willReturn($this->json);

        $this->request->expects($this->once())
                      ->method('get')
                      ->with(SapiValue::Sapi)
                      ->willReturn('cli');

        $this->expectOutputMatchesFile(TEST_STATICS . '/Corona/json_code.json');

        $this->mockFunction('header', function () {});
        $this->mockFunction('http_response_code', function () {});

        $this->class->print_page();

        $this->unmockFunction('header');
        $this->unmockFunction('http_response_code');
    }

    /**
     * Test that print_page() prints JSON with an empty string as message if message is missing.
     *
     * @requires PHP 5.5.12
     * @covers   Lunr\Corona\JsonView::print_page
     */
    public function testPrintPagePrintsJsonWithoutMessage(): void
    {
        $this->response->expects($this->once())
                       ->method('get_return_code_identifiers')
                       ->with(TRUE)
                       ->willReturn('id');

        $this->response->expects($this->once())
                       ->method('get_error_info')
                       ->with('id')
                       ->willReturn(NULL);

        $this->response->expects($this->once())
                       ->method('get_error_message')
                       ->with('id')
                       ->willReturn(NULL);

        $this->response->expects($this->once())
                       ->method('get_return_code')
                       ->with('id')
                       ->willReturn(404);

        $this->response->expects($this->once())
                       ->method('get_response_data')
                       ->willReturn($this->json);

        $this->request->expects($this->once())
                      ->method('get')
                      ->with(SapiValue::Sapi)
                      ->willReturn('cli');

        $this->expectOutputMatchesFile(TEST_STATICS . '/Corona/json_empty_message.json');

        $this->mockFunction('header', function () {});
        $this->mockFunction('http_response_code', function () {});

        $this->class->print_page();

        $this->unmockFunction('header');
        $this->unmockFunction('http_response_code');
    }

    /**
     * Test that print_page() prints JSON.
     *
     * @requires PHP 5.5.12
     * @covers   Lunr\Corona\JsonView::print_page
     */
    public function testPrintPagePrintsJson(): void
    {
        $this->response->expects($this->once())
                       ->method('get_return_code_identifiers')
                       ->with(TRUE)
                       ->willReturn('id');

        $this->response->expects($this->once())
                       ->method('get_error_info')
                       ->with('id')
                       ->willReturn(4040);

        $this->response->expects($this->once())
                       ->method('get_error_message')
                       ->with('id')
                       ->willReturn('Message');

        $this->response->expects($this->once())
                       ->method('get_return_code')
                       ->with('id')
                       ->willReturn(404);

        $this->response->expects($this->once())
                       ->method('get_response_data')
                       ->willReturn($this->json);

        $this->request->expects($this->once())
                      ->method('get')
                      ->with(SapiValue::Sapi)
                      ->willReturn('cli');

        $this->expectOutputMatchesFile(TEST_STATICS . '/Corona/json_complete.json');

        $this->mockFunction('header', function () {});
        $this->mockFunction('http_response_code', function () {});

        $this->class->print_page();

        $this->unmockFunction('header');
        $this->unmockFunction('http_response_code');
    }

    /**
     * Test that print_page() for a non-cli SAPI does not pretty print the output.
     *
     * @covers Lunr\Corona\JsonView::print_page
     */
    public function testPrintPageForWebDoesNotPrettyPrint(): void
    {
        $this->response->expects($this->once())
                       ->method('get_return_code_identifiers')
                       ->with(TRUE)
                       ->willReturn('id');

        $this->response->expects($this->once())
                       ->method('get_error_info')
                       ->with('id')
                       ->willReturn(4040);

        $this->response->expects($this->once())
                       ->method('get_error_message')
                       ->with('id')
                       ->willReturn('Message');

        $this->response->expects($this->once())
                       ->method('get_return_code')
                       ->with('id')
                       ->willReturn(404);

        $this->response->expects($this->once())
                       ->method('get_response_data')
                       ->willReturn($this->json);

        $this->request->expects($this->once())
                      ->method('get')
                      ->with(SapiValue::Sapi)
                      ->willReturn('web');

        $this->expectOutputString('{"data":{"a":100,"b":{"z":true},"c":[null],"d":{},"e":"みんな"},"status":{"code":4040,"message":"Message"}}');

        $this->mockFunction('header', function () {});
        $this->mockFunction('http_response_code', function () {});

        $this->class->print_page();

        $this->unmockFunction('header');
        $this->unmockFunction('http_response_code');
    }

    /**
     * Test that print_page() with empty data value.
     *
     * @requires PHP 5.5.12
     * @covers   Lunr\Corona\JsonView::print_page
     */
    public function testPrintPageWithEmptyData(): void
    {
        $this->response->expects($this->once())
                       ->method('get_return_code_identifiers')
                       ->with(TRUE)
                       ->willReturn('id');

        $this->response->expects($this->once())
                       ->method('get_error_info')
                       ->with('id')
                       ->willReturn(4040);

        $this->response->expects($this->once())
                       ->method('get_error_message')
                       ->with('id')
                       ->willReturn('Message');

        $this->response->expects($this->once())
                       ->method('get_return_code')
                       ->with('id')
                       ->willReturn(404);

        $this->response->expects($this->once())
                       ->method('get_response_data')
                       ->willReturn([]);

        $this->request->expects($this->once())
                      ->method('get')
                      ->with(SapiValue::Sapi)
                      ->willReturn('cli');

        $this->expectOutputMatchesFile(TEST_STATICS . '/Corona/json_empty_data.json');

        $this->mockFunction('header', function () {});
        $this->mockFunction('http_response_code', function () {});

        $this->class->print_page();

        $this->unmockFunction('header');
        $this->unmockFunction('http_response_code');
    }

    /**
     * Test that print_page() sets the proper JSON content type.
     *
     * @runInSeparateProcess
     *
     * @requires PHP 5.5.12
     * @requires extension xdebug
     * @covers   Lunr\Corona\JsonView::print_page
     */
    public function testPrintPageSetsContentType(): void
    {
        $this->response->expects($this->once())
                       ->method('get_return_code_identifiers')
                       ->with(TRUE)
                       ->willReturn('id');

        $this->response->expects($this->once())
                       ->method('get_error_info')
                       ->with('id')
                       ->willReturn(4040);

        $this->response->expects($this->once())
                       ->method('get_error_message')
                       ->with('id')
                       ->willReturn('Message');

        $this->response->expects($this->once())
                       ->method('get_return_code')
                       ->with('id')
                       ->willReturn(404);

        $this->response->expects($this->once())
                       ->method('get_response_data')
                       ->willReturn($this->json);

        $this->request->expects($this->once())
                      ->method('get')
                      ->with(SapiValue::Sapi)
                      ->willReturn('cli');

        $this->expectOutputMatchesFile(TEST_STATICS . '/Corona/json_complete.json');

        $this->class->print_page();

        $headers = xdebug_get_headers();

        $this->assertIsArray($headers);
        $this->assertNotEmpty($headers);

        $value = strpos($headers[0], 'X-Xdebug-Profile-Filename') !== FALSE ? $headers[2] : $headers[1];

        $this->assertEquals('Content-type: application/json', $value);
    }

}

?>
