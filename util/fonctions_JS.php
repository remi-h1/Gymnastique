<script type="text/JavaScript">

// fonction pour vérifier les saisies du formulaire de création et de modification d'hébergement
// auteur : Rémi Hillériteau
function verifFormulaireGererHeb()
{
	// déclaration des variables
	var nom, type, chambre1, chambre2, tel, adresse, cp, ville, mail, envoyer, alerts, confirmer;

	<?php 
	// pour tester si le changement du nombre de chambre ne perturbe pas les réservations par les juges
	if(isset($nbChambre1PReserve))
	{
		echo "nbChambre1PReserve = " . $nbChambre1PReserve . ";";
		echo "nbChambre2PReserve = " . $nbChambre2PReserve . ";";
	}
	else
	{
		echo "nbChambre1PReserve =  0 ;";
		echo "nbChambre2PReserve =  0 ;";
	}
	?>

	// suppression des alerts précédentes (si une vérif à déjà été effectué)
		alerts=document.querySelectorAll('#alert');

		for(i=0; i<alerts.length; i++)
		{
			alerts[i].parentNode.removeChild(alerts[i]);
		}

	// initialisation des variables
		nom = document.formulaire.nom;
		type = document.formulaire.type;
		chambre1 = document.formulaire.chambre1;
		chambre2 = document.formulaire.chambre2;
		tel = document.formulaire.tel;
		adresse = document.formulaire.adresse;
		cp = document.formulaire.cp;
		ville = document.formulaire.ville;
		mail = document.formulaire.mail;
		envoyer=true;


	// les vérifications avent l'envoie du formulaire
		//le nom
		if(nom.value.length>30  || nom.value.length==0 || !(isNaN(nom.value)))
			{
				creerUneAlerte('Le nom est incorrect', nom);
			}

		// chambre 1 place
		if(chambre1.value>1000  || chambre1.value<0 || isNaN(chambre1.value))
			{
				creerUneAlerte('Le nombre est incorrecte, il ne peut pas dépasser 3 chiffres', chambre1);
			}

		// chambre 2 places
		if(chambre2.value>1000  || chambre2.value<0 || isNaN(chambre2.value))
			{
				creerUneAlerte('Le nombre est incorrecte, il ne peut pas dépasser 3 chiffres', chambre2);
			}

		// tel
		var telNumber=tel.value.replace(/ /g, ""); // on enlève les espaces si existant

		if(telNumber.length!=10 || isNaN(telNumber))
			{
				creerUneAlerte('Le numéro de téléphone est incorrect', tel);
			}

		// adresse
		if(adresse.value.length==0)
			{
				creerUneAlerte('Vous devez remplir ce champ', adresse);
			}

		// le code postal
			var cpNombre=cp.value.replace(/ /g, "");

			if(cpNombre.length!=5 || (isNaN(cpNombre)))
			{
				creerUneAlerte('le code postal doit comporter 5 chiffres', cp);
			}

		// la ville
			if(ville.value.length==0 || !(isNaN(ville.value)))
			{
				creerUneAlerte('Le nom de la ville est incorrect', ville);
			}

		// l'adresse mail
			if(mail.value<8 || mail.value>50 || mail.value.length<4 || mail.value.indexOf('@', 0)==-1 || mail.value.indexOf('.', 0)==-1)
			{
				creerUneAlerte('L\'adresse mail n\'est pas correcte', mail);
			}

		// vérifier si il y a au moins une chambre de proposé
			if(chambre1.value+chambre2.value==0 && envoyer==true)
			{
				confirmer=confirm('Attention, l\'hébergement que vous souhaitez enregistrer ne propose aucune chambre, voulez vous continez ?');
				if(confirmer==false)
					envoyer=false;
			}

		// test si le changement du nombre de chambre ne perturbe pas les réservations par les juges
			if(chambre1.value < nbChambre1PReserve && envoyer==true)
			{
				envoyer=false;
				alert('La modification ne peut pas être effectué. Il y a ' + chambre1.value + ' chambre(s) 1 place pour ' + nbChambre1PReserve + ' réservation(s). Supprimer des réservations et recommencer');
			}

			if(chambre2.value < nbChambre2PReserve && envoyer==true)
			{
				envoyer=false;
				alert('La modification ne peut pas être effectué. Il y a ' + chambre2.value + ' chambre(s) 2 places pour ' + nbChambre2PReserve + ' réservation(s). Supprimer des réservations et recommencer');
			}

	// on renvoie si le formulaire peut être envoyé ou non
		if(envoyer==true)
		{
			document.formulaire.submit();
		}
		else
		{
			return false;
		}

}

// fonction qui permet de créer une alerte sur un formulaire
// auteur : Rémi Hillériteau
function creerUneAlerte(message, variable)
{
	var newAlert = document.createElement('span');
	var newAlertText = document.createTextNode(message);

	newAlert.id="alert";
	newAlert.name="alert";

	newAlert.appendChild(newAlertText);

	variable.parentNode.insertBefore(newAlert, variable.previousElementSibling);

	envoyer=false;
}

// fonction qui permet de confirmer la demande de supression d'un hébergement et de vérifier si elle est posible
// auteur : Rémi Hillériteau
function confirmSupprHeb(id, nbChambre1PReserve, nbChambre2PReserve)
{
	var reservation;
	reservation=nbChambre1PReserve-(-nbChambre2PReserve);

	if(reservation>=1)
	{
		alert("L'hébergement ne peut pas être supprimer car des judes ont déjà réservé dans cet hébergement");

	}
	else
	{
		if(confirm("Voulez vous vraiment supprimer cet hébergement ? L'opération est iréversible"));
		document.location.href='?uc=gererHebergementJuges&action=supprimerHebergement&id=' + id;
	}
}


</script>