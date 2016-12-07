<!--  
page pour voir la liste des hébergements et leurs infos
auteur : Rémi Hillériteau
 -->
<h2>Les hébergements</h2>

<form method="post" action="?uc=gererHebergementJuges&action=afficherListeHebergement" name="formulaire" class='formulaire'>
	<label for='r'>Recherche par nom : </label><input name='r' maxlength="20" type="text" />
	<input type="submit" value="ok">
</form>

<?php
if($lesHebergements==NULL)
{
	echo "<p>Aucun résultat trouvé";
}
else
{
	?>
	<table class='tableau'>
		<tr>
			<th <?php echo trieListeHebergement('NOMHEB'); ?> >Nom hebergement</th>
			<th <?php echo trieListeHebergement('TYPE'); ?> >Type</th>
			<th <?php echo trieListeHebergement('ADRESSE'); ?> >adresse</th>
			<th <?php echo trieListeHebergement('NBCHAMBRE1PLACE'); ?> >Chambre 1 place</th>
			<th <?php echo trieListeHebergement('NBCHAMBRE2PLACES'); ?> >Chambre 2 places</th>
			<th <?php echo trieListeHebergement('MAIL'); ?> >mail</th>
			<th <?php echo trieListeHebergement('TELHEB'); ?> >téléphone</th>
		</tr>

		<?php
			foreach ($lesHebergements as $unHebergement) {

				if($unHebergement['TYPE']=='h')
					$unHebergement['TYPE']='hotel';
				elseif($unHebergement['TYPE']=='p')
					$unHebergement['TYPE']='particulier';
				
				$id=$unHebergement['IDHEB'];
				$nom=$unHebergement['NOMHEB'];
				$adresse=$unHebergement['ADRESSE'];
				$cp=$unHebergement['CP'];
				$ville=$unHebergement['VILLE'];
				$nbChambre1P=$unHebergement['NBCHAMBRE1PLACE'];
				$nbChambre2P=$unHebergement['NBCHAMBRE2PLACES'];
				$mail=$unHebergement['MAIL'];
				$tel=$unHebergement['TELHEB'];

				$nbChambre1PReserve=$pdo->getReservation($id, 1);
				$nbChambre2PReserve=$pdo->getReservation($id, 2);
				$nombreDisponible1=$nbChambre1P-$nbChambre1PReserve;
				$nombreDisponible2=$nbChambre2P-$nbChambre2PReserve;

				?>
				<tr>
					<td><?php echo $nom; ?></td>
					<td><?php echo $unHebergement['TYPE']; ?></td>
					<td><?php echo $adresse . " " . $cp . " " . $ville; ?></td>

					<td><?php echo $nbChambre1P; ?><span class='detailReservation'> (<?php echo $nombreDisponible1 . " diponible"; if($nombreDisponible1>1) { echo "s"; } echo ")"; ?></span></td>
					<td><?php echo $nbChambre2P; ?><span class='detailReservation'> (<?php echo $nombreDisponible2 . " disponible"; if($nombreDisponible2>1) { echo "s"; } echo ")"; ?></td>
					<td><?php echo $mail; ?></td>
					<td><?php echo tel($tel); ?></td>
					
					<td class='case' alt='modifier' title='modifier' onclick='document.location.href="?uc=gererHebergementJuges&action=modifierHebergement&id=<?php echo $id; ?>";'><img src='images/modifier.gif'/></td>
					<td class='case' alt='supprimer' title='supprimer' onclick='confirmSupprHeb(<?php echo $id . ',' . $nbChambre1PReserve . ',' . $nbChambre2PReserve; ?>);''><img src='images/supp.png'/></td>
				</tr>

				<?php
			}

		?>
	</table>
<?php
}
?>
