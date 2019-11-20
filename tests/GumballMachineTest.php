<?php

require 'GumballMachine.php';

class GumballMachineTest extends PHPUnit_Framework_TestCase
{
    public $gumballMachineInstance;
    //prof
    private $nom1="XXX1"; // a changer
    private $prenom1="YYY1"; // a changer
    private $date_naissance1="1980-09-29"; // a changer
    private $lieu_naissance1="ZZZ1"; // a changer
    
    private $nom2="XXX2"; // a changer
    private $prenom2="YYY2"; // a changer
    private $date_naissance2="1981-10-30"; // a changer
    private $lieu_naissance2="ZZZ2"; // a changer
    
    private $nom3="XXX3"; // a changer
    private $prenom3="YYY3"; // a changer
    private $date_naissance3="1982-12-31"; // a changer
    private $lieu_naissance3="ZZZ3"; // a changer
    // cours
    private $intitule="IA"; //a remplir
    private $duree="12";    //a remplir
    
        
    public function setUp()
    {
        $this->gumballMachineInstance = new GumballMachine();
    }
    
    public function testAffichageProfAVI()
    {
        $this->assertEquals(true,$this->gumballMachineInstance->AffichageProf("Before Insertion of Professors"));
    }
    public function testInsertP()
    {
        $max__id1=$this->gumballMachineInstance->GetLastIDP();
        $this->assertEquals(true,$this->gumballMachineInstance->InsertP($this->gumballMachineInstance->getDB(),$this->nom1,$this->prenom1,$this->date_naissance1,$this->lieu_naissance1));
        $this->assertEquals(true,$this->gumballMachineInstance->InsertP($this->gumballMachineInstance->getDB(),$this->nom2,$this->prenom2,$this->date_naissance2,$this->lieu_naissance2));
        $this->assertEquals(true,$this->gumballMachineInstance->InsertP($this->gumballMachineInstance->getDB(),$this->nom3,$this->prenom3,$this->date_naissance3,$this->lieu_naissance3));
        $max__id2=$this->gumballMachineInstance->GetLastIDP();
        $this->assertEquals($max__id1+3,$max__id2);
        
    }
    public function testAffichageProfAPI()
    {
        /*à completer*/
    }
     
    
    public function testAffichageCoursAVI()
    {
        /*à completer*/
    }
    public function testInsertC()
    {
       
        /*à completer*/
        
    }
    public function testAffichageCoursAPI()
    {
        /*à completer*/
    }

   
}
