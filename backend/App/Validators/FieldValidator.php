<?php

namespace App\Validators;

class FieldValidator
{
    private $config = [];
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function nameValidate()
    {
        if(!isset($this->config['name']) || empty($this->config['name'])) {
           return 'Не задано имя поля';
        }

        if(!is_string($this->config['name'])) {
            return 'Неверно задано имя поля';
        }

        return null;
    }

    public function valueValidate()
    {
        if(!isset($this->config['value'])) {
            return 'value не определено';
        }

        return null;
    }

    public function typeValidate()
    {
        if(!isset($this->config['type']) || empty($this->config['type'])) {
            return 'Не задан тип поля';
        }

        if(!is_string($this->config['type'])) {
            return 'Неверно задан тип поля';
        }

        if(!file_exists(__DIR__ . '/../Fields/' . ucfirst($this->config['type']) . 'Field.php')) {
            return 'Поля с типом ' . $this->config['type'] . ' не существует';
        }

        return null;
    }

    public function dateFormatValidate()
    {
        if (isset($this->config['format']) && false === \DateTime::createFromFormat($this->config['format'], $this->config['value'])) {
            return 'Дата не соответствует формату. Необходимо проверить корректность даты и формата';
        }

        return null;
    }
}