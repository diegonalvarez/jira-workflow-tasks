<?php

namespace App\Dto;

class CustomerDto
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $target;

    public function __construct($name, $label, $target)
    {
        $this->name = $name;
        $this->label    = $label;
        $this->target   = $target;
    }
}
