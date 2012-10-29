<?php

function lister($format,$tg,$attribut,$type,$item){
	$listes=array(
		'ul'=>array('li'),
		'dl'=>array('dt','dd'),	
		'ol'=>array('li'),		
		);

	$tag=$tg;
	$attr=$attribut;
	$liste='';
	
	// On récupère le tag et les éventuels attributs separé par la |
	$explode=explode('|',$type);
		
	//Le tag
	$tag=$explode[0];
	
	if(is_numeric($tag))$tag='';
	
	//Les attributs	
		if(count($explode)>0){
			foreach($explode AS $k=>$a){
				if($k>0)$attr.=' '.$a;
				}
			}
	
	//On regarde si on trouve une définition de la liste	
	if(array_key_exists($tag,$listes)){
			$liste=$tag;
			$ltag=$listes[$tag][0];
			}
	else {$ltag=$tag;}	//Sinon on prend le tag		
	if($tag){		
		if($format=='html'){
			if($liste){
				$liste_debut='<'.$tag.$attr.'>'."\n\n";
				$liste_fin='</'.$tag.'>'."\n\n";
				$espace=' '; 
				}
	
				$debut_tag=$espace.'<'.$ltag.'>';
				$fin_tag='</'.$ltag.'>';
				}
		else $debut_li='     -';
		}

	//Si il y au moins un élément de liste on affiche les tags du début et fin de la liste
	if(count($item)>0  AND $liste)$output.=$liste_debut;
	else $liste_fin='';
	
	//On affiche la liste
	foreach($item as $t=>$v){
		if(!is_array($v)){
			if($tag=='dl'){
				if ($t>0){
					$ltag=$listes[$tag][1];
					$debut_tag='	<'.$ltag.'>';
					$fin_tag='</'.$ltag.'>';
					}
				}
			if($item[$t])$output .=$debut_tag.$item[$t].$fin_tag."\n\n";	
			}
		else {
			if($tag!='dl')
			$output .=$debut_tag."\n\n";
			$output.=lister($format,$tg,$attribut,$t,$v);
			$output .=$fin_tag."\n\n";	
			}
		}
	$output.=$liste_fin;
	return $output;
}

//mis en page des élement d'un array
function mise_en_forme($texte,$format='html',$attribut='') {
	$tg='p';

		
	if($format=='html'){
		$debut='<'.$tg.  $attr.'>';
		$fin='</'.$tg.'>';
		}

	if(is_array($texte)){
		foreach($texte as $type =>$item){
		$tag=$tg;
		$attr=$attribut;
			// si pas d'array on affiche la ligne
			if($item and !is_array($item)){	
				if($format=='html'){
					$debut='<'.$tag.  $attr.'>';
					$fin='</'.$tag.'>';
					}
				 $output .=$debut.$item.$fin."\n\n";
				}
				
			// affichage spéciale en cas de liste composé d'un array				
			elseif(is_array($item)){
				$output.=lister($format,$tg,$attribut,$type,$item);
				}	
				// affichage on retourne
				else mise_en_forme($item,$format,$attr);
			}
		}
	// si pas d'array on affiche la ligne
	elseif($item) $output .=$debut.$item.$fin."\n\n";
	
return $output;
}

function requete_objets($where){
	$requete=sql_fetsel('*','spip_encheres_objets',$where);
	
	return $requete;
}

function requete_auteurs_elargis($where,$champs='*'){

	$requete=sql_fetsel($champs,'spip_auteurs LEFT JOIN spip_auteurs_elargis USING(id_auteur)',$where);

	return $requete;
}

function requete_geolocalites($where){

	$requete=sql_fetsel('titre,code_postal','spip_geolocalites',$where);

	return $requete;
}

function requete_articles($where){

	$requete=sql_fetsel('*','spip_articles',$where);	

	return $requete;
}

function requete_rubriques($where){

	$requete=sql_fetsel('*','spip_rubriques',$where);

	return $requete;
}
?>