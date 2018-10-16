<?php

use PHPUnit\Framework\TestCase;

class JsonHandlerTest extends TestCase
{
    public $handler;

    public function setUp()
    {
        parent::setUp();
        require_once __DIR__ . '/../../lib/class.json_handler.php';
        $this->handler = new jsonHandler(__DIR__ . '/../stubs/users.json');
    }

    /**
     * @covers jsonHandler::get_value_by_key
     */
    public function test_can_get_value_by_key()
    {
        $userData = $this->handler->get_value_by_key('joebloggs@example.com');
        $this->assertTrue(!empty($userData));
    }

    /**
     * @covers jsonHandler::check_if_key_exists
     */
    public function test_check_if_key_exists()
    {
        $exists = $this->handler->check_if_key_exists('joebloggs@example.com');
        $this->assertTrue($exists);

        $doesntExists = $this->handler->check_if_key_exists('jill@example.com');
        $this->assertFalse($doesntExists);
    }

    /**
     * @covers jsonHandler::getAllKeys
     */
    public function test_get_all_keys()
    {
        $userData = $this->handler->getAllKeys();
        $this->assertEquals('joebloggs@example.com', $userData[0]);
    }
}

