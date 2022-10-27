<?php

class Validation
{
    private $data;
    private $database;
    private $errors = [];
    private $countries;
    private static $fields = [
        "firstName",
        "lastName",
        "phoneNumber",
        "email",
        "country",
        "img",
        "topic",
        "description",
        "date"
    ];

    public function __construct($data, $countries, $database)
    {
        $this->data = $data;
        $this->countries = $countries;
        $this->database = $database;
    }
    public function validateForm()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field doesn't exist");
                return;
            }
        }
        $this->validateName("firstName", 2);
        $this->validateName("lastName", 2);
        $this->validateNumber();
        $this->validateEmail($this->database);
        $this->validateCountry();
        $this->validateLength("topic", 5);
        $this->validateLength("description", 10, 1000);
        $this->validateDate();
        return ["errors" => $this->errors, "data" => $this->data];
    }
    private function validateName($field, $minLength)
    {
        $val = trim($this->data[$field]);
        if (empty($val)) {
            $this->addError($field, "invalid");
        } else {
            if (!preg_match("/^[a-zA-Z]{{$minLength},100}$/", $val)) {
                $this->addError($field, "should be minimum {$minLength}");
            }
        }
    }
    private function validateNumber()
    {
        $val = trim($this->data["phoneNumber"]);
        if (empty($val)) {
            $this->addError("phoneNumber", "invalid");
        } else {
            $val = str_replace('-', '', $val);
            $val = preg_replace('/[^A-Za-z0-9\-]/', '', $val);
            if (!preg_match("/^[0-9]{11}$/", $val)) {
                $this->addError("phoneNumber", "should be 11");
            } else {
                $this->data["phoneNumber"] = $val;
            }
        }
    }

    private function validateEmail($database)
    {
        $val = trim($this->data["email"]);
        if (empty($val)) {
            $this->addError("email", "invalid");
        } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError("email", "incorrect");
            } else {
                $isInDB = $database->checkSingle("users", "email", $this->data["email"]);
                if ($isInDB) {
                    $this->addError("email", "choose another");
                }
            }
        }
    }
    private function validateCountry()
    {
        $val = trim($this->data["country"]);
        if (empty($val)) {
            $this->addError("country", "invalid");
        } else {
            if (!array_search($val, $this->countries)) {
                $this->addError("country", "invalid country");
            }
        }
    }
    private function validateLength($field, $minLength, $maxLength = 100)
    {
        $val = trim($this->data[$field]);
        if (empty($val)) {
            $this->addError($field, "invalid");
        } else {
            if (strlen($field) < $minLength) {
                $this->addError($field, "min ");
            } else if (strlen($field) > $maxLength) {
                $this->addError($field, "max");
            }
        }
    }
    private function validateDate()
    {
        $val = trim($this->data["date"]);
        $today = date("Y-m-d");
        if (empty($val)) {
            $this->addError("date", "invalid");
        } else {
            if ($val < $today) {
                $this->addError("date", "invalid");
            }
        }
    }
    private function addError($key, $val)
    {
        $this->errors["{$key}Error"] = $val;
    }
}
