<?php

namespace App\Fields;

require_once 'Field.php';

class NumberField extends Field
{
    private ?string $format = null;

    public function __construct(array $config)
    {
        parent::__construct($config);

        if(isset($config['format'])) {
            $this->format = $config['format'];
        }
    }

    public function print(): string
    {
        $formatValue = !is_null($this->format) ? sprintf($this->format, $this->value) : $this->value;
        return "{$this->name} : $formatValue";
    }
}