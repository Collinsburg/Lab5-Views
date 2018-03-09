<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Task
 *
 * @author SQLWindows
 */
class Task extends Entity {
    public $desc;
    public $priority;
    public $size;
    public $group;
    public $status;
    
    public function setDesc($value) {
        if (empty($value))
            throw new Exception('A Description cannot be empty');
        if (strlen($value) > 50)
            throw new Exception('A Description cannot be longer than 50 characters');
        $this->name = $value;
        return $this;
    }
    
    public function setPriority($value) {
        if (empty($value))
            throw new Exception('A Priority cannot be empty');
        $this->name = $value;
        return $this;
    }
    
    public function setSize($value) {
        if (empty($value))
            throw new Exception('A Size cannot be empty');
        $this->name = $value;
        return $this;
    }
    
    public function setGroup($value) {
        if (empty($value))
            throw new Exception('A Group cannot be empty');
        $this->name = $value;
        return $this;
    }
    
    public function setStatus($value) {
        if (empty($value))
            throw new Exception('A Status cannot be empty');
        $this->name = $value;
        return $this;
    }
}