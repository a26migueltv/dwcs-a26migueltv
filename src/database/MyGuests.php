<?php
class MyGuests
{
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $reg_date;
    function __toString()
    {
        return "<br>$this->id, $this->firstname, $this->lastname, $this->email";
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getReg_date()
    {
        return $this->reg_date;
    }

    public function setReg_date($reg_date)
    {
        $this->reg_date = $reg_date;

        return $this;
    }
}
