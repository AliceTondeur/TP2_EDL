<?php
//test
class GumballMachine
{

	private $gumballs;
	
	private $bdd;
	/* Paramètre de connexion à la base de données*/
	private $servername="localhost";
	private $db_name="mydb30"; //a remplir
	private $db_user="myuser30"; //a remplir
	private $db_pass="mypassword30"; //a remplir
	
	
	function __construct()
	{
	    try
	    {
	        $this->bdd =  new PDO("mysql:host=$this->servername;dbname=$this->db_name", $this->db_user, $this->db_pass);
	        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql="CREATE TABLE  IF NOT EXISTS prof( id INT NOT NULL AUTO_INCREMENT , nom VARCHAR(25) NOT NULL , prenom VARCHAR(25) NOT NULL , date_naissance DATE NOT NULL , lieu_naissance TEXT NOT NULL , PRIMARY KEY (id)) ";
	        $this->bdd->exec($sql);
	        $sql="CREATE TABLE  IF NOT EXISTS cours( id INT NOT NULL AUTO_INCREMENT , intitule VARCHAR(50) NOT NULL , duree INT NOT NULL , id_prof INT NOT NULL , PRIMARY KEY (id), FOREIGN KEY (id_prof) REFERENCES prof(id)) ";
	        $this->bdd->exec($sql);
	    }
	    
	    catch (Exception $e)
	    {
	        die('Erreur : ' . $e->getMessage());
	    }
	}

    public function getDB()
    {
        return $this->bdd;
    }
    public function GetDatasP($id)
	{
	    $stmt = $this->bdd->prepare("select nom, prenom, date_naissance, lieu_naissance from prof where id=?");
	    $stmt->execute([$id]);
	    $user = $stmt->fetch();
	    $datas = array();
	    array_push($datas,$user['nom']);
	    array_push($datas,$user['prenom']);
	    array_push($datas,$user['date_naissance']);
	    array_push($datas,$user['lieu_naissance']);
	    return $datas;
		
	}
		public function GetDatasC($id)
	{
	    $stmt = $this->bdd->prepare("select intitule, duree, id_prof from cours where id=?");
	    $stmt->execute([$id]);
	    $user = $stmt->fetch();
	    $datas = array();
	    array_push($datas,$user['intitule']);
	    array_push($datas,$user['duree']);
	    array_push($datas,$user['id_prof']);
	    return $datas;
		
	}
	public function GetIdC($intitule,$duree)
	{
	    $stmt = $this->bdd->prepare("select id from cours where intitule=? and duree=?");
	    $stmt->execute([$intitule,$duree]); 
	    $user = $stmt->fetch();
	    return $user['id'];
	}
	
public function AffichageProf($etat)
	{
	    print("\n".$etat."\n");
	    $stmt = $this->bdd->prepare("select * from prof");
	    $stmt->execute();
	    while($row = $stmt->fetch())
	    {
	        echo "* id: " . $row["id"]. " Last Name: " . $row["nom"]. " First Name: " . $row["prenom"]. " Birth Date: " . $row["date_naissance"]. " birth Place: " . $row["lieu_naissance"] ."\n";
	    }
	    return true;
	    
	}
	public function AffichageCours($etat)
	{
	    print("\n".$etat."\n");
	    $stmt = $this->bdd->prepare("select * from cours");
	    $stmt->execute();
	    while($row = $stmt->fetch())
	    {
	        echo "* id: " . $row["id"]. " Name: " . $row["intitule"]. " Time: " . $row["duree"]. " Id Prof: " . $row["id_prof"] ."\n";
	    }
	    return true;
	}
	
	public function InsertP($bdd, $nom, $prenom , $date_naissance,$lieu)
	{  
	    try 
	    {
	       $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	       $sql = "INSERT INTO prof (nom, prenom, date_naissance, lieu_naissance) VALUES ('$nom','$prenom', '$date_naissance','$lieu')";
	       $bdd->exec($sql);
	       return true;
	    }
	    catch(PDOException $e)
	    {
	        echo $sql . "<br>" . $e->getMessage();
	        return false;
	    }
	    
	}
	
	public function GetIdP($nom,$prenom)
	{
	    $stmt = $this->bdd->prepare("select id from prof where nom=? and prenom=?");
	    $stmt->execute([$nom,$prenom]); 
	    $user = $stmt->fetch();
	    return $user['id'];
	}
	public function GetLastIDP()
	{
	    $stmt = $this->bdd->prepare("select max(id) as maximum from prof");
	    $stmt->execute();
	    $user = $stmt->fetch();
	    return $user['maximum'];
	}
	
	public function GetLastIDC()
	{
	    $stmt = $this->bdd->prepare("select max(id) as maximum from cours");
	    $stmt->execute();
	    $user = $stmt->fetch();
	    return $user['maximum'];
	}
	
	public function InsertC($bdd, $intitule, $duree , $id_prof)
	{
	    try
	    {
	        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "INSERT INTO cours (intitule, duree, id_prof) VALUES ('$intitule','$duree', '$id_prof')";
	        $bdd->exec($sql);
	        return true;
	    }
	    catch(PDOException $e)
	    {
	        echo $sql . "<br>" . $e->getMessage();
	    }
	    
	}
	public function DropData(){
		$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	       	$sql = "DELETE from cours";
		$this->bdd->exec($sql);
		$sql = "DELETE from prof";
	       	$this->bdd->exec($sql);
	       	return true;
	}
		
	public function UpdateP($id, $nom, $prenom, $date, $lieu)
	{
	    try
	    {
		$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE prof SET nom = '$nom', prenom = '$prenom', date_naissance = '$date', lieu_naissance = '$lieu' WHERE id = '$id'";
		$this->bdd->exec($sql);
		return true;
	    }
	    catch(PDOException $e)
	    {
	        echo $sql . "<br>" . $e->getMessage();
		return false;
	    }
	}
	    
	public function UpdateC($id, $intitule, $duree, $id_prof)
	{
	    try
	    {
		$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE cours SET intitule = '$intitule', duree = '$duree', id_prof = '$id_prof' WHERE id = '$id'";
		$this->bdd->exec($sql);
		return true;
	    }
	    catch(PDOException $e)
	    {
	        echo $sql . "<br>" . $e->getMessage();
		return false;
	    }
	}
	
	
	public function DeleteP($id)
	{
	    try
	    {
		$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM prof WHERE id = '$id'";
		$this->bdd->exec($sql);
		return true;
	    }
	    catch(PDOException $e)
	    {
	        echo $sql . "<br>" . $e->getMessage();
		return false;
	    }
	}
	public function DeleteC($id)
	{
	    try
	    {
		$this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM cours WHERE id = '$id'";
		$this->bdd->exec($sql);
		return true;
	    }
	    catch(PDOException $e)
	    {
	        echo $sql . "<br>" . $e->getMessage();
		return false;
	    }
	}
}
