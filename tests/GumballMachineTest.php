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
    private $intitule1="IA"; //a remplir
    private $duree1="12";    //a remplir
    private $id_prof1="1";
    
      
    private $intitule2="IOT"; //a remplir
    private $duree2="10";    //a remplir
    private $id_prof2="2";
    
    private $intitule3="C++"; //a remplir
    private $duree3="18";    //a remplir
    private $id_prof3="3";
        
    private $intitule4="EDL"; //a remplir
    private $duree4="30";    //a remplir
    private $id_prof4="3";
    
        
    
        
    public function setUp()
    {
        $this->gumballMachineInstance = new GumballMachine();
        $this->gumballMachineInstance->DropData();
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
       
        $max__id1=$this->gumballMachineInstance->GetLastIDC();
        $this->assertEquals(true,$this->gumballMachineInstance->InsertC($this->gumballMachineInstance->getDB(),$this->intitule1,$this->duree1,$this->id_prof1));
        $this->assertEquals(true,$this->gumballMachineInstance->InsertC($this->gumballMachineInstance->getDB(),$this->intitule2,$this->duree2,$this->id_prof2));
        $this->assertEquals(true,$this->gumballMachineInstance->InsertC($this->gumballMachineInstance->getDB(),$this->intitule3,$this->duree3,$this->id_prof3));
        $this->assertEquals(true,$this->gumballMachineInstance->InsertC($this->gumballMachineInstance->getDB(),$this->intitule4,$this->duree4,$this->id_prof3));
        $max__id2=$this->gumballMachineInstance->GetLastIDC();
        $this->assertEquals($max__id1+4,$max__id2);
        
    }
    public function testAffichageCoursAPI()
    {
        /*à completer*/
    }

   
}
