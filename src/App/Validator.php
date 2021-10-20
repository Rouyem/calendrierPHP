<?php

namespace App;

class Validator
{
    private $data;
    protected $errors = [];

    public function __construcy($data = [])
    {
        $this->data = $data;
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return array|bool
     */
    public function validates($data)
    {
        $this->errors = [];
        $this->data = $data;
        return $this->errors;
    }

    public function validate($field, $method, ...$parameters)
    {
        //si le champ n'est pas défini
        if (!isset($this->data[$field])) {
            $this->errors[$field] = "Le champs $field n'est pas rempli";
            return false;
        } else {
            return call_user_func([$this, $method], $field, ...$parameters);
        }
    }

    public function minLenght($field, $length)
    {
        //compte le nombre de caractère
        if (mb_strlen($this->data[$field]) < $length) {
            $this->errors[$field] = "Le champs doit avoir plus de $length caractères";
            return false;
        }
        return true;
    }

    public function date($field)
    {
        if (\DateTime::createFromFormat('Y-m-d', $this->data[$field]) === false) {
            $this->errors[$field] = "La date ne semble pas valide";
            return false;
        }
        return true;
    }

    public function time($field)
    {
        if (\DateTime::createFromFormat('H:i', $this->data[$field]) === false) {
            $this->errors[$field] = "Le temps ne semble pas valide";
            return false;
        }
        return true;
    }

    public function beforeTime($startfield, $endfield)
    {
        if ($this->time($startfield) && $this->time($endfield)) {
            $start = \DateTime::createFromFormat('H:i', $this->data[$startfield]);
            $end = \DateTime::createFromFormat('H:i', $this->data[$endfield]);
            if ($start->getTimestamp() > $end->getTimestamp()) {
                $this->errors[$startfield] = "Le temps doit être inférieur au temps de fin";
                return false;
            }
            return true;
        }
        return false;
    }
}
