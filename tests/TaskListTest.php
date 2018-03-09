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
class TaskListTest extends TestCase {
    
    function setUp() {
        $this->CI = &get_instance();
        $this->CI->load->model('task');
        
        for ($i = 0; $i < 5; $i++)
        {
            $this->task[$i] = new Task();
            $this->task[$i]->status = 'complete';
        }
        
        $this->task[0]->status = 'incomplete';
        $this->task[1]->status = 'incomplete';
        $this->task[2]->status = 'incomplete';
        
        $this->task[2]->size = 'small';

    }
    
    function testIncomplete() {
        $count = 0;
        for ($i = 0; $i < 5; $i++)
        {
            if ($this->task[$i]->status == 'incomplete')
            {
                $count++;
            }
        }
        $this->assertEquals($count, 3);
    }
    
    function testComplete() {
        $count = 0;
        for ($i = 0; $i < 5; $i++)
        {
            if ($this->task[$i]->status == 'complete')
            {
                $count++;
            }
        }
        $this->assertEquals($count, 2);
    }
    
    function testSize() {
        
        $this->assertEquals($this->task[2]->size, 'small');
    }
}