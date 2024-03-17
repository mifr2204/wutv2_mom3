<?php

class uppgift {
    public $vad;
    public $vem;
    public $nar;

    // Skapar uppgift 
    function __construct($vad, $vem, $nar) {
        $this->setVad($vad);
        $this->setVem($vem);
        $this->setNar($nar);
    }

    function getVad() {
        return $this->vad;    
    }
    function getVem() {
        return $this->vem;    
    }
    function getNar() {
        return $this->nar;    
    }

    function setVad($sVad) {

        if (strlen($sVad) <5) {
            throw new Exception("Alla fält måste innehålla minst 5 tecken");
        }
        
        $this->vad =$sVad;    
    }

    function setVem($sVem) {

        if (strlen($sVem) <5) {
            throw new Exception("Alla fält måste innehålla minst 5 tecken");
        }
        
        $this->vem =$sVem;    
    }
    
    function setNar($sNar) {
        
        if (strlen($sNar) <5) {
            throw new Exception("Alla fält måste innehålla minst 5 tecken");
        }

        $this->nar =$sNar;    
    }
}

?>