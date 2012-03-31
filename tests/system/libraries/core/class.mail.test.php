<?php

/**
 * This file contains the MailTest class.
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
use PHPUnit_Framework_TestCase;
use ReflectionClass;

/**
 * This class contains test methods for the Mail class.
 *
 * @category   Libraries
 * @package    Core
 * @subpackage Tests
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @covers     Lunr\Libraries\Core\Mail
 */
abstract class MailTest extends PHPUnit_Framework_TestCase
{

    /**
     * Instance of the Mail class.
     * @var Mail
     */
    protected $mail;

    /**
     * Reflection instance of the Mail class.
     * @var ReflectionClass
     */
    protected $mail_reflection;

    /**
     * TestCase Constructor.
     */
    public function setUp()
    {
        $this->mail = new Mail();
        $this->mail_reflection = new ReflectionClass('Lunr\Libraries\Core\Mail');
    }

    /**
     * TestCase Destructor.
     */
    public function tearDown()
    {
        unset($this->mail);
        unset($this->mail_reflection);
    }

}

?>
