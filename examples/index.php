<?php
    $loader = require __DIR__ . '/../vendor/autoload.php';

    $data = array(
        "title" => "M",
        "name" => "Ezra",
        "firstname" => "georges",
        "profession_id" => "10",
        "exerciseMode" => "L",
        "specialty_id" => "CAPA15",
        "postalCode" => "75000",
        "town" => "Paris",
    );

    $mapped_data = \tools\Mapper::mapData($data);
    var_dump($data);
    var_dump($mapped_data);