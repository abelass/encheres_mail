<?php


function inc_envoyer_message_webmestre_dist($type,$id_objet='',$option2='') {
    include_spip('inc/mail');
    	include_spip('inc/encheresmail_fonctions');	
	include_spip('inc/filtres');	   
	
	// On récupère les données nécessaires à envoyer le mail de validation
	// La fonction envoyer_mail se chargera de nettoyer cela plus tard
	$nom_site_spip = $GLOBALS['meta']["nom_site"];
	$email = $GLOBALS['meta']["email_webmaster"]; 

	$sql = spip_query( "SELECT * FROM spip_auteurs WHERE id_auteur='$option2'");
		while($data = spip_fetch_array($sql)) {
		$nom =$data['nom'];
		}
		


	$sql = spip_query( "SELECT * FROM spip_encheres_objets WHERE id_objet='$id_objet'");
		while($data = spip_fetch_array($sql)) {
		$id_article =$data['id_article'];
		$envoi_rappels =$data['envoi_rappels'];
		$id_acheteur =$data['id_acheteur'];
		
		$sql3 = spip_query( "SELECT * FROM spip_auteurs WHERE id_auteur='$id_acheteur'");
		while($data = spip_fetch_array($sql3)) {
		$nom_gagnant =$data['nom'];
		}
		
		$sql2 = spip_query( "SELECT * FROM spip_articles WHERE id_article='$id_article'");
			while($date = spip_fetch_array($sql2)) {
			$texte =$date['texte'];
			$titre =$date['titre'];
			}
		}
		
		switch ($type){

			//email envoye lors de l'inscription

			case 'inscription2' :
			$url_objet= generer_url_public("auteur","id_auteur=$option2");
			$url_objet= str_replace('&amp;','&',$url_objet); 
			$message = "Bonjour, \n\n"
.			$nom." vient de s'inscrire sur le site \n\n Voir son profil: ".$url_objet."\n\n L'équipe de Kidonaki";
			$sujet = '['.$nom_site_spip.'] - Inscription sur le site! ';
			break;

			//email envoye lors de la mise en vente d'un objet

			case 'mettre_en_vente' :
			$url_objet= generer_url_public("article","id_article=$id_article&id_objet=$id_objet");
			$url_objet= str_replace('&amp;','&',$url_objet); 
			$message = "Bonjour, \n\n"
.			$nom." vient de mettre en vente un objet \n\n".$titre." : ".$texte."\n\n Voir l'objet: ".$url_objet."\n\n L'équipe de Kidonaki";
			$sujet = '['.$nom_site_spip.'] - Mise en vente d\'objet ! ';
			break;
				
				
				
			//email envoye lors d'une mise effectué
			case 'mise' :
			$url_objet= generer_url_public("article","id_article=$id_article&id_objet=$id_objet");
			$url_objet= str_replace('&amp;','&',$url_objet); 
			$var_url = '&id_objet='.$id_objet;
			$message = "Bonjour, \n\n".$nom." vient d'enchérir sur l'objet:".$titre." : ".$texte.".\n\n Voir l'état actuel de l'objet en question: ".$url_objet.$var_url."\n\n L'équipe de Kidonaki";
			$sujet = '['.$nom_site_spip.'] - Enchère éfectué ! ';
			break;
			
			//email envoye lors de la fin d'une enchère
			case 'enchere_gagnee' :
			$url_objet= generer_url_public("article","id_article=$id_article&id_objet=$id_objet");
			$url_objet= str_replace('&amp;','&',$url_objet); 
			$var_url = '&id_objet='.$id_objet;
			$message = "Bonjour, \n\n".$nom_gagnant." vient de gagner une enchère. Voir l'objet en question: ".$url_objet."\n\n L'équipe de Kidonaki";
			$sujet = "[".$nom_site_spip."]". $titre. "(".$id_objet.") - Enchère gagnée ! ";
			break;


			//email envoye a partir du deuxième rappel
			case 'rappel_acheteur' :
			$url_objet= generer_url_public("article","id_article=$id_article");
			$url_objet= str_replace('&amp;','&',$url_objet); 
			$var_url = '&id_objet='.$id_objet;
			$message = "Bonjour, \n\n ".$envoi_rappels." jours après sa vente, le paiement pour l'objet :".$titre." (".$id_objet.") n'as pas encore été enregistré et des rappels ont été envoyés".$url_objet."\n\n L'équipe de Kidonaki";
			$sujet = "[".$nom_site_spip."] - Envoi des rappels après ".$envoi_rappels." jours! ";
			break;

			//email quand le paiement de l'objet est enregistré
			case 'paiement_ok' :
			$url_objet= generer_url_public("article","id_article=$id_article&id_objet=$id_objet");
			$url_objet= str_replace('&amp;','&',$url_objet); 
			$var_url = '&id_objet='.$id_objet;
			$message = "Bonjour, \n\n le paiment pour l'objet".$titre." (".$id_objet.") a été enregistré,\n\n L'équipe de Kidonaki";
			$sujet = "[".$nom_site_spip."] - Paiement objet effectué!";
			break;
				
			//email quand quand l'objet n'est pas livré 5 jours après paiement
			case 'rappel_vendeur' :
			$url_objet= generer_url_public("article","id_article=$id_article&id_objet=$id_objet");
			$url_objet= str_replace('&amp;','&',$url_objet); 
			$var_url = '&id_objet='.$id_objet;
			$message = "Bonjour, \n\n 5 jours après le paiment pour la livraison de l'objet".$titre." (".$id_objet.") celui ci n'a toujours pas été livré. Un rappel a été envoyé au vendeur,\n\n L'équipe de Kidonaki";
			$sujet = "[".$nom_site_spip."] - Rappel livraison objet envoyé!";
			break;
			
			//email quand quand l'objet n'est pas livré 5 jours après paiement
			case 'vente_probleme' :
			$message = "Bonjour, \n\n 180 jours après le paiment de l'objet".$titre." (".$id_objet.") celui ci n'a toujours pas été payé. Le kidoànateur vient de supprimer cet objet qui se trouve maintenant dans votre liste de vente à problème. Veuillez s'en charger.\n\n L'équipe de Kidonaki";
			$sujet = "[".$nom_site_spip."] - Vente à problème!";
			break;			
				
			}	

	if (envoyer_mail($email,$sujet,$entete.$message.$pied,$from,$header))

		return spip_log("Email webmester $email\n$sujet\n$message\n",'encheres_emails_webmester');
	else
		return spip_log("Échec envoi email webmester $email\n$sujet\n$message\n$type\n$header",'encheres_emails_webmester');
}
?>