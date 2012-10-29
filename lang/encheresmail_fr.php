<?php

// This is a SPIP language file  --  Ceci est un fichier langue de SPIP nommé  genere le NOW()
// langue / language = fr

$GLOBALS[$GLOBALS['idx_lang']] = array(


// C
'communication' => 'Communication :',
'compte' => 'Compte :',


// E
'email_acheteur_objet_supprime_message' => 'La vente de cet objet a été annulée par le vendeur. Si vous souhaitez en savoir plus, n’hésitez pas à le contacter.',
'email_acheteur_objet_supprime_sujet' => 'Objet supprimé',
'email_acheteur_paiement_livraison_ok_message' => 'Par ce courriel, nous vous confirmons que  votre vendeur (kidonateur) a bien reçu le paiement des frais de transport pour l’objet « @titre_article@ (@id_objet@) » acheté sur Kidonaki  le @date_vente@. ',
'email_acheteur_paiement_livraison_ok_message_adresse' => 'N’oubliez pas d’indiquer votre adresse (postale) de livraison au vendeur (kidonateur). ',
'email_acheteur_paiement_livraison_ok_message_recevoir' => 'Vous devriez recevoir cet objet très prochainement',
'email_asso_enchere_gagne_objet_message' => 'Bonne nouvelle ! L’objet « @titre_article@ (@id_objet@) » a été vendu au profit de votre projet « @titre_rubrique@ », pour un montant de « @montant_mise@ »€. ',
'email_asso_enchere_gagne_objet_message_important' => 'Il est très important d’effectuer un suivi régulier et rapide des payements afin de ne pas perturber la transaction entre le vendeur (kidonateur) et l’acheteur. Cette condition est nécessaire pour les encourager à vous soutenir.',
'email_asso_enchere_gagne_objet_message_merci' => 'Nous vous remercions pour votre participation.',
'email_asso_enchere_gagne_objet_message_surveiller' => 'Nous vous demandons de surveiller votre compte @compte_bancaire_asso@ (@communication_virement@ - @titre_article@ - @id_objet@) et de mentionner dans votre interface « Mon Kidonaki » (@url_kidonateur@) que le payement a été effectué( dès que c’est le cas).',
'email_asso_enchere_gagne_sujet' => 'Objet vendu à votre profit : paiement à surveiller',
'email_avis_24_heures_remise_auto_message' => 'Votre objet « @titre_article@ (@id_objet@) » n\'a pour le moment aucune enchère et la période de vente se termine dans 24h.',
'email_avis_24_heures_remise_auto_message_active' => 'Vous avez activé pour cet objet la fonction \"remise en vente automatique\". Si vous ne modifiez pas ce paramètre, dans votre espace personnel \"Mon Kidonaki\", votre objet sera remis en vente par le système, s\'il n\'a pas trouvé d\'acquéreur dans 24 heures.',
'email_avis_24_heures_remise_auto_message_caracteristiques' => 'Le système va conserver les caractéristiques de vente (durée, prix, projet soutenu, prix et mode de livraison, etc.). Assurez-vous donc que vous  possédez toujours l\'objet dans l\'état initial de la vente.',
'email_avis_24_heures_remise_auto_message_expl' => 'Le système remise en vente automatique vous permet ainsi de laisser des objets sur le site jusqu\'à ce qu\'il trouve un acquéreur. Désactivez cette fonction lorsque vous souhaitez retirer l\'objet du site. A la fin de la période actuelle de ventes, celui-ci ne sera donc plus disponible à l\'achat et sera repris dans la catégories \"objets invendus\".',
'email_avis_24_heures_remise_auto_sujet' => 'Remise en vente automatique dans 24 heures',
'email_courrier_velo' => 'Vous désirez être livré chez vous ? Utilisez la bicyclette de Dioxyde de Gambette ! Le Kidonateur qui vend cet objet habite Bruxelles et vous suggère d’utiliser ce moyen de livraison écologique. Dans ce cas, l’acheteur paye les frais de livraison (livraison standard : 5€) directement au livreur.',
'email_courrier_velo_contacter' => 'Le plus simple est donc de transmettre votre adresse et vos disponibilités pour la livraison au vendeur qui prendra contact avec le livreur cycliste.',
'email_courrier_velo_savoir_plus' => 'En savoir plus (@url_article@)',
'email_echeance_enchere' => 'L\'enchère sera cloturée le @date_fin@. ',
'email_enchere_gagnee_message_obtenir' => 'Pour obtenir cet objet :',
'email_enchere_gagnee_message_paypal_asso' => 'L\'association vous propose également, si vous le désirez, d\' effectuer le paiement sur son compte Paypal : @url_paiement_objet@',
'email_enchere_gagnee_message_paypal_kidonateur' => 'Le Kidonateur vous propose également, si vous le désirez, de régler ces frais via paypal : @url_paiement_frais@',
'email_enchere_gagnee_message_specifique_email' => '- Payer le montant de @montant_mise@ € sur le compte @compte_bancaire_asso@ de @nom_asso@  - Adresse : @adresse_asso@. N’oubliez pas de mentionner « @communication_virement@ - @titre_article@ - @id_objet@ » en communication.

Votre objet acheté est lié à un événement dont la durée est limitée dans le temps. Nous vous invitons à faire le virement (payement) sur le compte de l\'association au plus vite, afin de profiter d\'un maximum de jours de validité.

Rappel: la période de validité pour votre achat: du @date_debut@ au @date_fin@',
'email_enchere_gagnee_message_specifique_enlevement' => 'Dès qu’elle aura reçu le paiement, l\'association « @nom_asso@ » avertira le Kidonateur (vendeur) pour lui dire de se mettre en contact avec vous afin de régler les détails concernant l\'enlèvement de l\'objet.',
'email_enchere_gagnee_message_specifique_frais_transport' => ' Payer les frais de transport :',
'email_enchere_gagnee_message_specifique_frais_transport_posteouvenir' => 'Payer les frais de transport (dans le cas où vous ne souhaitez pas enlever l’objet chez le Kidonateur) qui s’élèvent à @prix_transport@ € sur le compte @compte_bancaire_kidonateur@ du kidonateur @nom_kidonateur@.  N’oubliez pas de préciser  «  transport: @id_objet@ » (numéro de l’objet) en communication.@message_paypal_kidonateur@ ',
'email_enchere_gagnee_message_specifique_livraison' => 'Dès qu’elle aura reçu le paiement, @nom_asso@ avertira le Kidonateur pour lui dire qu’il peut vous délivrer l’objet.',
'email_enchere_gagnee_message_specifique_payer_objet' => 'Vous devez à présent payer votre achat. Voici les données de paiement :',
'email_enchere_gagnee_objet_attention' => 'ATTENTION, ce mail n’est pas un bon d’achat.',
'email_enchere_gagnee_objet_message' => 'Félicitations ! Vous avez remporté l\'enchère pour « @titre_article@ (@id_objet@) ».',
'email_enchere_gagnee_objet_obtenir' => 'Pour obtenir cet objet, vous devez à présent : ',
'email_enchere_gagnee_objet_rien_certifie' => 'A ce stade, rien ne certifie que le virement a été effectué au profit de l’association. ',
'email_enchere_gagnee_sujet' => 'Vente clôturée : objet remporté !',
'email_enchere_perdu_objet_message' => 'Malheureusement vous n’avez pas remporté l’enchère pour l’objet « @titre_article@ (@id_objet@) ».',
'email_enchere_perdu_objet_message_similaires' => 'N’hésitez pas à visiter notre site et afficher les objets similaires : @url_recherche@.',
'email_enchere_perdu_sujet' => 'Objet non-remporté',
'email_encherisseur_enchere_reussi_objet_message' => 'Votre enchère pour « @titre_article@ (@id_objet@) » a bien été enregistrée et vous êtes actuellement le meilleur enchérisseur.',
'email_encherisseur_enchere_reussi_sujet' => 'Enchère réussie',
'email_encherisseur_merci_achat' => 'Nous vous remercions de faire vos achats sur le site Kidonaki.',
'email_encherisseur_soutien_projet' => 'Grâce à cet achat, vous soutenez le projet « @titre_rubrique@ » mené par « @nom_asso@ ».',
'email_encherisseur_surpasse_encherir' => 'Vous pouvez enchérir sur cet objet dès maintenant: @url_enchere@',
'email_encherisseur_surpasse_objet_message' => 'Quelqu’un a surenchéri sur l’objet « @titre_article@ (@id_objet@) »  et vous n’êtes actuellement plus le meilleur enchérisseur.',
'email_intro_billetterie_html' => 'Numéro de référence de votre achat sur Kidonaki: Numéro @id_objet@',
'email_kidonateur_enchere_effectue' => 'Une enchère a été effectué sur votre  objet « @titre_article@ (@id_objet@) » ',
'email_kidonateur_enchere_effectue_sujet' => 'Enchère effectuée',
'email_kidonateur_enchere_gagnee_message_specifique_livraison' => 'L’acheteur a également reçu les instructions pour le payement des frais de transport sur votre compte.',
'email_kidonateur_enchere_gagnee_message_specifique_posteouvenir' => 'L’acheteur a également reçu les instructions pour le payement des frais de transport sur votre compte. ',
'email_kidonateur_enchere_gagnee_message_specifique_posteouvenir_chercher' => 'S’il désire venir chercher l’objet, il prendra  contact avec vous par courriel.',
'email_kidonateur_enchere_gagnee_message_specifique_venir' => 'Vous pourrez prendre contact avec l’acheteur par courriel pour organiser l’enlèvement de l’objet. Voici les coordonnées mail de l’acheteur @prenom@  @nom_famille@ pour tout souci ou remarque : @email@',
'email_kidonateur_enchere_gagnee_objet_message' => 'Félicitations, votre objet « @titre_article@ (@id_objet@) » a été vendu pour un montant de @montant_mise@ € !',
'email_kidonateur_enchere_gagnee_objet_verse' => 'Ce montant sera versé par l’acheteur à l’association @nom_asso@ pour le projet @titre_rubrique@',
'email_kidonateur_enchere_gagnee_sujet' => 'Vente clôturée : Votre objet est vendu !',
'email_kidonateur_enchere_sansmise_objet_message' => 'Votre objet « @titre_article@ (@id_objet@) », que vous vendez au profit du projet @titre_rubrique@, n’a pas trouvé d’acquéreur. ',
'email_kidonateur_enchere_sansmise_objet_message_changer' => 'Vous pouvez bien entendu changer les caractéristiques de la vente, et par exemple baisser le prix. Mais ne bradez pas vos objets ! Ce n’est pas parce qu’ils sont vendus au profit d’une association ou d’une cause qu’ils ne doivent pas être vendus  au prix « du marché ».
Votre objet fera certainement  le bonheur d’un acheteur lors de la prochaine session d’enchères. ',
'email_kidonateur_enchere_sansmise_objet_message_merci' => 'Nous vous remercions pour votre collaboration.',
'email_kidonateur_enchere_sansmise_objet_message_remise' => 'Nous vous invitons à le remettre en vente gratuitement, en deux clics, via le lien ci-dessous.',
'email_kidonateur_enchere_sansmise_sujet' => 'Objet invendu : remettez en vente gratuitement',
'email_kidonateur_encherisseur_surpasse_sujet' => 'Enchère surpassée',
'email_kidonateur_merci_soutien' => 'Kidonaki et « @nom_asso@ » vous remercient  d’avoir soutenu le projet @titre_rubrique@. N\'hésitez pas à vous rendre sur la page du projet que vous avez soutenu (@url_projet@) pour poser des questions ou lire les éventuelles nouvelles du projet.',
'email_kidonateur_mercil' => 'Nous vous remercions de soutenir nos projets partenaires.',
'email_kidonateur_rappel_acheteur_recu_message' => 'Notre système a constaté que votre achat « @titre_article@ (@id_objet@) » a été déclaré comme livré par le Kidonateur @prenom_kidonateur@ @nom_kidonateur@. ',
'email_kidonateur_rappel_acheteur_recu_message_non_recu' => 'Si , par contre,  vous n’avez toujours pas reçu l’objet, nous vous invitons à prendre contact avec le vendeur (Kidonateur). 
Coordonnées mail du Kidonateur :  @email_kidonateur@',
'email_kidonateur_rappel_acheteur_recu_message_url' => 'Pour cette transaction, vous n’avez pas indiqué avoir reçu l’objet.  S’il s’agit d’un oubli de votre part, nous vous suggérons d’indiquer dans votre MON KIDONAKI (@url_kido@) que l’objet vous est parvenu, ce qui nous indique que la transaction a pu être menée avec succès jusqu’au bout.',
'email_kidonateur_rappel_acheteur_recu_sujet' => 'Objet non-reçu ?',
'email_kidonateur_rappel_vendeur_message' => 'Notre système Kidonaki a constaté que vous aviez vendu l’objet « @titre_article@ (@id_objet@) » au profit du projet « @titre_rubrique@ ». L’association @nom_asso@ a confirmé avoir bien reçu le paiement de la part de l’acheteur @nom_acheteur@.',
'email_kidonateur_rappel_vendeur_message_informer' => 'Dans tous les cas, merci de tenir au courant l’acheteur en le contactant par email afin de le rassurer concernant ce retard.',
'email_kidonateur_rappel_vendeur_message_souci' => 'Avez-vous un souci pour la livraison de l’objet ? Peut-être votre objet a-t-il été malgré tout envoyé au moment où ce mail de rappel vous parvient.',
'email_kidonateur_rappel_vendeur_sujet' => 'Votre objet est en attente de livraison',
'email_mise_vente_objet_message' => 'Nous vous confirmons que votre objet « @titre_article@ (@id_objet@) » a été correctement mis en vente pour une période de @duree_mise@ jours, au profit du projet « @titre_rubrique@ »',
'email_mise_vente_objet_message_email_cloture' => 'Vous recevrez un mail lors de la clôture de l’enchère.',
'email_mise_vente_objet_message_remise' => 'Si cet objet n’a pas trouvé d’acquéreur dans période choisie, vous pourrez cliquer sur «remettre en vente», sans aucun frais bien entendu.',
'email_mise_vente_objet_message_soutien_projet' => '@nom_asso@ et Kidonaki vous remercient chaleureusement pour votre soutien.',
'email_mise_vente_objet_sujet' => 'Mise en vente confirmée',
'email_objet_recu_kidonateur_message' => 'L’acheteur @prenom_acheteur@ @nom_famille_acheteur@ a confirmé avoir bien reçu l’objet « @titre_article@ (@id_objet@) ».',
'email_objet_recu_kidonateur_message_ev' => 'Nous vous invitons à présent, si ce n’est pas encore fait, à laisser une évaluation pour cette transaction.',
'email_objet_recu_kidonateur_message_merci' => 'Nous vous remercions pour votre collaboration et nous espérons que vous continuerez à soutenir des projets via Kidonaki.  N’hésitez pas  à également  utiliser le site pour effectuer vos achats ! ',
'email_objet_recu_kidonateur_message_soutien' => 'Grâce à cette vente,  vous avez soutenu le projet @titre_rubrique@ mené par  @nom_asso@ qui a donc reçu un don de @montant_mise@ €. ',
'email_objet_recu_kidonateur_sujet' => 'Objet reçu par votre acheteur',
'email_paiement_livraison_ok_sujet' => 'Réception paiement pour Frais de Transports',
'email_paiement_ok_acheteur_message' => 'Votre virement sur le compte de l’association « @nom_asso@ » pour l’objet « @titre_article@ (@id_objet@) » a bien été validé.',
'email_paiement_ok_acheteur_message_html' => '<p class=\"style11\">Votre virement sur le compte de l’association « @nom_asso@ » pour l’objet « @titre_article@ (@id_objet@) » a bien été validé. 
</p>
@message_specifique@',
'email_paiement_ok_acheteur_message_specifique_contact' => 'Prendre contact avec le Kidonateur « @prenom_kidonateur@  @nom_famille_kidonateur@ » pour organiser l’enlèvement de l’objet.',
'email_paiement_ok_acheteur_message_specifique_coordonnes_kido' => 'Coordonnées mail du Kidonateur : @email_kidonateur@.',
'email_paiement_ok_acheteur_message_specifique_email' => 'Ce mail fait office de confirmation de la réception de votre paiement et donc valide votre achat. 

Rappel des conditions émises par l\'organisme vendeur: \"@commentaire@\" 
',
'email_paiement_ok_acheteur_message_specifique_email_html' => '<p class=\"style11\">
Ce mail fait office de confirmation de la réception de votre paiement et donc valide votre achat. 
</p>

<p class=\"style11\">
Rappel des conditions émises par l\'organisme vendeur: 
</p>
<p class=\"style11\">
\"@commentaire@\" 
</p>
<p class=\"style2\"><span class=\"style7\">Nom du vendeur: @nom_lieu@<br />
 Dates de validité: @validite@</span><br />
 </p>',
'email_paiement_ok_acheteur_sujet' => 'Votre paiement validé',
'email_paiement_ok_kidonateur_message' => 'L\'association « @nom_asso@ » confirme avoir reçu le payement pour l\'objet « @titre_article@ (@id_objet@) ». ',
'email_paiement_ok_kidonateur_message_coordonnes' => 'Coordonnées de l\'acheteur « @prenom_acheteur@ @nom_famille_acheteur@ » : @email_acheteur@',
'email_paiement_ok_kidonateur_message_delivre' => 'Dès que vous avez délivré l\'objet, n\'oubliez pas de le mentionner dans votre espace personnel « Mon Kidonaki »(@url_kido@), en cochant la case « Objet livré ». Nous vous invitons également à laisser un indice de satisfaction pour l\'acheteur. ',
'email_paiement_ok_kidonateur_message_frais' => 'Si vos frais de transport ont également été réglés ou s\'il n\'y en a pas, vous pouvez donc délivrer l\'objet à l\'acheteur.',
'email_paiement_ok_kidonateur_message_specifique_email' => 'Sauf contre-indication préalable (dans la description de l\'annonce) de votre part, l\'acheteur imprimera ce mail qui fera office de bon à valoir.',
'email_paiement_ok_kidonateur_message_specifique_livraison' => 'L’acheteur a également reçu les instructions pour le payement des frais de transport sur votre compte.  Si ceux-ci ne sont pas encore réglés, n’hésitez pas à prendre contact avec lui par email.',
'email_paiement_ok_kidonateur_message_specifique_posteouvenir' => 'L’acheteur a également reçu les instructions pour le payement des frais de transport sur votre compte. S’il désire venir chercher l’objet, il prendra  contact avec vous par courriel. ',
'email_paiement_ok_kidonateur_message_specifique_venir' => 'Vous pouvez prendre contact avec l’acheteur par courriel pour organiser l’enlèvement de l’objet.',
'email_paiement_ok_kidonateur_sujet' => 'Objet vendu payé',
'email_question_objet' => '@nom_question@ vous a posé une question au sujet de l\'objet @titre@

\"@texte@\"

Pour répondre à cette question, merci de visiter la page : @url@ 
et de cliquer sur \"répondre au message\" sous la question posée.

Vous aurez l\'occasion de publier ou non la question/réponse, selon votre choix.

Merci d\'avance 

L\'équipe de Kidonaki

ATTENTION: NE PAS REPONDRE A CE MAIL EN CLIQUANT SUR REPONDRE. (Merci d\'utiliser uniquement les questions/réponses sur le site) ',
'email_question_projet' => '@nom_question@ vous a posé une question au sujet du projet @titre@

\"@texte@\"

Pour répondre à cette question, merci de visiter la page : @url@ 
et de cliquer sur \"répondre au message\" sous la question posée.

Vous aurez l\'occasion de publier ou non la question/réponse, selon votre choix.

Merci d\'avance 

L\'équipe de Kidonaki

ATTENTION: NE PAS REPONDRE A CE MAIL EN CLIQUANT SUR REPONDRE. (Merci d\'utiliser uniquement les questions/réponses sur le site) ',
'email_rappel_2_acheteur_sujet' => 'Objet acheté en attente de payement (deuxième rappel)',
'email_rappel_3_acheteur_sujet' => 'Objet acheté en attente de payement (troisième rappel)',
'email_rappel_acheteur_fait_versement' => 'Si vous n’avez pas encore fait le versement, nous vous remercions de bien vouloir régulariser cette situation.',
'email_rappel_acheteur_message' => 'L’objet @titre_article@ (@id_objet@) que vous avez remporté le @date_vente@ n’aurait pas encore été payé.  Nous imaginons  qu’il s’agit d’un oubli de votre part ou que le payement vient d’être effectué et que l’association n’a pas encore eu le temps de le confirmer.',
'email_rappel_acheteur_sujet' => 'Objet acheté en attente de payement (rappel)',
'email_rappel_asso_message' => 'L’objet « @titre_article@ (@id_objet@)  » qui a été vendu au profit du projet « @titre_rubrique@ »  le @date_vente@ n’a visiblement pas encore fait l’objet d’un virement sur votre compte @compte_bancaire_asso@, par l’acheteur @prenom_acheteur@ @nom_famille_acheteur@.',
'email_rappel_asso_message_valider' => ' Si vous aviez entretemps reçu le payement,  nous vous remercions de bien vouloir le signaler au plus vite dans votre interface « Mon Kidonaki » afin de débloquer la transaction entre l’acheteur et le vendeur.',
'email_rappel_asso_sujet' => 'Confirmation de versement en attente',
'email_rappel_vendeur_merci_participation' => 'Nous vous remercions encore pour votre participation. ',
'email_rappel_vendeur_message' => 'Votre objet « @titre_article@ (@id_objet@) » vendu le @date_vente@ au profit du projet « @titre_rubrique@ » est en attente de paiement. ',
'email_rappel_vendeur_message_envoye' => 'Un rappel a été envoyé à l’acheteur et à l’association « @nom_asso@ » pour qu’elle vérifie les paiements reçus. ',
'email_rappel_vendeur_message_reception' => 'Dès que « @nom_asso@ » confirme la réception du payement, vous en serez averti et vous pourrez délivrer l’objet à l’acheteur « @prenom_acheteur@ @nom_famille_acheteur@ »(@email_acheteur@), à condition également que les éventuels frais de transport vous ait été  payés par celui-ci.',
'email_rappel_vendeur_sujet' => 'Objet vendu en attente de payement',
'email_remise_en_vente_sans_payer_encherisseurs' => 'Cette vente ne s’est pas clôturée et @nom_kidonateur@ @nom_famille_kidonateur@ a décidé de remettre son objet en vente.',
'email_remise_en_vente_sans_payer_encherisseurs_message' => 'Vous aviez placé une enchère sur l’objet @titre_article@ (@id_objet@), qui avait finalement été remportée par @prenom_acheteur@ @nom_famille_acheteur@  le @date_vente@.',
'email_remise_en_vente_sans_payer_encherisseurs_sujet' => 'Objet  @titre_article@ (@id_objet@) à nouveau disponible',
'email_remise_en_vente_sans_payer_encherisseurs_url' => ' Nous vous invitons donc à enchérir à nouveau sur cet objet si celui-ci vous intéresse toujours : @url_enchere@. ',
'email_remise_en_vente_vendeur_message' => 'Nous constatons que l’acheteur @prenom_acheteur@ @nom_famille_acheteur@ n’a pas donné suite à son achat et n’a pas effectué le paiement de l’objet « @titre_article@ (@id_objet@) » sur le compte de l’association @nom_asso@. ',
'email_remise_en_vente_vendeur_message_depasse' => 'Le délai toléré ayant été dépassé, nous vous suggérons de :',
'email_remise_en_vente_vendeur_message_remise' => 'Remettre simplement l’objet en vente  @url_remise@',
'email_remise_en_vente_vendeur_sujet' => 'Objet non-payé : remise en vente ?',
'email_reponse_objet' => '@nom_reponse@ a répondu
 
\"@reponse@\" 
 
à votre question au sujet de l\'objet @titre@.

\"@question@\"

Si vous désirez continuer cette discussion en posant une autre question, merci de le faire en visitant cette page: @url@

ATTENTION: NE PAS REPONDRE A CE MAIL EN CLIQUANT SUR REPONDRE. (Merci d\'utiliser uniquement les questions/réponses sur le site)  ',
'email_reponse_projet' => '@nom_reponse@ a répondu
 
\"@reponse@\" 
 
à votre question au sujet du projet @titre@.

\"@question@\"

Si vous désirez continuer cette discussion en posant une autre question, merci de le faire en visitant cette page: @url@

ATTENTION: NE PAS REPONDRE A CE MAIL EN CLIQUANT SUR REPONDRE. (Merci d\'utiliser uniquement les questions/réponses sur le site)  ',
'email_signature' => 'L\'équipe de Kidonaki',
'email_slogan' => 'Kidonaki - Une manière inédite de faire un don !',
'email_suiveur_avis_24_heures_encherir' => 'Vous pouvez encore enchérir sur cet objet dès maintenant : @url_enchere@)',
'email_suiveur_avis_24_heures_objet_message' => 'La vente de l\'objet « @titre_article@ (@id_objet@) » que vous suiviez ou sur lequel vous aviez porté une enchère est en passe de e clôturer. Si cet objet vous intéresse ne le laisser pas filer !',
'email_suiveur_avis_24_heures_sujet' => 'Fin de vente imminente : n’attendez plus !',
'email_vendeur_paiement_livraison_ok_message' => 'Les frais de transport pour l’objet « @titre_article@ (@id_objet@) » ont bien été versés sur votre compte par l’acheteur @prenom_acheteur@ @nom_famille_acheteur@. ',
'email_vendeur_paiement_livraison_ok_message_delivre' => 'Dès que vous aurez connaissance de l’adresse postale de l’acheteur, vous pouvez délivrer l’objet.  Votre acheteur est prévenu, mais vous pouvez aussi lui demander de vos envoyer ses coordonnées postales par courriel. Coordonnées Mail de l’acheteur : @email_acheteur@ ',


// H
'html_email_enchere_gagnee_message_specifique_email' => '<p>- Payer le montant de @montant_mise@ € sur le compte @compte_bancaire_asso@ de @nom_asso@  - Adresse : @adresse_asso@. N’oubliez pas de mentionner « @communication_virement@ - @titre_article@ - @id_objet@ » en communication.</p>

<p>	Dès qu’elle aura reçu le paiement, l\'association « @nom_asso@ » avertira le Kidonateur (vendeur) pour lui dire de se mettre en contact avec vous afin de régler les détails concernant l\'enlèvement de l\'objet.@message_paypal_asso@</p>

<p>Votre objet acheté est une place/entrée de la billetterie solidaire de KIDONAKI. Nous vous invitons à faire le virement (payement) sur le compte de l\'association au plus vite, afin de profiter d\'un maximum de jours de validité.</p>

<p>Rappel: la période de validité pour ce billet: du @date_debut@ au @date_fin@</p>',
'html_email_paiement_ok_acheteur_message_specifique_email' => '<p>Ce mail fait office de bon à valoir pour votre achat. Vous devez donc l\'imprimer, sauf si les conditions énoncées dans la description fixaient une autre procédure.</p>

<p>Rappel des conditions émises par l\'organisme vendeur: \"@commentaire@\" </p>',
'html_email_paiement_ok_acheteur_message_specifique_email_html' => '<p class=\"style11\">
Ce mail fait office de bon à valoir pour votre achat. Vous devez donc l\'imprimer, sauf si les conditions énoncées dans la description fixaient une autre procédure.
</p>
<p class=\"style11\">
Rappel des conditions émises par l\'organisme vendeur: 
</p>
<p class=\"style11\">
@commentaire@\" 
</p>
<p class=\"style2\"><span class=\"style7\">Nom du lieu culturel: @nom_lieu@<br />
 Dates de validité: @validite@</span><br />
 </p>',
'html_email_paiement_ok_acheteur_message_specifique_livraison' => '<p class=\"style11\">Pour obtenir cet objet, vous devez à présent (si ce n’est pas encore fait): </p>
<p class=\"style11\">

Payer les frais transport qui s’élèvent à « @prix_livraison@ »€ sur le compte @compte_bancaire_kidonateur@ du kidonateur @prenom_kidonateur@ @nom_famille_kidonateur@.@message_paypal_kidonateur@</p>',
'html_email_paiement_ok_kidonateur_message_specifique_email' => '<p>Sauf contre-indication préalable (dans la description de l\'annonce) de votre part, l\'acheteur imprimera ce mail qui fera office de bon à valoir.</p>',
'html_email_question_objet' => '<p>@nom_question@ vous a posé une question au sujet de l\'objet @titre@</p>

<p>\"@texte@\"</p>

<p>Pour répondre à cette question, merci de visiter la page : <a href=\"@url@>\"@url@</a> <br />
et de cliquer sur \"répondre au message\" sous la question posée.</p>

<p>Vous aurez l\'occasion de publier ou non la question/réponse, selon votre choix.</p>

<p>Merci d\'avance </p>

<p>L\'équipe de Kidonaki</p>

<p>ATTENTION: NE PAS REPONDRE A CE MAIL EN CLIQUANT SUR REPONDRE. (Merci d\'utiliser uniquement les questions/réponses sur le site) </p>',
'html_email_question_projet' => '<p>@nom_question@ vous a posé une question au sujet du projet @titre@</p>

<p>\"@texte@\"</p>

<p>Pour répondre à cette question, merci de visiter la page : <a href=\"@url@\">@url@</a> 
et de cliquer sur \"répondre au message\" sous la question posée.</p>

<p>Vous aurez l\'occasion de publier ou non la question/réponse, selon votre choix.</p>

<p>Merci d\'avance </p>

<p>L\'équipe de Kidonaki</p>

<p>ATTENTION: NE PAS REPONDRE A CE MAIL EN CLIQUANT SUR REPONDRE. (Merci d\'utiliser uniquement les questions/réponses sur le site)</p> ',
'html_email_reponse_objet' => '<p>@nom_reponse@ a répondu</p>
 
<p>\"@reponse@\" </p>
 
<p>à votre question au sujet de l\'objet @titre@.</p>

<p>\"@question@\"</p>

<p>Si vous désirez continuer cette discussion en posant une autre question, merci de le faire en visitant cette page: <a href=\"@url\">@url@</a></p>

<p>ATTENTION: NE PAS REPONDRE A CE MAIL EN CLIQUANT SUR REPONDRE. (Merci d\'utiliser uniquement les questions/réponses sur le site) </p> ',
'html_email_reponse_projet' => '<p>@nom_reponse@ a répondu</p>
 
<p>\"@reponse@\" </p>
 
<p>à votre question au sujet du projet @titre@.</p>

<p>\"@question@\"</p>

<p>Si vous désirez continuer cette discussion en posant une autre question, merci de le faire en visitant cette page: <a href=\"@url\">@url@</a></p>

<p>ATTENTION: NE PAS REPONDRE A CE MAIL EN CLIQUANT SUR REPONDRE. (Merci d\'utiliser uniquement les questions/réponses sur le site)</p>  ',
'html_email_signature' => '<p>L\'équipe de Kidonaki</p>

<p>Kidonaki - Une manière inédite de faire un don !</p>',


// M
'message_auto' => '(ceci est un mail envoyé automatiquement par le système kidonaki)',
'message_specifique_nombre' => 'Vous avez mis en vente @nombre@ exemplaires de cet objet. Le système les mettra en vente au fur et à mesure, en commençant par trois exemplaires.',
'montant' => 'Montant :',


// T
'transport_objet' => 'frais transport objet :'


);

?>