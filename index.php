<?php
session_start();
require_once("util/fonctions_PHP.php");
require_once("util/class.pdoChampionnatGym.php");

if(!isset($_REQUEST['uc']))
	$uc = 'accueil';
else
	$uc = $_REQUEST['uc'];

include("vues/c_entete.php") ;
include("vues/v_bandeau.php") ;

$pdo = PdoChampionnatGym::getPdoChampionnatGym();

switch($uc)
{
	case 'accueil':
		{include("vues/v_accueil.php");break;}
}
include("vues/v_pied.php") ;
?>
