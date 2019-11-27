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
    
        
    public static function setUpBeforeClass(){
      
    }
        
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
        $this->gumballMachineInstance->DropData();
        $this->assertEquals(true,$this->gumballMachineInstance->InsertP($this->gumballMachineInstance->getDB(),$this->nom1,$this->prenom1,$this->date_naissance1,$this->lieu_naissance1));
        $max__id1=$this->gumballMachineInstance->GetLastIDP();
        $this->assertEquals(true,$this->gumballMachineInstance->InsertP($this->gumballMachineInstance->getDB(),$this->nom2,$this->prenom2,$this->date_naissance2,$this->lieu_naissance2));
        $this->assertEquals(true,$this->gumballMachineInstance->InsertP($this->gumballMachineInstance->getDB(),$this->nom3,$this->prenom3,$this->date_naissance3,$this->lieu_naissance3));
        $max__id2=$this->gumballMachineInstance->GetLastIDP();
        $this->assertEquals($max__id1+2,$max__id2);
        
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
        #$this->gumballMachineInstance->DropData("cours");
        $this->assertEquals(true,$this->gumballMachineInstance->InsertC($this->gumballMachineInstance->getDB(),$this->intitule1,$this->duree1,$this->gumballMachineInstance->GetIdP($this->nom1,$this->prenom1)));
        $max__id1=$this->gumballMachineInstance->GetLastIDC();
        $this->assertEquals(true,$this->gumballMachineInstance->InsertC($this->gumballMachineInstance->getDB(),$this->intitule2,$this->duree2,$this->gumballMachineInstance->GetIdP($this->nom2,$this->prenom2)));
        $this->assertEquals(true,$this->gumballMachineInstance->InsertC($this->gumballMachineInstance->getDB(),$this->intitule3,$this->duree3,$this->gumballMachineInstance->GetIdP($this->nom3,$this->prenom3)));
        $this->assertEquals(true,$this->gumballMachineInstance->InsertC($this->gumballMachineInstance->getDB(),$this->intitule4,$this->duree4,$this->gumballMachineInstance->GetIdP($this->nom3,$this->prenom3)));
        $max__id2=$this->gumballMachineInstance->GetLastIDC();
        $this->assertEquals($max__id1+3,$max__id2);
        
    }
    public function testAffichageCoursAPI()
    {
        /*à completer*/
    }
    
      public function testUpdateP()
    {
        $idToUpdate = $this->gumballMachineInstance->getIdP("XXX3", "YYY3");
        $this->assertEquals(true,$this->gumballMachineInstance->UpdateP($idToUpdate, "Gralice", "Tondeur", "1998-03-24", "CCC1"));
        $datasP = $this->gumballMachineInstance->GetDatasP($idToUpdate);
        $this->assertEquals("Gralice",$datasP[0]);
        $this->assertEquals("Tondeur",$datasP[1]);
        $this->assertEquals("1998-03-24",$datasP[2]);
        $this->assertEquals("CCC1",$datasP[3]);
        
    }
    
       public function testUpdateC()
    {
        $idToUpdate = $this->gumballMachineInstance->getIdC("IA", "12");
        $this->assertEquals(true,$this->gumballMachineInstance->UpdateC($idToUpdate, "Elecfonc", "87", $this->gumballMachineInstance->getIdP($this->nom2,$this->prenom2)));
        $datasC = $this->gumballMachineInstance->GetDatasC($idToUpdate);
        $this->assertEquals("Elecfonc",$datasC[0]);
        $this->assertEquals("87",$datasC[1]);
        $this->assertEquals($this->gumballMachineInstance->getIdP($this->nom2,$this->prenom2),$datasC[2]);
        
    }
       
    public function testDeleteC()
    {
        $table = "cours";
        $total1 = $this->gumballMachineInstance->countTableC();
        $idToDelete = $this->gumballMachineInstance->getIdC("Elecfonc", "87");
        $this->assertEquals(true,$this->gumballMachineInstance->DeleteC($idToDelete));
        $total2 = $this->gumballMachineInstance->countTableC();
        $this->assertEquals($total1, $total2+1);
    }
    
    public function testDeleteP()
    {
        $table = "prof";
        $total1 = $this->gumballMachineInstance->countTableP();
        $idToDelete = $this->gumballMachineInstance->getIdP("XXX1", "YYY1");
        $this->assertEquals(true,$this->gumballMachineInstance->DeleteP($idToDelete));
        $total2 = $this->gumballMachineInstance->countTableP();
        $this->assertEquals($total1, $total2+1);
    }

   
}
