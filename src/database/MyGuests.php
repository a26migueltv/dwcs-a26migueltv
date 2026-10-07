<?php
class MyGuests
{
    private int $id;
    private String $firstname;
    private String $lastname;
    private String $email;
    private datetime $reg_date;

    function __toString()
    {
        return "<br>$this->id, $this->firstname, $this->lastname, $this->email";
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of reg_date
     */
    public function getReg_date()
    {
        return $this->reg_date;
    }

    /**
     * Set the value of reg_date
     *
     * @return  self
     */
    public function setReg_date($reg_date)
    {
        $this->reg_date = $reg_date;

        return $this;
    }
}
