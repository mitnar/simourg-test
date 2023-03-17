<?php

require 'App\Process.php';
require_once 'App\Exceptions\FieldException.php';

$fields = [
    ['name' => 'Text', 'type' => 'text', 'value' => 'Text'],
    ['name' => 'Number', 'type' => 'number', 'value' => 455, 'format' => '%+.2f'],
    ['name' => 'Text2', 'type' => 'text2', 'value' => 'Text 2'],
    ['name' => '', 'type' => 'date', 'value' => '12.03.2023']
];

try {
    $process = new App\Process($fields);
} catch(App\Exceptions\FieldException $e) {
    die($e->getMessage());
}

$process->addField(['name' => 'NewField', 'type' => 'text', 'value' => 'Text']);

$allFields = $process->getAllFields();

print(implode(', ', $allFields));