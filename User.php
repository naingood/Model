<?php

declare(strict_types=1);


class User
{

    public  $nama;

    public  $role;

    public  $sponsor;

    public $histori_transaksi= [] ;

      /**
     * 
     */
    public function __construct($nama, $role)
    {
        $this->nama=$nama;
        $this->role=$role;
    }

    /**
     * 
     */
    public function belanja($keranjang)
    {
        $this->keranjang = $keranjang ;
        
        // Cek total harga keranjang , untuk menentukan diskon
        $total = $keranjang->get_total();
        // Definisi range 
        $range_1_produk = ($total <= 690000);
        $range_2_paket = ($total > 690000 && $total < 1224000);
        $range_4_paket = ($total > 1224000 && $total < 3510000 );
        $range_13_paket = ($total >= 3510000 );
        
        if($range_1_produk){
            $diskon = 0 ;
            $pesan = $this->nama . ' telah belanja senilai ' . $keranjang->get_total()." , ";
            $pesan .= "Upgrade ke Reseller , Dapatkan Diskon 8 %";
            $this->notif = new Notif('Order' , $pesan ) ;
        } else if ($range_2_paket) 
        {
            $diskon = 0.08 ; 
            $pesan = $this->nama . ' telah belanja senilai ' . $keranjang->get_total()." , ";
            $pesan .= "Upgrade ke GOLD Member , Dapatkan Diskon 15 %";
            $this->notif = new Notif('Order' , $pesan ) ;
        } else if($range_4_paket)
        {
            $diskon = 0.15 ; 
            $pesan = $this->nama . ' telah belanja senilai ' . $keranjang->get_total()." , ";
            $pesan .= "Upgrade ke DIAMOND Member , Dapatkan Diskon 25 %";
            $this->notif = new Notif('Order' , $pesan ) ;
        } else if($range_13_paket) 
        {
            $diskon = 0.25 ; 
            $pesan = $this->nama . ' telah belanja senilai ' . $keranjang->get_total()." , ";
            $pesan .= "Tingkatkan Poin Anda Terus dan Dapatkan Reward Emas 10 gram";
            $this->notif = new Notif('Order' , $pesan ) ;
        } else {

        }
        
        $this->diskon = $diskon;
        $diskon_rp = $this->keranjang->get_total() * $diskon ;
        $this->diskon_rp = $diskon_rp ; 

        // catat ke histori transaksi 
        array_push($this->histori_transaksi, $keranjang);

        $this->print_belanja();

    }

  
    /**
     * 
     */
    public function update_role()
    {
       
    }

    /**
     * 
     */
    public function set_sponsor($user)
    {
        $this->sponsor=$user ;
    }

    public function get_nama(){ return $this->nama ; }

    public function get_role(){ return $this->role ; }

    public function get_total_belanja(){ return $this->keranjang->get_total() ; }
    
    public function get_total_belanja_setelah_diskon()
    { 
        

        $total_setelah_diskon = $this->keranjang->get_total() - $this->diskon_rp ;
        
        return  $total_setelah_diskon ; 
    }

    public function get_sponsor()
    { 
        return $this->sponsor->get_nama() ;
    }

    public function get_notif()
    { 
        return $this->notif->tampil() ; 
    
    }

    public function get_histori_transaksi(){

        return count($this->histori_transaksi);
    }

    public function print_belanja()
    {
        echo "------------------ NOTA BELANJA---------------------------------------------------- \n" ;
        echo " Nama                 :  "  . $this->get_nama() ."\n" ;
        echo " Role                 :  "  . $this->get_role()->get_role() ."\n" ;
        echo " Total Belanja        :  "  . $this->get_total_belanja() ."\n" ;
        echo " Diskon               :  "  . $this->diskon ."\n" ;
        echo " Diskon RP            :  "  . $this->diskon_rp ."\n" ;
        echo " Total Akhir          :  "  . $this->get_total_belanja_setelah_diskon() ."\n" ;
        echo " Notif                :  "  . $this->get_notif() ."\n" ;
        echo " Histori Transaksi    :  "  . $this->get_histori_transaksi() ."\n" ;
        echo " Sponsor              :  "  . $this->sponsor->get_nama() ."\n" ;
        echo " Sponsor Role         :  "  . $this->sponsor->role->get_role() ."\n" ;

        if(($this->get_histori_transaksi()<2) && ($this->sponsor->role->get_role() == "distributor"))
        {
            $persen_komisi = 0.05;
        } else if(($this->get_histori_transaksi()>=2) && ($this->sponsor->role->get_role() == "distributor"))
        {  
            $persen_komisi = 0.02;
        }else {
            $persen_komisi = 0;
        }

        echo " % Komisi             :  "  . $persen_komisi ."\n" ;
        echo " Komisi               :  "  . $persen_komisi * $this->get_total_belanja_setelah_diskon() ."\n" ;
        echo "\n" ;
    }


}
