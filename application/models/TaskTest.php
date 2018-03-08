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
    //put your code here
    function setUp() {
        $this->CI = &get_instance();
        $this->CI->load->model('task');
        $this->bowl = new Task();
    }
}