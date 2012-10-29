<?php

//fonction qui crée les sujets et textes les différents emails aux visiteurs/kidonateurs et assos et prépare leur envoi

	if (!defined("_ECRIRE_INC_VERSION")) return;

function inc_envoyer_message_asso_dist($email='',$type,$id_objet="",$contexte='') {

   	include_spip('inc/mail');
	include_spip('inc/encheresmail_fonctions');	
	include_spip('inc/filtres');
	include_spip('encheres_fonctions');		
	
	// On récupère les données du conexte
		   
	if(is_array($contexte)){			
		foreach($contexte as $key=>$item){
			$$key=$item;
			}
		} 	
	

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
		spip_log("action:asso - requete:objet - type:$type",'mails_requetes_generes');
		}

	$id_article = $objet['id_article'];
	$id_auteur = $objet['id_auteur'];
	
	// le kidonateur
	
	if(!$kidonateur){
		if($email)$kidonateur = requete_auteurs_elargis(array('email='.sql_quote($email)));
		elseif($id_auteur)$kidonateur = requete_auteurs_elargis(array('id_auteur='.sql_quote($id_auteur)));
		spip_log("action:asso - requete:kidonateur - type:$type",'mails_requetes_generes');
		}
	
	$id_auteur = $kidonateur['id_auteur'];
	
		// article objet
	
	if(!$artobjet){		
		$artobjet = requete_articles(array('id_article='.sql_quote($id_article)));
		spip_log("action:asso - requete:artobjet - type:$type",'mails_requetes_generes');		
		}	
				



	// les infos projets
													
	if(!$projet){													
		$projet = requete_rubriques(array('id_rubrique='.sql_quote($artobjet['id_rubrique'])));
		spip_log("action:asso - requete:projet - type:$type",'mails_requetes_generes');				
		}			

	
	if(!$asso){		
		$asso = requete_auteurs_elargis(array('id_auteur='.sql_quote($projet['id_auteur'])));
		spip_log("action:kidonateur - requete:asso - type:$type",'mails_requetes_generes');		
		}
	

	
	$adresse_asso = extraire_multi($asso['adresse']).', '.$asso['code_postal'].' '.extraire_multi($asso['ville']);
	if($projet['compte_bancaire']){$compte_bancaire_asso=$projet['compte_bancaire'];}
	if($projet['communication_virement']){$communication_virement_asso=$projet['communication_virement'];}
	if(!$communication_virement_asso){$communication_virement_asso='kidonaki';}

	// On détérmine la bonne langue			
	if ($acheteur['langue']) lang_select($acheteur['langue']);	

	$bonjour =_T('bonjour').' '. extraire_multi($asso['prenom']).' '. extraire_multi($asso['nom_famille']);
	$signature = _T('encheresmail:email_signature');
	$slogan =  _T('encheresmail:email_slogan');
	$message_auto =_T('encheresmail:message_auto');
	$fin_message = mise_en_forme(array($signature,$slogan),$asso['spip_listes_format']);
	
	if($asso['spip_listes_format']=='html') {
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

	// mail de confirmation pour l'asociation bénéficiaire de la vente après la fin de l'enchère

	case 'enchere_gagnee_asso' :
		$url_kidonateur= generer_url_public("auteur",'id_auteur='.$asso['id_auteur']);
		$url_kidonateur= str_replace('&amp;','&',$url_kidonateur); 
		if($asso['spip_listes_format']=='html')$url_kidonateur='<a href="'.$url_kidonateur.'">'._T('encheresmail:mon_kidonaki').'</a>';
		else $url_kidonateur=_T('encheresmail:mon_kidonaki').' ('.$url_kidonateur.')';
		
		$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_asso_enchere_gagne_sujet');
					
		$texte=array(
				$bonjour,
				_T('encheresmail:email_asso_enchere_gagne_objet_message',
					array(
						'titre_article' => $artobjet['titre'],
						'id_objet' => $id_objet,
						'montant_mise' => $objet['montant_mise'],
						'devise' => $devise,						
						'titre_rubrique' =>extraire_multi($projet['titre'])
						)
					),
				_T('encheresmail:email_asso_enchere_gagne_objet_message_surveiller',
					array(
						'titre_article' => $artobjet['titre'],
						'id_objet' => $id_objet,					
						'compte_bancaire_asso' => $compte_bancaire_asso,
						'communication_virement' => $communication_virement_asso,
						'url_kidonateur' => $url_kidonateur
						)
					),
				_T('encheresmail:email_asso_enchere_gagne_objet_message_important'),
				_T('encheresmail:email_asso_enchere_gagne_objet_message_merci'),
				);
			$corps=mise_en_forme($texte,$asso['spip_listes_format']);
			$message = $corps.$fin_message;	
			

		break;


	// Avis à l'association, vérification paiement

	case 'rappel_asso' :
		$sujet = "[".$nom_site_spip."] - ".$artobjet['titre']."(".$id_objet.") : "._T('encheresmail:email_rappel_asso_sujet');

		$texte=array(
				$bonjour,
				_T('encheresmail:email_rappel_asso_message',
					array(
						'titre_article' => $artobjet['titre'],
						'id_objet' => $id_objet,
						'prenom_acheteur' => $prenom,
						'nom_famille_acheteur' => $nom_famille,
						'titre_rubrique' =>extraire_multi($projet['titre']),
						'date_vente' => $date_vente,
						'compte_bancaire_asso' => $compte_bancaire_asso,						
						)
					),
				_T('encheresmail:email_rappel_asso_message_valider'),
				_T('encheresmail:email_asso_enchere_gagne_objet_message_merci'),
				);
			$corps=mise_en_forme($texte,$asso['spip_listes_format']);
			$message = $corps.$fin_message;			
				
		break;				
			}
						
	$email=$asso['email'];
	

	if (envoyer_mail($email,$sujet,$entete.$message.$pied,$from,$header))

		return spip_log("Email visiteur $email\n$sujet\n$message\n",'encheres_emails_asso');
	else
		return spip_log("Échec envoi email visiteur $email\n$sujet\n$message\n$type\n$header",'encheres_emails_asso');
}
?>