<?php

namespace App;

use App\Dto\TaskDto;
use JiraRestApi\Issue\IssueField;
use JiraRestApi\Issue\IssueService;

class NewIssue
{

    /**
     * Array that have the configuration variables for the JIRA project
     * @var Array
     */
    protected $project;

    protected $env;

    public function __construct($project, $env)
    {
        $this->project = $project;
        $this->env     = $env;
    }

    public function new(TaskDto $taskDto, $origin = null)
    {
        $this->issueField = new IssueField();

        $this->issueField->setProjectKey($taskDto->projectId)
                    ->setSummary($taskDto->title)
                    ->setAssigneeName($taskDto->responsable)
                    ->setReporterName($taskDto->reporter)
                    ->setPriorityName($taskDto->priority)
                    ->setIssueType($taskDto->type)
                    ->setDescription($taskDto->description)
                    ->addLabel($taskDto->label)
                    ->setDueDate($taskDto->dueDate);

        $this->setEpicCustoms($taskDto);

        $this->setSubTaskParent($taskDto);

        $issue = $this->createIssue($this->issueField);
        
        $this->recordIssue($taskDto, $origin, $issue);

        return $issue;
    }

    public function createIssue($issueField)
    {
        $issueService = new IssueService();

        return $issueService->create($issueField);
    }

    protected function setEpicCustoms(TaskDto $taskDto)
    {
        if ($taskDto->type === 'Epic') {
            $this->issueField->addCustomField($this->project['epicTitle'], $taskDto->title);
        } elseif ($taskDto->type !== 'Sub-task') {
            $this->setEpicLink($taskDto);
        }
    }

    protected function setEpicLink(TaskDto $taskDto)
    {
        if (empty($this->env->epicLink) || $taskDto->epicLinkBool === false) {
            return false;
        }

        $this->issueField->addCustomField($this->project['epicLink'], $this->env->epicLink);
    }

    protected function setSubTaskParent(TaskDto $taskDto)
    {
        if ($taskDto->type === 'Sub-task') {
            $this->issueField->setParentKeyOrId($this->env->parentLink);
        }
    }

    protected function recordIssue(TaskDto $taskDto, $origin, $issue)
    {
        if (empty($origin)) {
            return;
        }

        if ($taskDto->type === 'Sub-task') {
            $this->env->issues[$origin]['sub-task'][$taskDto->reference] = $issue->key;
        } else {
            $this->env->issues[$origin]['main']['key'] = $issue->key;
        }
    }
}
