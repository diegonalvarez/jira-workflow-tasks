<?php

namespace App\IssuesTypes;

use App\AbstractJiraIssuesConfig;

class Epic extends AbstractJiraIssuesConfig
{
    /**
     * @var string path /templates/users/users.yml
     * @var string variables variable name
     */
    public function setConfigYaml($path, $variable)
    {
        return $this->setYamlWithoutObjectProperty($path, $variable);
    }
}
