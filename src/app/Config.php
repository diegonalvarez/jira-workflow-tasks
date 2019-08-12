<?php

namespace App;

use App\AbstractJiraIssuesConfig;

class Config extends AbstractJiraIssuesConfig
{

    public function __construct($template)
    {
        $this->setUpConfig($template);
        foreach ($this->config->tasks as $key => $value) {

            $className = ucfirst($key);

            if ($key === 'users') {
                $className = "\\App\\$className";
            } else {
                $className = "\\App\\IssuesTypes\\$className";
            }

            $class     = new $className();
            $this->{$key} = $class->setConfigYaml($value['path'], $key);
        }

        foreach ($this->config->relations as $key => $value) {
            $this->setYaml($value, 'relations');
        }
    }
}
