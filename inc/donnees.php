<?php

//fonction qui crée les sujets et textes les différents emails aux visiteurs/kidonateurs et assos et prépare leur envoi

	if (!defined("_ECRIRE_INC_VERSION")) return;



	
	// On récupère les données nécessaires à envoyer le mail de validation
	// La fonction envoyer_mail se chargera de nettoyer cela plus tard

	$nom_site_spip = $GLOBALS['meta']["nom_site"];
	$url_site = $GLOBALS['meta']["adresse_site"];
	$spip_lang='fr';
	$nom_site_spip = $GLOBALS['meta']["nom_site"];
	$expediteur = $GLOBALS['meta']["email_webmaster"];			
	$from = $nom_site_spip.'<'.$expediteur.'>';
	$id_objet = $GLOBALS['id_objet'];	
	$email = $GLOBALS['email'];		

	//On prépare le infos pour le message et sujet

	$sql = spip_query( "SELECT * FROM spip_auteurs WHERE email='$email'");
	while($data = spip_fetch_array($sql)) {
		$nom =extraire_multi($data['nom']);
		$id_auteur = $data['id_auteur'];
		$sql = spip_query( "SELECT * FROM spip_auteurs_elargis WHERE id_auteur='$id_auteur'");
			while($data = spip_fetch_array($sql)) {
				$prenom = extraire_multi($data['prenom']);
				$nom_famille = extraire_multi($data['nom_famille']);
				$langue = $data['langue'];
				}
		}

	$sql = spip_query( "SELECT * FROM spip_encheres_objets WHERE id_objet='$option'");
		while($data = spip_fetch_array($sql)) {
			$id_article = $data['id_article'];
			$duree_mise = $data['duree'];
			$date_debut_evenement = affdate($data['date_debut_evenement'],'d-m-Y');
			$date_fin_evenement=date('d-m-Y', strtotime ($data['date_stop_vente'].' "+13 day"'));
			$date_fin = affdate($data['date_fin'],'d-m-Y G:i:s');
			$date_debut_evenement = affdate($data['date_debut_evenement'],'d/m/Y');			
			$date_fin_evenement = affdate($data['date_fin_evenement'],'d/m/Y');
 			$date_vente = date('d-m-Y',strtotime($data['date_vente']));
 			$validite = $date_debut_evenement.'-'.$date_fin_evenement;
 			if($date_debut_evenement==$date_fin_evenement)$validite=$date_debut_evenement;
 			
			$mode_livraison = $data['mode_livraison'];
			$prix_livraison = $data['prix_livraison'];
			$prix_livraison_etranger = $data['prix_livraison_etranger'];			
			$courrier_velo = $data['courrier_velo'];				
			$montant_mise = $data['montant_mise'];
			$id_auteur = $data['id_auteur'];
			$envoi_rappels = $data['envoi_rappels'];
			$id_acheteur = $data['id_acheteur'];
			$nombre = $data['nombre'];
			$livraison_etranger = $data['livraison_etranger'];			
			$acheteur = spip_query( "SELECT * FROM spip_auteurs WHERE id_auteur='$id_acheteur'");
			
			while($data = spip_fetch_array($acheteur )) {
				$id_acheteur = $data['id_auteur'];			
				$email_acheteur = $data['email'];
				$nom_acheteur = $data['nom'];
				$acheteur_el = spip_query( "SELECT * FROM spip_auteurs_elargis WHERE id_auteur='$id_acheteur'");	
					while($data = spip_fetch_array($acheteur_el)) {
					$prenom_acheteur = $data['prenom'];
					$nom_famille_acheteur = $data['nom_famille'];
					$langue_acheteur = $data['langue'];	
					$pays_acheteur = $data['pays'];										
					}				
				}

				
			$sql = spip_query( "SELECT * FROM spip_auteurs WHERE id_auteur='$id_auteur'");
				while($data = spip_fetch_array($sql)) {
					$nom_kidonateur = extraire_multi($data['nom']);
					$email_kidonateur = $data['email'];

					$sql = spip_query( "SELECT * FROM spip_auteurs_elargis WHERE id_auteur='$id_auteur'");
						while($data = spip_fetch_array($sql)) {
						$prenom_kidonateur = extraire_multi($data['prenom']);
						$nom_famille_kidonateur = extraire_multi($data['nom_famille']);
						$paypal_kidonateur = $data['paypal'];
						$adresse_kidonateur = $data['adresse'];		
						$pays_k = $data['pays'];
						$bic_kidonateur = $data['bic'];																
						$compte_bancaire_kidonateur = 	_T('encheres:compte_bancaire').' : '.$data['compte_bancaire'].' - '
														._T('encheres:bic').' : '.$bic_kidonateur;
						

						$langue_kidonateur = $data['langue'];

						$id_commune = $data['id_commune'];						
						$sql2 = spip_query( "SELECT * FROM spip_mots WHERE id_mot='$id_commune'");
						while($data2 = spip_fetch_array($sql2)) {
							$ville_kidonateur = $data2['titre'];
							$code_postal_kidonateur = $data2['code_postal'];
							}
						$sql3 = spip_query( "SELECT * FROM spip_groupes_mots WHERE id_groupe='$pays_k'");
						while($data3 = spip_fetch_array($sql3)) {
							$pays_kidonateur = $data3['titre'];
							}											
						$adresse_kidonateur = $adresse_kidonateur.', '.$code_postal_kidonateur.' '.$ville_kidonateur.' - '.$pays_kidonateur;	
						}
					}		
					

			$sql = spip_query( "SELECT * FROM spip_articles WHERE id_article='$id_article'");
				while($data = spip_fetch_array($sql)) {
					$titre_article = $data['titre'];
					$id_rubrique = $data['id_rubrique'];
					$commentaire = $data['chapo'];
					
					$sql_bill = spip_query( "SELECT * FROM spip_mots_articles WHERE id_article='$id_article'");
						while($data = spip_fetch_array($sql_bill)) {
						$id_mot= $data['id_mot'];
						$billet = spip_query( "SELECT * FROM spip_mots WHERE id_mot='$id_mot' AND id_groupe='80'");
							while($data = spip_fetch_array($billet)) {
							$id_groupe= $data['id_groupe'];
							$billetterie='ok';
							}						
						}

					$sql = spip_query( "SELECT * FROM spip_rubriques WHERE id_rubrique='$id_rubrique'");
						while($data = spip_fetch_array($sql)) {
    						$titre_rubrique = $data['titre']; 
						$id_auteur_rubrique = $data['id_auteur'];
						$compte_bancaire_projet = $data['compte_bancaire'];
						$communication_virement_projet = $data['communication_virement'];
							$sql = spip_query( "SELECT * FROM spip_auteurs WHERE id_auteur='$id_auteur_rubrique'");
								while($data = spip_fetch_array($sql)) {
								$nom_asso = $data['nom'];
								$id_auteur_asso = $data['id_auteur'];
								$email_asso = $data['email'];
								if ($type=='enchere_gagnee'  OR $type=='rappel_acheteur' OR $type=='enchere_gagnee_asso' OR $type=='rappel_asso'){
									$sql2 = spip_query( "SELECT * FROM spip_auteurs_elargis WHERE id_auteur='$id_auteur_asso'");
									while($data = spip_fetch_array($sql2)) {
										$prenom_asso = extraire_multi($data['prenom']);
										$nom_famille_asso = extraire_multi($data['nom_famille']);
										$compte_bancaire_asso = $data['compte_bancaire'];
										$communication_virement_asso = $data['communication_virement'];
										$adresse_asso = extraire_multi($data['adresse']);
										$code_postal_asso = $data['code_postal'];
										$ville_asso = extraire_multi($data['ville']);
										$paypal_asso	 = extraire_multi($data['paypal']);
										$langue_asso = $data['langue'];
										$adresse_asso = $adresse_asso.', '.$code_postal_asso.' '.$ville_asso;
										if($compte_bancaire_projet){$compte_bancaire_asso=$compte_bancaire_projet;}
										if($communication_virement_projet){$communication_virement_asso=$communication_virement_projet;}
										if(!$communication_virement_asso){$communication_virement_asso='kidonaki';}
										}	
									}
								}
							}
						}
				}

		// Détermine le prix de livraison, nationale ou étranger
		
		if ($pays_acheteur != $pays_k AND $livraison_etranger) {$prix_livraison =$prix_livraison_etranger;}
		if ($billetterie) $html='oui';		
		


?>