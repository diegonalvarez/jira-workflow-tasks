<?php

namespace App;

interface IConfigSet
{
    public function setConfigYaml($path, $variable);
}