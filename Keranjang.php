<?php

declare(strict_types=1);


class Keranjang
{

    public  $total_item;

    public  $total_harga;

    public  $diskon; 

    /**
     * Default constructor
     */
    public function __construct($total_item,$total_harga)
    {
       $this->total_item =$total_item;
       $this->total_harga = $total_harga ;
    }

    /**
     * 
     */
    public function get_total()
    {
        return $this->total_harga;
    }

    /**
     * 
     */
    public function get_item()
    {
        return $this->total_item;
    }

    /**
     * 
     */

}
