<?php

namespace App\IssuesTypes;

use App\AbstractJiraIssuesConfig;

class Tasks extends AbstractJiraIssuesConfig
{
    /**
     * @var array /templates/tasks/task/tasks.yml
     */
    protected $tasks;

    /**
     * @var array /templates/tasks/task/design.yml
     */
    protected $design;

    /**
     * @var array /templates/tasks/task/customer.yml
     */
    protected $customer;

    /**
     * @var array /templates/tasks/task/development.yml
     */
    protected $development;

    /**
     * @var array /templates/tasks/task/facebook.yml
     */
    protected $facebook;

    public function setConfigYaml($path, $variable)
    {
        $tasks = $this->setYaml($path, $variable);

        $this->issues = new \StdClass;
        foreach ($tasks as $key => $value) {
            $this->issues->{$key} = $this->setYamlWithoutObjectProperty($value['path'], $key);
        }

        return $this->issues;
    }
}
