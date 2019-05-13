<?php

include 'vendor/autoload.php';

use App\Dto\CustomerDto;
use App\RunTasks;

try{
    $template = 'facebook_campania_landing';

    $name     = 'FAM Corp Jesus Soler';
    $label    = 'fam_corp_rent_a_car';
    $target   = 'Rent a Car';

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
