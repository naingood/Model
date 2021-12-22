<?php

declare(strict_types=1);


class Notif
{

    public  $event;

    public  $pesan;

    /**
     * Default constructor
     */
    public function __construct($event, $pesan )
    {
        $this->event = $event;
        $this->pesan = $pesan;

    }

    /**
     * 
     */
    public function tampil()
    {
        return $this->pesan;
    }

    

}
