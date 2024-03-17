<?php

class Lista {

    private $arrayData;
    private $fileName;


    //sökvägen till Json-fil
    private function setFileName($setFileName) {
        $this->fileName =$setFileName;
    }
    private function getFileName() {
        return $this->fileName; 
    }

    //Bestämmer/hämtar innehållet i array
    private function setArrayData($setArrayData) {
        $this->arrayData =$setArrayData;
    }
    private function getArrayData() {
        return $this->arrayData;
    }

    //Hämtar json, omvandlar till array, sparar nytt innehåll, och tillbaka till json
    function __construct($path) {
        
        //skapar json om ingen finns
        if (!file_exists($path)) {
            file_put_contents($path, '[]');
        }
        //sparar sökvägen till Json
        $this->setFileName($path);
        //Hämtar json
        $json = file_get_contents($path);
        //omvandlar till array
        $localArray =json_decode($json);
        //Omvandlar arrayer till uppgifter
        foreach($localArray as $index => $value) {
            $uppgift = new Uppgift($value->vad, $value->vem, $value->nar);
            $localArray[$index] = $uppgift;
        }
        //Lagrar i $arrayData
        $this->setArrayData($localArray);
    }

    //funktion som ger ett mer passande namn för användaren 
    function getUppgifter() {
        return $this->getArrayData();
    }

    //Lägger till uppgifter till array
    function add($what) {
        $array=$this->getArrayData();
        array_push($array, $what);
        $this->setArrayData($array);
        $this->save();
    }

    //Lägger in datan i Json filen
    function save() {
        file_put_contents($this->getFileName(), json_encode($this->getArrayData()));
    }

    //Deletar en uppgift från listan
    function deleteUppgift($index) {
        $localArrayData = $this->getArrayData();
        unset($localArrayData[$index]);
        $localArrayData = array_values($localArrayData);
        $this->setArrayData($localArrayData);
        $this->save();
    }

    function deleteAll() {
        //deletar från temporärt minne
        $this->setArrayData([]);
        //sparar till json
        $this->save();
    }
};

?>