<?php

namespace App;

use App\Exception\ConfigException;
use Symfony\Component\Yaml\Yaml;

abstract class AbstractJiraIssuesConfig
{

    /**
     * @var string templates path
     */
    public $configPath = 'templates/';

    /**
     * @var string config filename
     */
    public $configFile = 'config.yml';

    /**
     * @var array /templates/config.yml
     */
    protected $config;

    public function setUpConfig($template)
    {
        $path = $this->setTemplate($template);

        $this->setYaml($path, 'config');
    }

    protected function setYaml($path, $var)
    {
        $this->checkFile($path);

        $this->{$var} = (object)Yaml::parse(file_get_contents($path));
        return $this->{$var};
    }

    protected function setYamlWithoutObjectProperty($path, $var)
    {
        $this->checkFile($path);

        $object = (object)Yaml::parse(file_get_contents($path));
        $this->{$var} = $object->{$var};
        return $this->{$var};
    }

    protected function checkFile($path)
    {
        if (! file_exists($path)) {
            throw new ConfigException("The config file {$path} doesn't exist.", 1);
        }
    }

    protected function setTemplate($template)
    {
        if (empty($template)) {
            throw new ConfigException("The template folder {$path} doesn't exist.", 1);
        }

        return $this->configPath. $template .'/'. $this->configFile;
    }

    public function returnConfig()
    {
        return $this->config;
    }

    public function returnProjects()
    {
        return $this->config->projects;
    }
}
