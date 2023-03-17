<?php

namespace App\Fields;

require_once 'Field.php';
require_once __DIR__ . '/../Exceptions/FieldException.php';
require_once __DIR__ . '/../Validators/FieldValidator.php';

use App\Exceptions\FieldException;
use App\Validators\FieldValidator;

class DateField extends Field
{
    private ?string $format = null;

    protected static array $validators = [
        'dateFormatValidate'
    ];

    /**
     * @throws FieldException
     */
    public function __construct(array $config)
    {
        parent::__construct($config);

        self::validate($config);

        if(isset($config['format'])) {
            $this->format = $config['format'];
        }
    }

    public static function validate($config)
    {
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
        $dateTime = new \DateTime($this->value);

        $formatValue = !is_null($this->format) ? $dateTime->format($this->format) : $this->value;
        return "{$this->name} : $formatValue";
    }
}