<?php

class Validation
{
    private $data;
    // private $id;
    // private $first_name;
    // private $last_name;
    // private $phone_number;
    // private $email;
    // private $country;
    // private $user_img;
    // private $conf_topic;
    // private $conf_description;
    // private $conf_date;

    public function __construct(
        $data
        // $id,
        // $first_name,
        // $last_name,
        // $phone_number,
        // $email,
        // $country,
        // $user_img,
        // $conf_topic,
        // $conf_description,
        // $conf_date
    ) {
        $this->data->$data;
        $this->name->checkText();
        // $this->id = $id;
        // $this->first_name = $first_name;
        // $this->last_name = $last_name;
        // $this->phone_number = $phone_number;
        // $this->email = $email;
        // $this->country = $country;
        // $this->user_img = $user_img;
        // $this->conf_topic = $conf_topic;
        // $this->conf_description = $conf_description;
        // $this->conf_date = $conf_date;
    }
    public function checkText()
    {
        $name=$this->data["firstName"];
        return $name;
    }
}
