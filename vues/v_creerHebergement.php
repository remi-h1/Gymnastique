<!--  auteur : Rémi Hillériteau -->

<h2><?php echo $titreForm; ?></h2>
<form method="post" action="?uc=gererHebergementJuges&action=<?php echo $action; ?>" name="formulaire" class='formulaire'>
	<table>
		<tr>
			<td>Nom hébergement :</td>
			<td><input type='text' name="nom" id="nom" maxlength="30" size="30" value='<?PHP echo $nom; ?>'/></td>
		</tr>
		<tr>
			<td>Type :</td>
			<td>
				<select name='type' id='type'>
					<option value='p' <?php if($type=='particulier') { echo " selected='selected '"; } ?> >Particulier</option>
					<option value='h' <?php if($type=='hotel') { echo " selected='selected '"; } ?> >Hôtel</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Nombre de chambre 1 place :</td>
			<td><input type='number' name="chambre1" id="chambre1" min='0' max='1000' size="5" value='<?PHP echo $nbChambre1; ?>'/></td>
		</tr>
		<tr>
			<td>Nombre de chambre 2 places :</td>
			<td><input type='number' name="chambre2" id="chambre2" min='0' max='1000' size="5" value='<?PHP echo $nbChambre2; ?>'/></td>
		</tr>
		<tr>
			<td>Numéro de téléphone :</td>
			<td><input type='text' name="tel" id="tel" maxlength="10" size="11" value='<?PHP echo $tel; ?>'/></td>
		</tr>
		<tr>
			<td>Adresse :</td>
			<td><input type='text' name="adresse" id="adresse" maxlength='50' size="30" value='<?PHP echo $adresse; ?>'/></td>
		</tr>
		<tr>
			<td>Code postal :</td>
			<td><input type='text' name="cp" id="cp" maxlength='5' size="5" value='<?PHP echo $cp; ?>'/></td>
		</tr>
		<tr>
			<td>Ville :</td>
			<td><input type='text' name="ville" id="ville" maxlength='50' size="30" value='<?PHP echo $ville; ?>'/></td>
		</tr>
		<tr>
			<td>Adresse mail :</td>
			<td><input type='text' name="mail" id="mail" maxlength='50' size="30" value='<?PHP echo $mail; ?>'/></td>
		</tr>
	</table>
	<?php
	// si on modifie un hébergement, on envoie l'id
	if($action=='validerModifHebergement')
		echo " <input type='hidden' name='id' value='" . $id . "' /> ";
	?>
	<input type='button' value='Valider' onClick="return verifFormulaireGererHeb();" />
	<?php
		if($action=='validerModifHebergement')
			echo "<input type='reset' value='Réinitialiser' />";
	?>
	<input type='button' value='Annuler' onClick="document.location.href='?uc=gererHebergementJuges&action=afficherListeHebergement';" />
	
</form>
