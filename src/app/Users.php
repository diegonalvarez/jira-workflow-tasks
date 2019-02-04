<?php

namespace App;

use App\AbstractJiraIssuesConfig;
use App\IConfigSet;

class Users extends AbstractJiraIssuesConfig implements IConfigSet
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
