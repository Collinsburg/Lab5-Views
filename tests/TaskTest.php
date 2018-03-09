<?php
use PHPUnit\Framework\TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TaskTest
 *
 * @author SQLWindows
 */
class TaskTest extends TestCase {
    
    function setUp() {
        $this->CI = &get_instance();
        $this->CI->load->model('task');
        $this->task = new Task();
        $this->task->desc = 'This is a test';
    }
    
    function testSetup() {
        $this->assertEquals('This is a test', $this->task->desc);
    }
}