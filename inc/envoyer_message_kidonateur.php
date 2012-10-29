<?php

//fonction qui crée les sujets et textes les différents emails aux visiteurs/kidonateurs et assos et prépare leur envoi

	if (!defined("_ECRIRE_INC_VERSION")) return;

function inc_envoyer_message_kidonateur_dist($email='',$type,$id_objet="",$contexte="") {
    	include_spip('inc/mail');
	include_spip('inc/encheresmail_fonctions');	
	include_spip('inc/filtres');	
	include_spip('encheres_fonctions');		   
	
	if(is_array($contexte)){					
		foreach($contexte as $key=>$item){
			$$key=$item;
			}
		} 	

	// On récupère les données nécessaires à envoyer le mail de validation
	// La fonction envoyer_mail se chargera de nettoyer cela plus tard

	$nom_site_spip = $GLOBALS['meta']["nom_site"];
	$url_site = $GLOBALS['meta']["adresse_site"];
	$spip_lang='fr';
	$nom_site_spip = $GLOBALS['meta']["nom_site"];
	$expediteur = $GLOBALS['meta']["email_webmaster"];			
	$from = $nom_site_spip.'<'.$expediteur.'>';
	$devise = traduire_devise(lire_config('encheres/devise'));


	//On prépare le infos pour le message et sujet

	// l'objet
	
	if(!$objet){
		$objet = requete_objets(array('id_objet='.sql_quote($id_objet)));
		spip_log("action : kidonateur - requete : objet - type: $type",'mails_requetes_generes');
		}

	$id_article = $objet['id_article'];
	$id_objet = $objet['id_objet'];	
	$date_debut_evenement = affdate($objet['date_debut_evenement'],'d-m-Y');
	$date_fin_evenement=date('d-m-Y', strtotime ($objet['date_stop_vente'].' "+13 day"'));
	$date_fin = affdate($objet['date_fin'],'d-m-Y G:i:s');
	$date_debut_evenement = affdate($objet['date_debut_evenement'],'d/m/Y');			
	$date_fin_evenement = affdate($objet['date_fin_evenement'],'d/m/Y');
 	$date_vente = date('d-m-Y',strtotime($objet['date_vente']));
 	$validite = $date_debut_evenement.'-'.$date_fin_evenement;
 	if($date_debut_evenement==$date_fin_evenement)$validite=$date_debut_evenement;	
			
	$id_auteur = $objet['id_auteur'];
	
		// le kidonateur
	
	if(!$kidonateur){
		if($email)$kidonateur = requete_auteurs_elargis(array('email='.sql_quote($email)));
		elseif($id_auteur)$kidonateur = requete_auteurs_elargis(array('id_auteur='.sql_quote($id_auteur)));
		spip_log("action : kidonateur - requete: kidonateur - type : $type",'mails_requetes_generes');
		}
	
	
	$id_auteur = $kidonateur['id_auteur'];
															
	$compte_bancaire_kidonateur = 	_T('encheresmail:compte_bancaire').' : '.$kidonateur['compte_bancaire'].' - '._T('encheresmail:bic').' : '.$kidonateur['bic'];

	if(!$commune){	
		$commune = requete_geolocalites(array('id_geolocalite='.sql_quote($kidonateur['id_commune'])));
		spip_log("action : kidonateur - requete: commune - type : $type",'mails_requetes_generes');
		}

	if(!$pays_kidonateur){
		$pays_kidonateur = sql_getfetsel('titre','spip_geoentites',array('id_geoentite='.sql_quote($kidonateur['pays'])));
		spip_log("action : kidonateur - requete: pays_kidonateur - type : $type",'mails_requetes_generes');
		}
	
	if($vendeur['spip_listes_format']) $kidonateur['spip_listes_format']= $vendeur['spip_listes_format'];
										
	$adresse_kidonateur = $kidonateur['adresse'].', '.$commune['code_postal'].' '.$commune['titre'].' - '.$pays_kidonateur;	
	
	// l'acheteur
				
	if(!$acheteur){			
		$acheteur = requete_auteurs_elargis(array('id_auteur='.sql_quote($objet['id_acheteur'])));
		spip_log("action : kidonateur - requete : acheteur - type : $type",'mails_requetes_generes');
		}


	// article objet
	
	if(!$artobjet){		
		$artobjet = requete_articles(array('id_article='.sql_quote($id_article)));
		spip_log("action:kidonateur - requete:artobjet - type:$type",'mails_requetes_generes');		
		}	
				
	if(!$id_mot_article){
		$id_mot = sql_getfetsel('id_mot','spip_mots_articles',array('id_article='.sql_quote($id_article)));
		spip_log("action:kidonateur - requete:id_mot_article - type:$type",'mails_requetes_generes');	
		}
	

	// les infos projets
													
	if(!$projet){													
		$projet = requete_rubriques(array('id_rubrique='.sql_quote($artobjet['id_rubrique'])));
		spip_log("action:kidonateur - requete:projet - type:$type",'mails_requetes_generes');				
		}			

	// les infos del associations
	
	if(!$asso){		
		$asso = requete_auteurs_elargis(array('id_auteur='.sql_quote($projet['id_auteur'])));
		spip_log("action:kidonateur - requete:asso - type:$type",'mails_requetes_generes');		
		}	


	$compte_bancaire_asso = $asso['compte_bancaire'];
	$communication_virement_asso = $asso['communication_virement'];


	$adresse_asso = extraire_multi($asso['adresse']).', '.$asso['code_postal'].' '.extraire_multi($asso['ville']);
	if($projet['compte_bancaire']){$compte_bancaire_asso=$projet['compte_bancaire'];}
	if($projet['communication_virement']){$communication_virement_asso=$projet['communication_virement'];}
	if(!$communication_virement_asso){$communication_virement_asso='kidonaki';}

	// Détermine le prix de livraison, nationale ou étranger
		
	if ($acheteur['pays'] != $kidonateur['pays'] AND $objet['livraison_etranger']) {$objet['prix_livraison'] =$objet['prix_livraison_etranger'];}
	if ($billetterie) $html='oui';		
		
		
	// On détérmine la bonne langue		
	if ($acheteur['langue']) lang_select($acheteur['langue']);		
		
	$bonjour =_T('bonjour').' '. extraire_multi($kidonateur['prenom']).' '. extraire_multi($kidonateur['nom_famille']);
	$signature = _T('encheresmail:email_signature');
	$slogan =  _T('encheresmail:email_slogan');
	$message_auto =_T('encheresmail:message_auto');
	$fin_message = mise_en_forme(array($signature,$slogan),$kidonateur['spip_listes_format']);	

	if($kidonateur['spip_listes_format']=='html') {
		$header ="Content-Type: text/html; charset=UTF-8\n".
		"Content-Transfer-Encoding: 8bit\n" .
		"MIME-Version: 1.0\n";
		$contexte = array('url_image1'=>$url_site.'/squelettes/styles/images/top.jpg','background'=>$url_site.'/newsletter/billetterie/TitreBilletterie.jpg','option'=>$id_objet,'message_auto'=>$message_auto);
		$entete = recuperer_fond("inc/mail_header_html", $contexte);
		$pied = recuperer_fond("inc/mail_footer_html", $contexte);
		}
	else{
		$bonjour =array(
			$message_auto,
			_T('bonjour').' '. extraire_multi($acheteur['prenom']).' '. extraire_multi($acheteur['nom_famille'])
			);
		}	
	
	switch ($type){
	
	
	// mail de confirmation d'une lmise éffectué sur un objet du kidonateur
	case 'enchere_effectue' : 
		$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_kidonateur_enchere_effectue_sujet');
				
		$texte=array(
				$bonjour,
				_T('encheresmail:email_kidonateur_enchere_effectue',
					array(
						'titre_article' => $artobjet['titre'],
						'id_objet' => $id_objet,
						'duree_mise' => $objet['duree'],
						'titre_rubrique'=>extraire_multi($projet['titre'])
						)
					),
				);
			$corps=mise_en_forme($texte,$kidonateur['spip_listes_format']);
			$message = $corps.$fin_message;			
		break;

	// mail de confirmation de mise en vente	
	case 'mettre_en_vente':
			if ($objet['nombre'] > 1) {
				$message_nombre = _T('encheresmail:message_specifique_nombre',array('nombre' => $objet['nombre']));
				}
			$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_mise_vente_objet_sujet');
				
			$texte=array(
				$bonjour,
				_T('encheresmail:email_mise_vente_objet_message',
					array(
						'titre_article' => $artobjet['titre'],
						'id_objet' => $id_objet,
						'duree_mise' => $objet['duree'],
						'titre_rubrique'=>extraire_multi($projet['titre'])
						)
					),
				$message_nombre,
				_T('encheresmail:email_mise_vente_objet_message_remise'),
				_T('encheresmail:email_mise_vente_objet_message_email_cloture'),				
				_T('encheresmail:email_mise_vente_objet_message_soutien_projet',array('nom_asso' => extraire_multi($asso['nom']))),
				);
		
			$corps=mise_en_forme($texte,$kidonateur['spip_listes_format']);
			$message = $corps.$fin_message;			
		break;
	
			
	// mail de d'avertissment 24 heures avant remise en vente automatique

	case 'avis_24_heures_remise_auto' :
			$email=$kidonateur['email'];
			$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_avis_24_heures_remise_auto_sujet');
				
			$texte=array(
					$bonjour,
					_T('encheresmail:email_avis_24_heures_remise_auto_message',array('titre_article' => $artobjet['titre'],'id_objet' => $id_objet)),
					_T('encheresmail:email_avis_24_heures_remise_auto_message_active'),
					_T('encheresmail:email_avis_24_heures_remise_auto_message_caracteristiques'),				
					_T('encheresmail:email_avis_24_heures_remise_auto_message_expl'),
					_T('encheresmail:email_kidonateur_mercil'),					
					);
		
		$corps=mise_en_forme($texte,$kidonateur['spip_listes_format']);
		$message = $corps.$fin_message;		
		break;
		
	// mail de confirmation pour le kidonateur après la fin de l'enchère avec acheteur

	case  'enchere_gagnee_kidonateur' :
		$email = $kidonateur['email'];
		$url_projet=generer_url_public('rubrique','id_rubrique='.$artobjet['id_rubrique'],false);
		if($kidonateur['spip_listes_format']=='html'){
			$url_projet='<a href="'.$url_projet.'">'.$projet['titre'].'</a>';			
		}

		
		if ($objet['mode_livraison'] == 'venir' OR $objet['prix_livraison']=='0') {
		$message_specifique = '';}

		elseif ($objet['mode_livraison'] == 'livraison' OR $objet['mode_livraison'] == 'poste') $message_specifique = _T('encheresmail:email_kidonateur_enchere_gagnee_message_specifique_livraison');
			
		elseif ($objet['mode_livraison'] == 'posteouvenir') {
			$message_specifique =array(
				_T('encheresmail:email_kidonateur_enchere_gagnee_message_specifique_posteouvenir'),
				_T('encheresmail:email_kidonateur_enchere_gagnee_message_specifique_posteouvenir_chercher'),			
				);
		};

		$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_kidonateur_enchere_gagnee_sujet');
				
		$texte=array(
					$bonjour,
					_T('encheresmail:email_kidonateur_enchere_gagnee_objet_message',array('titre_article' => $artobjet['titre'], 'id_objet' => $id_objet,'montant_mise' => $objet['montant_mise'],'devise'=>$devise)),
					_T('encheresmail:email_kidonateur_enchere_gagnee_objet_verse',array('titre_rubrique' =>extraire_multi($projet['titre']),'nom_asso' =>extraire_multi($asso['nom']))),
					$message_specifique,
					_T('encheresmail:email_kidonateur_merci_soutien',array('titre_rubrique' =>extraire_multi($projet['titre']),'nom_asso' =>extraire_multi($asso['nom']),'url_projet'=>$url_projet))				
					);
		
		$corps=mise_en_forme($texte,$kidonateur['spip_listes_format']);
		$message = $corps.$fin_message;			
		break;


	// mail de confirmation pour le kidonateur de la vente après la fin de l'enchère sans acheteur

	case 'enchere_cloture_sansmise_kidonateur' :
		$email = $kidonateur['email'];
		$url_kidonateur= "/spip.php?page=auteur&id_auteur=".$id_auteur.'&remise_vente=oui&id_objet='.$id_objet;
		$url_kidonateur= $url_site.$url_kidonateur; 
		if($kidonateur['spip_listes_format']=='html')$url_kidonateur='<a href="'.$url_kidonateur.'">'._T('encheres:remise_en_vente').'</a>';
		$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_kidonateur_enchere_sansmise_sujet');
	
				
		$texte=array(
					$bonjour,
					_T('encheresmail:email_kidonateur_enchere_sansmise_objet_message',
						array(
							'titre_article' => $artobjet['titre'],
							'id_objet' => $id_objet,
							'titre_rubrique' => extraire_multi($projet['titre'])
							)
						),
					_T('encheresmail:email_kidonateur_enchere_sansmise_objet_message_remise'),
					$url_kidonateur,
					_T('encheresmail:email_kidonateur_enchere_sansmise_objet_message_changer'),	
					_T('encheresmail:email_kidonateur_enchere_sansmise_objet_message_merci')								
					);
		
		$corps=mise_en_forme($texte,$kidonateur['spip_listes_format']);
		$message = $corps.$fin_message;			

		break;


	// Avis au vendeur l'informant des rappels envoyés 
	case 'rappel_vendeur' :
		$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_rappel_vendeur_sujet');

		$email = $kidonateur['email'];	
		
		$texte=array(
					$bonjour,
					_T('encheresmail:email_rappel_vendeur_message',array('titre_article' => $artobjet['titre'], 'id_objet' => $id_objet,'titre_rubrique' => extraire_multi($projet['titre']),'date_vente'=>$date_vente)),
					_T('encheresmail:email_rappel_vendeur_message_envoye',array('nom_asso'=>extraire_multi($asso['nom']))),
					_T('encheresmail:email_rappel_vendeur_message_reception', array('nom_asso' =>extraire_multi($asso['nom']),'prenom_acheteur' => $acheteur['prenom'],'nom_famille_acheteur' => $acheteur['nom_famille'],'email_acheteur' => $acheteur['email'])),	
					_T('encheresmail:email_rappel_vendeur_merci_participation'),								
					);
		$corps=mise_en_forme($texte,$kidonateur['spip_listes_format']);
		$message = $corps.$fin_message;		
		
		break;


			
	// Email au vendeur si pas de paiement enregistré et possibilité de remetre en vente 
	case 'remise_en_vente_vendeur' :
		if ($kidonateur['langue']) lang_select($kidonateur['langue']);
		$url_kidonateur= "/spip.php?page=auteur&id_auteur=".$id_auteur.'&remise_vente=oui&id_objet='.$id_objet;
		$url_remise= $url_site.$url_kidonateur; 
		$url_projet=generer_url_public('rubrique','id_rubrique='.$artobjet['id_rubrique'],'false');
		if($kidonateur['spip_listes_format']=='html'){
			$url_remise='<a href="'.$url_remise.'">'._T('encheres:remise_en_vente').'</a>';
			$url_projet='<a href="'.$url_projet.'">'.$projet['titre'].'</a>';			
		}

		$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_remise_en_vente_vendeur_sujet');

		$email = $kidonateur['email'];	
		
		$texte=array(
					$bonjour,
					_T('encheresmail:email_remise_en_vente_vendeur_message',array('titre_article' => $artobjet['titre'], 'id_objet' => $id_objet,'nom_asso' =>extraire_multi($asso['nom']),'prenom_acheteur' => $acheteur['prenom'],'nom_famille_acheteur' => $acheteur['nom_famille'])),
					_T('encheresmail:email_remise_en_vente_vendeur_message_depasse'),
					'ul'=>array(
						_T('encheresmail:email_remise_en_vente_vendeur_message_remise', array('url_remise' => $url_remise)),
						),
					_T('encheresmail:email_kidonateur_merci_soutien',array('titre_rubrique' =>extraire_multi($projet['titre']),'nom_asso' =>extraire_multi($asso['nom']),'url_projet'=>$url_projet))						
					);
		
		$corps=mise_en_forme($texte,$kidonateur['spip_listes_format']);
		$message = $corps.$fin_message;	
		
		break;
				

						
	// Avis au vendeur de la réception du paiement
	case 'paiement_ok_kidonateur' :
	
		if ($kidonateur['langue']) lang_select($kidonateur['langue']);
		$url_kido=generer_url_public('auteur',"id_auteur=$id_auteur",'false');
		$url_projet=generer_url_public('rubrique','id_rubrique='.$artobjet['id_rubrique'],false);
		if($kidonateur['spip_listes_format']=='html'){
			$url_kido='<a href="'.$url_kido.'">'._T('encheresmail:mon_kidonaki').'</a>';
			$url_projet='<a href="'.$url_projet.'">'.extraire_multi($projet['titre']).'</a>';			
		}	
		else $url_kidonateur=_T('encheresmail:mon_kidonaki').' ('.$url_kidonateur.')';

		if ($objet['mode_livraison'] == 'email') {$message_specifique = _T('encheresmail:email_paiement_ok_kidonateur_message_specifique_email');}

		elseif ($objet['mode_livraison'] == 'venir' OR $objet['prix_livraison']=='0') {$message_specifique = _T('encheresmail:email_paiement_ok_kidonateur_message_specifique_venir');}

		elseif ($objet['mode_livraison'] == 'livraison' OR $objet['mode_livraison'] == 'poste') { $message_specifique = _T('encheresmail:email_paiement_ok_kidonateur_message_specifique_livraison');}

		elseif ($objet['mode_livraison'] == 'posteouvenir') {$message_specifique = _T('encheresmail:email_paiement_ok_kidonateur_message_specifique_posteouvenir');};

		$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_paiement_ok_kidonateur_sujet');

		$email = $kidonateur['email'];	
		
		$texte=array(
					$bonjour,
					_T('encheresmail:email_paiement_ok_kidonateur_message',array('titre_article' => $artobjet['titre'], 'id_objet' => $id_objet,'nom_asso' =>extraire_multi($asso['nom']))),
					_T('encheresmail:email_paiement_ok_kidonateur_message_frais'),
					$message_specifique,
					_T('encheresmail:email_paiement_ok_kidonateur_message_coordonnes',array(
						'prenom_acheteur' => $acheteur['prenom'],
						'nom_famille_acheteur' => $acheteur['nom_famille'],
						'email_acheteur' => $acheteur['email']
						)),
					_T('encheresmail:email_paiement_ok_kidonateur_message_delivre',array('url_kido' =>$url_kido)),					
					_T('encheresmail:email_kidonateur_merci_soutien',array('titre_rubrique' =>extraire_multi($projet['titre']),'nom_asso' =>extraire_multi($asso['nom']),'url_projet'=>$url_projet))						
					);
		
		$corps=mise_en_forme($texte,$kidonateur['spip_listes_format']);
		$message = $corps.$fin_message;	
		break;


			
	// Rappel aux vendeur si objet pas livé 5 jours après réception du paiement
	case 'rappel_vendeur_livraison' :
		if ($kidonateur['langue']) lang_select($kidonateur['langue']);
		$email = $kidonateur['email'];
		$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_kidonateur_rappel_vendeur_sujet');

		$texte=array(
					$bonjour,
					_T('encheresmail:email_kidonateur_rappel_vendeur_message',
						array(
							'titre_article' => $artobjet['titre'], 
							'id_objet' => $id_objet,
							'nom_asso' =>extraire_multi($asso['nom']),
							'titre_rubrique'=>extraire_multi($projet['titre'])
							)
						),
					_T('encheresmail:email_paiement_ok_kidonateur_message_frais'),
					$message_specifique,
					_T('encheresmail:email_paiement_ok_kidonateur_message_coordonnes',array(
						'prenom_acheteur' => $acheteur['prenom'],
						'nom_famille_acheteur' => $acheteur['nom_famille'],
						'email_acheteur' => $acheteur['email']
						)),
					_T('encheresmail:email_paiement_ok_kidonateur_message_delivre',array('url_kido' =>$url_kido)),					
					_T('encheresmail:email_kidonateur_merci_soutien',array('titre_rubrique' =>extraire_multi($projet['titre']),'nom_asso' =>extraire_multi($asso['nom']),'url_projet'=>$url_projet))						
					);
		
		$corps=mise_en_forme($texte,$kidonateur['spip_listes_format']);
		$message = $corps.$fin_message;			
		break;
		

	// Envoi mail au kidonateur, quand le paiement des frais de transport a été enregistré
	case 'paiement_livraison_ok_vendeur' :
		$email=$kidonateur['email'];
		$url_projet=generer_url_public('rubrique','id_rubrique='.$artobjet['id_rubrique'],false);
		if($kidonateur['spip_listes_format']=='html'){$url_projet='<a href="'.$url_projet.'">'.$url_projet.'</a>';}		
			
		$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_paiement_livraison_ok_sujet');
	
		$texte=array(
					$bonjour,
					_T('encheresmail:email_vendeur_paiement_livraison_ok_message',array('titre_article' => $artobjet['titre'], 'id_objet' => $id_objet,'nom_famille_acheteur' => $acheteur['nom_famille'],'prenom_acheteur' => $acheteur['prenom'])),
					_T('encheresmail:email_vendeur_paiement_livraison_ok_message_delivre',array('email_acheteur' => $acheteur['email'])),				
					_T('encheresmail:email_kidonateur_merci_soutien',array('titre_rubrique' =>extraire_multi($projet['titre']),'nom_asso' =>extraire_multi($asso['nom']),'url_projet'=>$url_projet))						
					);
		
		$corps=mise_en_forme($texte,$kidonateur['spip_listes_format']);
		$message = $corps.$fin_message;					
				
		break;

	// Envoi mail au kidonateur, quand le la réception de l'objet a été enregistré
	case 'objet_recu_kidonateur' :
		$email=$kidonateur['email'];
		$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_objet_recu_kidonateur_sujet');
	
	
		$texte=array(
					$bonjour,
					_T('encheresmail:email_objet_recu_kidonateur_message',array('titre_article' => $artobjet['titre'], 'id_objet' => $id_objet,'nom_famille_acheteur' => $acheteur['nom_famille'],'prenom_acheteur' => $acheteur['prenom'])),
					_T('encheresmail:email_objet_recu_kidonateur_message_soutien',
						array(
							'titre_rubrique' =>extraire_multi($projet['titre']),
							'montant_mise' =>$objet['montant_mise'],
							'devise'=>$devise,
							'nom_asso' =>extraire_multi($asso['nom']))
						),				
					_T('encheresmail:email_objet_recu_kidonateur_message_ev'),
					_T('encheresmail:email_objet_recu_kidonateur_message_merci'),											
					);
		
		$corps=mise_en_forme($texte,$kidonateur['spip_listes_format']);
		$message = $corps.$fin_message;				
					
		break;	
	// Envoi mail au kidonateur quand un objet vente à problemes a été libéré par un webmaster
	
	case 'vente_probleme_traite' :
		$url_kidonateur= "/spip.php?page=auteur&id_auteur=".$id_auteur.'&menu=objets_stand_by';
		$url_remise= $url_site.$url_kidonateur; 
		
		if($kidonateur['spip_listes_format']=='html'){
			$url_remise='<a href="'.$url_remise.'">'.$url_remise.'</a>';		
		}

		
		$email=$kidonateur['email'];
		$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_vente_probleme_traite_kidonateur_sujet');
	
	
		$texte=array(
					$bonjour,
					_T('encheresmail:vente_probleme_traite',array('titre_article' => $artobjet['titre'], 'id_objet' => $id_objet)),
					_T('encheresmail:email_vente_probleme_traite_kidonateur_gerer'),
					$url_remise,
					);
		
		$corps=mise_en_forme($texte,$kidonateur['spip_listes_format']);
		$message = $corps.$fin_message;				
					
		break;			
	}	
				

			// Partie générale, envoi des mails
			
	$email=	$kidonateur['email'];	

	if (envoyer_mail($email,$sujet,$entete.$message.$pied,$from,$header))

		return spip_log("Email visiteur $email\n$sujet\n$message\n",'encheres_emails_kidonateur');
	else
		return spip_log("Échec envoi email visiteur $email\n$sujet\n$message\n$type\n$header",'encheres_emails_kidonateur');
}
?>