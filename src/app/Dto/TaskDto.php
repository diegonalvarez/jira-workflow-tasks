<?php

namespace App\Dto;

use App\Dto\CustomerDto;

class TaskDto
{
    /**
     * @var string Project ID
     */
    public $projectId;

    /**
     * @var string issue title
     */
    public $title;

    /**
     * @var string issue responsable
     */
    public $responsable;

    /**
     * @var string issue priority
     */
    public $priority;

    /**
     * @var string issue type
     */
    public $type;

    /**
     * @var string issue description
     */
    public $description = '';

    /**
     * @var string issue dueDate
     */
    public $dueDate = '';

    /**
     * @var string issue reporter
     */
    public $reporter;

    /**
     * @var string issue label
     */
    public $label = '';

    /**
     * @var bool issue need epic link
     */
    public $epicLinkBool = false;

    /**
     * @var string reference task key
     */
    public $reference = '';

    public function __construct(
        $project,
        $task,
        $users,
        CustomerDto $customer
    )
    {
        $this->reference    = $task['reference'];
        $this->projectId    = $project['key'];
        $this->title        = date('H:i:s') .' '. $task['title'] ." para ". $customer->target ." de ". $customer->name ;
        $this->responsable  = $users[$task['responsable']];
        $this->priority     = $task['priority'];
        $this->type         = $task['type'];
        $this->description  = $task['description'];
        $this->dueDate      = $task['duedate'];
        $this->reporter     = $users[$task['reporter']];
        $this->label        = $customer->label;
        $this->epicLinkBool = $task['epicLink'];
    }
}
