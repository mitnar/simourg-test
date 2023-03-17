<?php

namespace App;

require_once 'Fields\Field.php';

use App\Exceptions\FieldException;
use App\Fields\Field;

class Process
{
    private array $fields = [];

    /**
     * @throws FieldException
     */
    public function __construct(array $fields)
    {
        foreach ($fields as $field) {
            $this->addField($field);
        }
    }

    public function getAllFields(): array
    {
        $fieldsInfo = [];

        foreach ($this->fields as $field) {
            $fieldsInfo[] = $field->print();
        }

        return $fieldsInfo;
    }

    /**
     * @throws FieldException
     */
    public function addField(array $field): void
    {
        Field::validate($field);

        require_once('Fields\\' . ucfirst($field['type']) . 'Field.php');
        $class = 'App\Fields\\' . ucfirst($field['type']) . 'Field';

        $this->fields[$field['name']] = new $class($field);
    }
}