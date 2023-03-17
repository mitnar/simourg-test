<?php

namespace App\Fields;

require_once __DIR__ . '/../Exceptions/FieldException.php';
require_once __DIR__ . '/../Validators/FieldValidator.php';

use App\Exceptions\FieldException;
use App\Validators\FieldValidator;

abstract class Field
{
    protected string $name;
    protected string $value;
    protected static array $validators = [
        'nameValidate',
        'valueValidate',
        'typeValidate'
    ];

    public function __construct(array $config)
    {
        $this->name = $config['name'];
        $this->value = $config['value'];
    }

    public static function validate($config)
    {
        $errorMessage = '';
        $validator = new FieldValidator($config);

        foreach(self::$validators as $validatorName) {
            $errorMessage = call_user_func([$validator, $validatorName]);
        }

        if(!empty($errorMessage)) {
            throw new FieldException($errorMessage);
        }
    }

    public function print(): string
    {
        return "{$this->name} : {$this->value}";
    }
}