<?php

namespace App;

use App\Config;
use App\Dto\CustomerDto;
use App\Dto\TaskDto;
use App\NewIssue;
use JiraRestApi\Issue\IssueField;
use JiraRestApi\Issue\IssueService;
use JiraRestApi\JiraException;

class RunTasks extends Config
{

    /**
     * Context Variables
     * @var object
     */
    protected $env;

    public function __construct($template)
    {
        parent::__construct($template);

        $this->env = new \StdClass;
    }

    public function action(CustomerDto $customer)
    {
        $this->processEpic($customer);

        $this->processTasks($customer);

        $this->createRelations();
    }

    protected function createRelations()
    {
        
    }

    protected function processEpic(CustomerDto $customer)
    {
        if (isset($this->epic)) {
            $issue = $this->newIssue($customer, $this->epic);
            $this->env->epicLink = $issue->key;
        }
    }

    protected function processTasks(CustomerDto $customer)
    {
        foreach ($this->tasks as $taskKey => $taskValue) {
            $this->resetParentLink();

            $task = $this->newIssue($customer, $taskValue, $taskKey);
            $this->env->parentLink = $task->key;

            foreach ($taskValue['subtasks'] as $subTaskKey => $subTaskValue) {
                $subTask = $this->newIssue($customer, $subTaskValue, $taskKey);
            }
        }
        $this->resetParentLink();
    }

    public function newIssue(CustomerDto $customer, $task, $origin = null)
    {
        $taskDto = new TaskDto(
            $this->config->projects,
            $task,
            $this->users,
            $customer
        );

        $issue = $this->newIssueClass();
        return $issue->new($taskDto, $origin);
    }

    public function newIssueClass()
    {
        return new NewIssue($this->config->projects, $this->env);
    }

    public function returnEnv()
    {
        return $this->env;
    }

    protected function resetParentLink()
    {
        $this->env->parentLink = false;
    }
}
