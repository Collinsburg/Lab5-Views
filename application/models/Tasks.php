<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tasks
 *
 * @author Sam Collins
 */
class Tasks extends XML_Model {

        public function __construct()
        {
                parent::__construct(APPPATH . '../data/tasks.xml', 'id');
        }
        
        function load() {
            if (($tasks = simplexml_load_file($this->_origin)) !== FALSE)
		{
			foreach ($tasks as $task) {
				$record = new stdClass();
				$record->id = (int) $task->id;
				$record->task = (string) $task->task;
				$record->priority = (int) $task->priority;
				$record->size = (int) $task->size;
				$record->group = (int) $task->group;
				$record->deadline = (string) $task->deadline;
				$record->status = (int) $task->status;
				$record->flag = (int) $task->flag;

				$this->_data[$record->id] = $record;
			}
		}

		// rebuild the keys table
		$this->reindex();
        }
        
        function store() {
            if (($handle = fopen($this->_origin, "w")) !== FALSE)
            {
                $xmlDoc = new DOMDocument( "1.0");
                $xmlDoc->preserveWhiteSpace = false;
                $xmlDoc->formatOutput = true;
                $tasks = $xmlDoc->createElement("tasks");
                foreach($this->_data as $key => $value)
                {
                    $task  = $xmlDoc->createElement("taskObject");
                        $item = $xmlDoc->createElement("id", $value->id);
                        $task->appendChild($item);
                        $item = $xmlDoc->createElement("task", $value->task);
                        $task->appendChild($item);
                        $item = $xmlDoc->createElement("priority", $value->priority);
                        $task->appendChild($item);
                        $item = $xmlDoc->createElement("size", $value->size);
                        $task->appendChild($item);
                        $item = $xmlDoc->createElement("group", $value->group);
                        $task->appendChild($item);
                        $item = $xmlDoc->createElement("deadline", $value->deadline);
                        $task->appendChild($item);
                        $item = $xmlDoc->createElement("status", $value->status);
                        $task->appendChild($item);
                        $item = $xmlDoc->createElement("flag", $value->flag);
                        $task->appendChild($item);
                    $tasks->appendChild($task);
                }
                $xmlDoc->appendChild($tasks);
                $xmlDoc->saveXML($xmlDoc);
                $xmlDoc->save($this->_origin);
            }
	}
        
        function getCategorizedTasks() {
            // extract the undone tasks
            foreach ($this->all() as $task)
            {
                if ($task->status != 2)
                    $undone[] = $task;
            }

            // substitute the category name, for sorting
            foreach ($undone as $task)
                $task->group = $this->app->group($task->group);

            // order them by category
            usort($undone, "orderByCategory");

            // convert the array of task objects into an array of associative objects       
            foreach ($undone as $task)
                $converted[] = (array) $task;

        return $converted;
        }
        
        public function rules()
        {
            $config = array(
                ['field' => 'task', 'label' => 'TODO task', 'rules' => 'alpha_numeric_spaces|max_length[64]'],
                ['field' => 'priority', 'label' => 'Priority', 'rules' => 'integer|less_than[4]'],
                ['field' => 'size', 'label' => 'Task size', 'rules' => 'integer|less_than[4]'],
                ['field' => 'group', 'label' => 'Task group', 'rules' => 'integer|less_than[5]'],
            );
            return $config;
        }

}
// return -1, 0, or 1 of $a's category name is earlier, equal to, or later than $b's
function orderByCategory($a, $b)
{
    if ($a->group < $b->group)
        return -1;
    elseif ($a->group > $b->group)
        return 1;
    else
        return 0;
}