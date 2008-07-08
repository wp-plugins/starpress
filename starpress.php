<?php
/*Plugin Name: Starpress
Plugin URI: http://www.starpass.fr/
Description: permet d'afficher la solution de paiement Starpass dans vos post
Author: Fr&eacute;d&eacute;ric Lasserre / Olivier Heinrich
Version: 1.0
Author URI: mailto:olivier@bdmultimedia.fr
starpress is released under the GNU General Public License (GPL)
    http://www.gnu.org/licenses/gpl.txt
*/

load_plugin_textdomain('starpress',$path = 'wp-content/plugins/starpress/languages');

// fonction qui va ajouter le javascript au header 
function add_js2header()
{
	$dir=get_option('siteurl').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
	//on récupère les 2 variables de textes d'ouverture/fermeture du module starpress qui vont s'afficher dans les listes.
	$on=stripslashes(get_option('texte_on'));
	$off=stripslashes(get_option('texte_off'));
	$js="\n<script type=\"text/javascript\"> var texte1 = \"".$on."\"; var texte2 = \"".$off."\"; </script>\n";
	$js.="\n<script type=\"text/javascript\" src=\"".$dir."/jquery.js\"></script>\n";
	$js.="<script type=\"text/javascript\" src=\"".$dir."/starpress.js\"></script>\n";

	print($js);
}
add_action('wp_head', 'add_js2header');



// cette fonction crée le shortcode et ses propriétés, qui permet d'afficher le module starpress à l'affichage du post et des listes
function starpress_shortcode ($atts)
{	
	// recuperation de l'id de la vidéo et des données supplémentaires entrées dans le shortcode
	extract(shortcode_atts(array('idd' =>'','datas' =>''), $atts));
	
	$i=rand(0,time(0)%9857421+0);
	
        
	// affichage pour un post unique, $idd étant l'id entré dans le shortcode
	if (is_single() || is_page()) {
		//on reprend le module de starpass, en mettant comme variable idd. Les autres données sont codées.
		$texte=  '<div id="starpass_'.$i.'"></div><script type="text/javascript" charset="iso-8859-1" src="http://script.starpass.fr/scriptwp.php?idd='.$idd.'&amp;verif_en_php=1&amp;datas='.base64_encode($datas).'&amp;domobj=starpass_'.$i.'">
		</script>';
		}
						
	// affichage pour les listes avec ouverture de fenêtre par jquery
	else {
			$idlist=get_option('id_list'); 
			if (isset($idlist) && $idlist=="ok") {
													$dir=get_option('siteurl').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
													//récupération du texte pour afficher starpress 
													$on=stripslashes(get_option('texte_on'));
													//on crée une variable qui va définir les classes 
													$texte=' 
													
														<div style="width:100%; height:16px;">
															<!--  affiche les icones (fw/back) -->
															<div style="heigth:16px;width:20px; float:left;">
																<a class="montre_'.$i.'"  href="">
																	<img id="img1_'.$i.'" src="'.$dir .'/fw.png" style="float:left;padding:0;margin:0;">
																	<img id="img2_'.$i.'" style="float:left;display:none;" src="'.$dir .'/back.png">
																</a>
															</div>
															<!-- affiche les textes $on/$off entrés en admin -->
														 	<div style="color:white; height:16px;width:200px;margin:-2px;float:left;" >
																<a class="montre_'.$i.'" style="" href="">
																	<span id="toggletexte_'.$i.'" style="font-family:helvetica ; font-size: 10pt; font-weight: bold;color:#ff2f16; ">'.$on.'</span>
																</a>
															</div>
															<div style="clear:both"></div>
														</div>
															<!-- affiche le cadre starpass -->
														<div id="cache_'.$i.'" style="display:none"><div id="starpass_'.$i.'"></div>
										<script type="text/javascript" src="http://script.starpass.fr/scriptwp.php?idd='.$idd.'&amp;verif_en_php=1&amp;datas='.base64_encode($datas).'&amp;domobj=starpass_'.$i.'"></script>
														</div>';
													}
	}
		
	//affichage en cas d'erreur 404 
	if (is_404()) $texte= '';
	
	return $texte;
}

add_shortcode('starpress','starpress_shortcode');

// rajoute un onglet "starpress" dans le menu "réglage" de l'admnin
function starpress_menu () {
  add_options_page('starpress', 'starpress', 8, basename(__FILE__), 'starpress_options_page');
}
//on récupère les données entrées dans la page d'admin starpress (id_site, id_personne) ainsi que les textes d'affichages)
function starpress_options_page(){
	

if ($_POST['hidden_field']==='Y') { // form processing
	$ids= $_POST['id_site'];  
	$idp= $_POST['id_personne'];
	$on= $_POST['texte_on'];
	$off= $_POST['texte_off'];
	$idlist= $_POST['id_list'];

    update_option('id_site',$ids);
	update_option('id_personne',$idp);
	update_option('texte_on',$on);
	update_option('texte_off',$off);
	update_option('id_list',$idlist);
    
  }
      
$ids=get_option('id_site');
$idp=get_option('id_personne');
$on=stripslashes(get_option('texte_on'));
$off=stripslashes(get_option('texte_off'));
$dir=get_option('siteurl').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
$idlist=get_option('id_list');
   
   ?>
     
<!-- page admin ajoutée dans wordpress -->
<div class="wrap">
    <h2>Starpress</h2>
    <p><?php _e("Starpress let you show the","starpress"); ?> <a href="http://www.starpass.fr" target="_blank">Starpass</a> <?php _e("micropaiement solution on your blog","starpress"); ?>.</p>
<p><?php _e("The Starpress plugin let your visitors access the paying content (articles, photos, vid&eacute;os) directly from your posts","starpress"); ?>. <?php _e("Apply to the","starpress"); ?> <a href="http://www.starpass.fr" target="_blank">Starpass</a> <?php _e("service, define your paiement and access methods, and then just enter the [starpress] shortcode into your posts","starpress"); ?>.</p>

	<h3><?php _e("how it works","starpress"); ?></h3>  
	<p><?php _e("When writing a new post promoting your paying content, insert the [starpress idd='xxxx'] shortcode where xxxx is the document id* related to the protected area they will be directed to by","starpress"); ?> <a href="http://www.starpass.fr" target="_blank">Starpass</a> <?php _e("if the validation is a success. The Starpass form is then inserted as a text link in the lists, and as a whole when the post is displayed","starpress"); ?><br> <?php _e("<strong>Important: the wp_head function must be called by your theme's header.php file</strong>, if this isn't the case, you must add the &lt;?php wp_head();?&gt; line to the &lt;head&gt;&lt;/head&gt; part. If wp_head isn't called, the Starpress plugin won't work at all !","starpress"); ?> </p> 
	<p>*<?php _e("Once approved on","starpress"); ?> <a href="http//www.starpass.fr" target="_blank">Starpass.fr</a> <?php _e("you will easily find the identifiers by browsing the scripts provided to protect your pages","starpress"); ?></p>
	<p></p>
    <form name="form1" method="post" action="">
      <input type="hidden" name="hidden_field" value="Y">
		 <p><?php _e("Your affiliate ID","starpress"); ?>* </p>
		<input type="text" name="id_personne" value="<?=$idp?>" />
	   <p><?php _e("Your site ID","starpress"); ?>* </p>
     	<input type="text" name="id_site" value="<?=$ids?>" />
     	<p><?php _e("Show on lists","starpress"); ?>: </p> <input type="checkbox" name="id_list" value="ok"  <?php if (isset($idlist) && $idlist=="ok") echo "checked"; ?> />
		<p><?php _e("Show link label","starpress"); ?> </p>
			<input type="text" name="texte_on" value="<?=$on?>" />
			<p><?php _e("Hide link label","starpress"); ?> </p>
			<input type="text" name="texte_off" value="<?=$off?>" />
    
      <p class="submit">
        <input type="submit" name="Submit" value="<?php _e("Update Options","starpress"); ?>" />
      </p>
    </form>
	<p>*<?php _e("Once approved on","starpress"); ?> <a href="http//www.starpass.fr" target="_blank">Starpass.fr</a> <?php _e("you will easily find the identifiers by browsing the scripts provided to protect your pages","starpress"); ?></p>
  </div>
  <?php

}
add_action('admin_menu', 'starpress_menu');

?>