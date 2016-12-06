<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application ChampionnatGym
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 *
*/
class PdoChampionnatGym
{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=fscfrmbdym2017';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
		private static $monPdo;
		private static $monPdoChampionnatGym = null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct()
	{
    		PdoChampionnatGym::$monPdo = new PDO(PdoChampionnatGym::$serveur.';'.PdoChampionnatGym::$bdd, PdoChampionnatGym::$user, PdoChampionnatGym::$mdp); 
			PdoChampionnatGym::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoChampionnatGym::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 *
 * Appel : $instancePdoChampionnatGym = PdoChampionnatGym::getPdoChampionnatGym();
 * @return l'unique objet de la classe PdoChampionnatGym
 */
	public  static function getPdoChampionnatGym()
	{
		if(PdoChampionnatGym::$monPdoChampionnatGym == null)
		{
			PdoChampionnatGym::$monPdoChampionnatGym= new PdoChampionnatGym();
		}
		return PdoChampionnatGym::$monPdoChampionnatGym;  
	}


	// récupérer tous les hébergements
	// auteur : Rémi Hillériteau
	public function getLesHebergements($r, $o, $t)
	{
		$req = "select * from hebergement WHERE NOMHEB LIKE '%".$r."%' ORDER BY $t $o";
		$res = PdoChampionnatGym::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	// enregistrer un hébergement
	// auteur : Rémi Hillériteau
	public function setHebergement($nom, $type, $nbChambre1, $nbChambre2, $tel, $adresse, $cp, $ville, $mail)
	{

		$req = "insert into hebergement(NOMHEB, NBCHAMBRE1PLACE, NBCHAMBRE2PLACES, TYPE, TELHEB, ADRESSE, VILLE, CP, MAIL) values ('$nom','$nbChambre1','$nbChambre2','$type','$tel','$adresse','$ville','$cp', '$mail')";
		$res = PdoChampionnatGym::$monPdo->exec($req);
	}

	public function getUnHebergement($id)
	{
		$req = "select * from hebergement WHERE IDHEB='$id'";
		$res = PdoChampionnatGym::$monPdo->query($req);
		$uneLigne = $res->fetch();
		return $uneLigne;
	}
	
	// compte le nombre de réservation pour un hébergement et pour une chambre de 1 ou 2 places
	// auteur : Rémi Hillériteau
	public function getReservation($idHeb, $place)
	{
		if($place==1)
			$conjoint=0;
		else
			$conjoint=1;

		$req = "select COUNT(*) as 'nb' from juge WHERE IDHEB='$idHeb' AND CONJOINT='$conjoint'";
		$res = PdoChampionnatGym::$monPdo->query($req);
		$uneLigne = $res->fetch();
		$valeur=$uneLigne['nb'];
		return $valeur;
	}

	// modifier un hébergement
	// auteur : Rémi Hillériteau
	public function modifHebergement($id, $nom, $type, $nbChambre1, $nbChambre2, $tel, $adresse, $cp, $ville, $mail)
	{
		$req = "UPDATE hebergement
				SET NOMHEB='$nom',
					NBCHAMBRE1PLACE='$nbChambre1',
				 	NBCHAMBRE2PLACES='$nbChambre2',
				   	TYPE='$type',
				    TELHEB='$tel',
				    ADRESSE='$adresse',
				    VILLE='$ville', 
				    CP='$cp',
				    MAIL='$mail'
				WHERE IDHEB='$id' ";
		$res = PdoChampionnatGym::$monPdo->exec($req);
	}

	// supprimer un hébergement
	// auteur : Rémi Hillériteau
	public function supHebergement($id)
	{
		$req = "DELETE FROM hebergement
				WHERE IDHEB='$id' ";
		$res = PdoChampionnatGym::$monPdo->exec($req);
	}
}
?>
