<?php

namespace Date;

use App\Validator;

class EventValidator extends Validator
{
    public function validates($data)
    {
        parent::validates($data);
        $this->validate('name', 'minLenght', 3);
        $this->validate('date', 'date');
        $this->validate('start', 'time');
        $this->validate('end', 'time');
        $this->validate('start', 'beforeTime', 'end');
        return $this->errors;
    }
}
