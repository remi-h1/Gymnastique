<!--  auteur : Rémi Hillériteau -->

<h2>Nouvel hébergement</h2>
<form method="post" action="?uc=gererHebergementJuges&action=validerNouvelHebergement" name="formulaire" class='formulaire'>
	<table>
		<tr>
			<td>Nom hébergement :</td>
			<td><input type='texte' name="nom" id="nom" maxlength="30" size="30" value='<?PHP echo $nom; ?>'/></td>
		</tr>
		<tr>
			<td>Type :</td>
			<td>
				<select name='type' id='type'>
					<option value='p' <?php if($type=='p') { echo " selected='selected '"; } ?> >Particulier</option>
					<option value='h' <?php if($type=='h') { echo " selected='selected '"; } ?> >Hôtel</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Nombre de chambre 1 place :</td>
			<td><input type='number' name="chambre1" id="chambre1" min='0' max='1000' size="5" value='0' value='<?PHP echo $nbChambre1; ?>'/></td>
		</tr>
		<tr>
			<td>Nombre de chambre 2 places :</td>
			<td><input type='number' name="chambre2" id="chambre2" min='0' max='1000' size="5" value='0' value='<?PHP echo $nbChambre2; ?>'/></td>
		</tr>
		<tr>
			<td>Numéro de téléphone :</td>
			<td><input type='texte' name="tel" id="tel" maxlength="10" size="11" value='<?PHP echo $tel; ?>'/></td>
		</tr>
		<tr>
			<td>Adresse :</td>
			<td><input type='texte' name="adresse" id="adresse" maxlength='50' size="30" value='<?PHP echo $adresse; ?>'/></td>
		</tr>
		<tr>
			<td>Code postal :</td>
			<td><input type='texte' name="cp" id="cp" maxlength='5' size="5" value='<?PHP echo $cp; ?>'/></td>
		</tr>
		<tr>
			<td>Ville :</td>
			<td><input type='texte' name="ville" id="ville" maxlength='50' size="30" value='<?PHP echo $ville; ?>'/></td>
		</tr>
		<tr>
			<td>Adresse mail :</td>
			<td><input type='texte' name="mail" id="mail" maxlength='50' size="30" value='<?PHP echo $ville; ?>'/></td>
		</tr>
	</table>
	<input type='button' value='Valider' onClick="return verifFormulaire();" />
</form>

<script type="text/JavaScript">

// déclaration des variables pour la fonction verifFormulaire
	// on déclare les variables ici, pour ne pas recréer les variables à chaque execution de la fonction
var nom, type, chambre1, chambre2, tel, adresse, cp, ville, mail, envoyer, alerts, confirmer;

	function verifFormulaire()
	{
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
					creerUneAlerte('Le nombre est incorrecte', chambre1);
				}

			// chambre 2 places
			if(chambre2.value>1000  || chambre2.value<0 || isNaN(chambre2.value))
				{
					creerUneAlerte('Le nombre est incorrecte', chambre2);
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
</script>
