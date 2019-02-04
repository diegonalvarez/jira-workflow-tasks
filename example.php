<?php

include 'vendor/autoload.php';

use App\Dto\CustomerDto;
use App\RunTasks;

try{
    $template = 'example';

    $name     = 'Diego Alvarez';
    $label    = 'diego_alvarez';
    $target   = 'Argentina';

    $customerDto = new CustomerDto(
        $name,
        $label,
        $target
    );

    $tasks = new RunTasks($template);
    $tasks->action($customerDto);
} catch (Exception $e) {
    print("Error Occured! " . $e->getMessage());
}
