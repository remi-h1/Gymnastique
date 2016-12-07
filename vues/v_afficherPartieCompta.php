<!--  
page pour gérer la partie compta
auteur : Rémi Hillériteau
 -->
<h2>La partie compta</h2>

<form method="post" action="" name="formulaireRecherche" class='formulaire'>
	<select name='asso' id='asso'>
		<?php
			foreach ($lesAssociations as $uneAssociation) {
				$selected=selected($uneAssociation['NUMEROASSO'], 'asso');
				echo "<option value='" . $uneAssociation['NUMEROASSO'] . "'" . $selected . ">" .  $uneAssociation['NOMA']. ", " . cp($uneAssociation['CPA']) . " "  . $uneAssociation['VILLEA'] . "</option>";
			}
		?>
	</select>
</form>

<form method="post" action="?uc=gererPartieComptable&action=modifierCompta&asso=<?php echo $idAsso; ?>" name="formulaire" class='formulaire'>
	<table>
		<tr>
			<td>Montant inscription équipe</td>
			<td><i>affiché prix ?</i></td>
		</tr>
		<tr>
			<td>Acompte (envoyé)</td>
			<td>
				<input type="radio" name="acompte" value="1" id="oui" <?php echo checked($acompte, 1); ?> /> <label for="oui">oui</label>
				<input type="radio" name="acompte" value="0" id="non"  <?php echo checked($acompte, 0); ?> /> <label for="non">non</label>
			</td>
		</tr>
		<tr>
			<td>Acompte reçu</td>
			<td>
				<input type="radio" name="acompteRecu" value="1" id="oui"  <?php echo checked($acompteRecu, 1); ?> /> <label for="oui">oui</label>
				<input type="radio" name="acompteRecu" value="0" id="non"  <?php echo checked($acompteRecu, 0); ?> /> <label for="non">non</label>
			</td>
		</tr>
		<tr>
			<td>Facture acompte</td>
			<td>
				<input type="radio" name="factureAcompte" value="1" id="oui"  <?php echo checked($factureAcompte, 1); ?> /> <label for="oui">oui</label>
				<input type="radio" name="factureAcompte" value="0" id="non"  <?php echo checked($factureAcompte, 0); ?> /> <label for="non">non</label>
			</td>
		</tr>
		<tr>
			<td>Mode de règlement</td>
			<td>
				<input type="radio" name="modeReglement" value="chq" id="chq"  <?php echo checked($modeReglement, 'chq'); ?> /> <label for="chq">chèque</label>
				<input type="radio" name="modeReglement" value="espece" id="espece"  <?php echo checked($modeReglement, 'espece'); ?> /> <label for="espece">espèce</label>
				<input type="radio" name="modeReglement" value="virement" id="virement"  <?php echo checked($modeReglement, 'virement'); ?> /> <label for="virement">virement</label>
			</td>
		</tr>
		<tr>
			<td>Règlement solde association</td>
			<td>
				<input type="radio" name="soldeAsso" value="1" id="oui"  <?php echo checked($reglementSolde, 1); ?> /> <label for="oui">oui</label>
				<input type="radio" name="soldeAsso" value="0" id="non"  <?php echo checked($reglementSolde, 0); ?> /> <label for="non">non</label>
			</td>
		</tr>
		<tr>
			<td>Ouverture du compte association</td>
			<td>
				<input type="radio" name="ouvertureCompteAsso" value="1" id="oui"  <?php echo checked($ouvertureCompte, 1); ?> /> <label for="oui">oui</label>
				<input type="radio" name="ouvertureCompteAsso" value="0" id="non"  <?php echo checked($ouvertureCompte, 0); ?> /> <label for="non">non</label>
			</td>
		</tr>
	</table>

	<input type='submit' value='Modifier' />
	<input type='reset' value='Réinitialiser' />

	<?php
		echo "<input type='hidden' name='idAsso' value='" . $idAsso . "'/>";
	?>
</form>



<script>

var asso = document.getElementById('asso');
var lien;

// mois : lorsque l'on change le mois dans le select de mois, on récupère d'autre données
asso.addEventListener('change', function() {

lien="?uc=gererPartieComptable&action=afficherPartieCompta&asso=" + asso.options[asso.selectedIndex].value;
document.location.href=lien;

});

</script>