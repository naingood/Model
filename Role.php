<?php

declare(strict_types=1);


class Role
{

    public  $role;

    public  $diskon;

    /**
     * Default constructor
     */
    public function __construct($role, $diskon)
    {
       $this->role=$role;
       $this->diskon=$diskon;
    }

    public function get_role(){ return $this->role ; }
    public function get_diskon(){ return $this->diskon ; }

}
