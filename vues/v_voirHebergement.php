<!--  auteur : Rémi Hillériteau -->
<h2>Les hébergements</h2>
<table class='tableau'>
	<tr>
		<th>Nom hebergement</th>
		<th>Type</th>
		<th>adresse</th>
		<th>Chambre 1 place</th>
		<th>Chambre 2 places</th>
	</tr>

	<?php
		foreach ($lesHebergements as $unHebergement) {

			if($unHebergement['TYPE']=='h')
				$unHebergement['TYPE']='hotel';
			elseif($unHebergement['TYPE']=='p')
				$unHebergement['TYPE']='particulier';
		
			echo "<tr>";
				echo "<td>" . $unHebergement['NOMHEB'] . "</td>";
				echo "<td>" . $unHebergement['TYPE'] . "</td>";
				echo "<td>" . $unHebergement['ADRESSE'] . " " . $unHebergement['CP'] . " " . $unHebergement['VILLE'] ."</td>";
				echo "<td>" . $unHebergement['NBCHAMBRE1PLACE'] . "</td>";
				echo "<td>" . $unHebergement['NBCHAMBRE2PLACES'] . "</td>";
				echo "<td class='case' alt=\"plus d'info\" title=\"plus d'info\" onclick='document.location.href=\"?uc=gererHebergementJuges&action=detailHebergement&id=" . $unHebergement['IDHEB'] . "\";''><img src='images/plus1.png'/></td>";
				echo "<td class='case' alt='modifier' title='modifier' onclick='document.location.href=\"?uc=gererHebergementJuges&action=modifierHebergement&id=" . $unHebergement['IDHEB'] . "\";'><img src='images/modifier.gif'/></td>";
				echo "<td class='case' alt='supprimer' title='supprimer' onclick='document.location.href=\"?uc=gererHebergementJuges&action=supprimerHebergement&id=" . $unHebergement['IDHEB'] . "\";''><img src='images/supp.png'/></td>";
			echo "</tr>";

			
		}

	?>
</table>