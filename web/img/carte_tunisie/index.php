<?php session_start();
$_SESSION['last_page'] = "index.php";

if(isset($_REQUEST["act"]) && $_REQUEST["act"]=="deconn" && $_REQUEST["id_i"]!= "")
{
	$_SESSION['user'] = "";
	unset($_SESSION['user']);
	$_SESSION['clientId'] = "";
	unset($_SESSION['clientId']);
}

require_once("commun/connexion.php");
require_once("commun/classes/mysql.class.php");

$db = new db_mysql($hote, $utilisateur, $pass, $base);
require_once("commun/classes/class_client.php");
require_once("commun/classes/class_annonce.php");
require_once("commun/classes/class_message.php");
require_once("commun/fonctions.php");
require_once("commun/classes/class_pays.php");
require_once("commun/classes/class_regions.php");
$pays=new Pays();
$annonce=new Annonce();
$tab_Pays=$pays->getPays();
$count_pays=count($tab_Pays);

require_once("commun/classes/class_categories.php");
require_once("commun/classes/class_Scategorie.php");
$categorie=new Categorie();
$tab_catm=$categorie->getcategories();
$count_catm=count($tab_catm);
$arrStarAnn = $annonce->getStarAnnonces();

$region = new Region();
$region->set('PaysId','224');
$Tabreg=$region->getRegions();

$Scategorie = new Scategorie ();
if(isset($_SESSION['clientId']))
{
	$clientid = $_SESSION['clientId'] ;
	$user = new Client();
	$user->userDetail($clientid);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>STAR ANNONCES annonces gratuites en Tunisie</title>
<link rel="SHORTCUT ICON" href="images/favicon.ico" />
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta name="keywords" content="">
</meta>
<meta name="description" content="">
</meta>
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" type="text/css" href="css/demo.min.css" />
<!--[if IE 6]><style type="text/css">body {padding-top:0px;}</style><![endif]-->
<!--[if lte IE 7]><style type="text/css">div.tooltip {width:73px;}</style><![endif]-->

<link rel="stylesheet" type="text/css" href="css/slidingtabs-horizontal.css" />
<link rel="stylesheet" type="text/css" href="css/slidingtabs-vertical.css" />
<link rel="stylesheet" href="css/style.css" media="screen" />
<script type="text/javascript" src="js/jquery.js"></script>
<!--<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>-->
<script type="text/javascript" src="js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>

<script type="text/javascript" src="js/custom_fly_selection.js"></script>

<script type="text/javascript" src="thickbox/thickbox.js"></script>
<link rel="stylesheet" type="text/css" href="thickbox/thickbox.css" />

<!--//////////////////////APPRISE -> customise js alerts//////////////////////////-->
<script type="text/javascript" src="js/apprise-1.5.full.js"></script>
<link rel="stylesheet" href="css/apprise.css" type="text/css" />
<!--////////////////////////////////////////////////-->

<script>
		
	jQuery(document).ready(function($){
	 
  // var expandhide_text = '<span class="hide">&nbsp;</span>';
   // $('.accordion-content').hide('slow').addClass('accordionhidden');
		 
		$('.accordion-title').click(function() {
			$(this).next().toggle("slow").addClass('accordionhidden');
			return false;
		});

        $(".signin").click(function(e) {          
			e.preventDefault();
            $("fieldset#signin_menu").toggle();
			$(".signin").toggleClass("menu-open");
        });
			
		$("fieldset#signin_menu").mouseup(function() {
			return false
		});
		$(document).mouseup(function(e) {
			if($(e.target).parent("a.signin").length==0) {
				$(".signin").removeClass("menu-open");
				$("fieldset#signin_menu").hide();
			}
		});			

		$(".successbox").fadeOut(5000);
		 
	});
		
</script>
		
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true,
				continuous: true 
			});
		});	
</script>
	
<!--[if gte IE 7]>

<link rel="stylesheet" href="css/ie.css" type="text/css" media="all" />

<![endif]-->
		
<!--/////////////////////FOR THE MAP///////////////////////////-->
<script type="text/javascript" src="js/jquery.qtip-1.0.0-rc3.min.js"></script>
<script type="text/javascript">
$(document).ready(function() 
{
	<?php
	if(isset($_SESSION['user']))
		echo "load_selection()";
	?>
				   // Match all link elements with href attributes within the content div
	   $('#carte-map area[shape]').qtip(
	   {
					   
				   
					   position: {
						   corner: {
							  tooltip: 'bottomMiddle',
							  target: 'topMiddle'
						   }
					   },
					   style: {
						   name: 'light',
						   
						   border: {
							color: '#085a74',
							width: 1,
							radius: 3
						   },
						   padding: 4, 
						   textAlign: 'center',
						   tip: true, // Give it a speech bubble tip with automatic corner detection
						},
					  
					  content: {
							// Set the text to an image HTML string with the correct src URL to the loading image you want to use
					url:'file:///J:/POC/maps%20and%20qTips/france_city.png.map.html'
					
					}
				   });
});
</script>
<script language="javascript" type="text/javascript">
	function changeImg(image_name,country){
		var majuscule=image_name.charAt(0);
		var premier=majuscule.toUpperCase();
		var longueur=image_name.length;var reste=image_name.substring(1,longueur);
		var element=document.getElementById(country+"map");
		element.setAttribute("alt","annonces "+premier+reste+"");
		element.src="images/carte_"+country+"/"+image_name+".png";
		if(image_name!="none"){
			document.getElementById(image_name).style.cursor="pointer";
		}
	}

	function initMap(image_name,country){
		var element=document.getElementById(country+"map");
		element.src="images/carte_"+country+"/"+image_name+".png";
	}
</script>

		<!--///////////////////////MAP/////////////////////////-->
                
<!--//////////////////////ex-adsbook -> annonces stars//////////////////////////////-->
                
                <link rel="stylesheet" href="css/style_lastann.css" type="text/css" media="screen"/>
        <style type="text/css">
          span.reference a{
			text-shadow:1px 1px 1px #fff;
			color:#999;
			text-transform:uppercase;
            text-decoration:none;
            position:fixed;
            right:10px;
            top:10px;
            font-size:13px;
			font-weight:bold;
          }
          span.reference a:hover{
            color:#555;
          }
		  h1.title{
			  color:#777;
			  font-size:30px;
			  margin:10px;
			  font-weight:normal;
			  text-shadow:1px 1px 1px #fff;
			}
			
			#close{
				width:20px; 
				height:20px; 
				background-image:url(../images/stars_small.png); 
				float:right;
				cursor: pointer;
			}
      </style>
                
<!--/////////////////FIN/////ex-adsbook -> annonces stars//////////////////////////////-->
</head>
<body>      
<div id="container">
          <div class="header">
    <div class="logo"><a href="index.php"><img src="images/logo.png" width="265" height="100" /></a></div>
    <div class="pub_top">
      <div id="slider">
			<ul>				
				<li><a href="deposer_annonce.php"><img src="images/b1_small.jpg" alt="" /></a></li>
				<li><a href="aide.php"><img src="images/b2_small.jpg" alt="" /></a></li>
				<li><a href="#"><img src="images/b3_small.jpg" alt="" /></a></li>		
			</ul>
		</div>
    </div>
    <?php

	if(isset($_SESSION['user'])){
		$lien = '<a href="logout.php">Se d&eacute;connecter</a>';
		$nbmess= new Message();
		$nbr= $nbmess->Get_mess_recu($_SESSION['clientId']);
		if(isset($_SESSION["client_pseudo"]))
			$pseudo= $_SESSION["client_pseudo"];
		else
			$pseudo = '';
		echo  '<div id="topnav" class="topnav"><div class="connected">Bienvenue <i>'.$pseudo.'</i> <img src="images/btn_deconn.gif" border="0" width="15" style="float:right; cursor:pointer; margin:7px 0px 7px 4px" onclick="location.href=\'index.php?act=deconn&id_i='.$_SESSION["clientId"].'\'" alt="Se déconnecter" title="Se déconnecter"  /></div></div>';
	}else{
		echo  '<div id="topnav" class="topnav"> <a href="inscription.php" class="oranger">S\'inscrire</a> <a href="login" class="signin"><span>Connexion</span></a> </div>';
	}
	?>
    <fieldset id="signin_menu">
              <form method="post" id="fast_connexion" action="connexion.php">
        <label for="username">Pseudo</label>
        <input id="login_cnx" name="login_cnx" value="" title="login_cnx" tabindex="4" type="text">
        </p>
        <p>
                  <label for="password">Mot de passe</label>
                  <input id="pass_cnx" name="pass_cnx" value="" title="pass_cnx" tabindex="5" type="password">
                </p>
        <p class="remember">
                  <input id="signin_submit" value="Valider" tabindex="6" type="submit">
                  <input id="remember" name="remember_me" value="1" tabindex="7" type="checkbox">
                  <label for="remember">Rester connecté</label>
                </p>
        <p class="forgot"> <a href="connexion.php?fgt_pwd" id="">mot de passe oublié ?</a> </p>
      </form>
            </fieldset>
			
	<div class="my_selection_2">
		<!--- /////////////Annonces favorites//////////////////// -->

		<div id="contentWrapRight" style="float:left;">
				<div id="basketWrap">
					<div id="basketTitleWrap">
						<span id="notificationsLoader"></span>
					</div>
					<div id="basketItemsWrap">
					</div>
				</div>
		</div>
		<!--- /////////////Annonces favorites//////////////////// -->
	</div>
    <div class="clr"></div>
    <div class="menu_nav">
              <ul>
              <?php
        if(!isset($_SESSION['user'])){
        ?>	       
        <li class="active" style="width: 115px"><a href="index.php">Acceuil </a></li>
        <?php 
        }else
        { ?>
        <li class="active" style="width: 145px"><a href="index.php">Acceuil </a></li>
        <?php 
        }
        ?>
        
        
        <?php
        if(!isset($_SESSION['user'])){
        ?>	       
        <li style="width: 207px"><a href="deposer_annonce.php">Déposer une annonce </a></li>
        <?php 
        }else
        { ?>
        <li style="width: 227px"><a href="deposer_annonce.php">Déposer une annonce </a></li>
        <?php 
        }
        ?>
        
        <?php
        if(!isset($_SESSION['user'])){
        ?>	       
        <li style="width: 131px"><a href="recherche.php">Recherche</a></li>
        <?php 
        }else
        { ?>
        <li style="width: 161px"><a href="recherche.php">Recherche</a></li>
        <?php 
        }
        ?>
        
        
        <?php
        if(!isset($_SESSION['user'])){
        ?>	       
        <li style="width: 166px"><a href="connexion.php">Connexion</a></li>
        <?php 
        }else
        { ?>
        <li style="width: 186px"><a href="espace_membre.php">Espace membre</a></li>
        <?php 
        }
        ?>
        
        
        <?php
        if(!isset($_SESSION['user'])){
        ?>	       
               <li style="width: 99px"><a href="aide.php">Aide</a></li>
        <?php 
        }else
        { ?>
               <li style="width: 129px"><a href="aide.php">Aide</a></li>
        <?php 
        }
        ?>
        
        <?php
        if(!isset($_SESSION['user'])){
        ?>	       
        <li style="width: 167px"><a href="inscription.php">Inscription</a></li>
        <?php 
        }
        //else
        //{ ?>
        <!-- <li style="width: 170px"><a href="espace_membre.php">Espace professionel</a></li> -->
        <?php 
        //}
        ?>
        
        <?php
        if(!isset($_SESSION['user'])){
        ?>	       
               <li style="width: 95px"><a href="contact.php">Contact</a></li>
        <?php 
        }else
        { ?>
               <li style="width: 132px"><a href="contact.php">Contact</a></li>
        <?php 
        }
        ?>
        
        
        
      </ul>
            </div>
  </div>
          <div class="content">
    <div class="depose_form">
              
              <div class="bt_deposehau"><div class="deposerannonce"><a href="deposer_annonce.php"></a></div></div>
            </div>
    <div class="cont_left">
              <div class="ann_themes">
        <h2>Annonces par thèmes</h2>
        <div>
        <?php for($i=0;$i<$count_catm;$i++){ ?>
				 <?php $Scategorie->set('CatId',$tab_catm[$i]["Id"]);
			      $tabScat = $Scategorie->getScategorie();
				  $countscat = count($tabScat);
		?>
					<?php
					if($i == ($count_catm - 1))
						echo '<div class="accordion-title" style="border-bottom:none">';
					else
						echo '<div class="accordion-title">';
					?>
         			 <?php echo htmlentities($tab_catm[$i]["Category"]);?> </div>
                     <div class="accordion-content">
                    <ul>
                              <?php
							 if($countscat>0)
							 {
							  for($j=0;$j<$countscat;$j++){ ?>            
									<li><a href="tunisie-annonce-recherche-<?php echo $tabScat[$j]["Id"]; ?>-<?php echo format_url($tabScat[$j]["category"])?>"><?php echo htmlentities($tabScat[$j]["category"])?></a></li>
							<?php }
							?>
									<li><a href="tunisie-annonce-recherche-tout-<?php echo $tab_catm[$i]["Id"]; ?>-<?php echo format_url($tab_catm[$i]["Category"]);?>">Tout</a></li>
									
								
							<?php
							} ?>
                    </ul>
                  </div>
        <?php
		}
		?>
        </div>
        </div>
        
       <div class="fbouk">
        <h2><div style="float:left;">Nous joindre sur</div> <div style="margin-left:9px; float:left"><img src="images/facebook.png" alt="" /></div></h2>
        <div class="fbdiv"><img src="images/fb.gif" width="180" height="210" /></div>
      	</div> 
      
      
        <!-- <div class="depose_ann">
        <h2>D&eacute;poser une annonce </h2>
        <form id="form1" action="deposer_annonce.php" method="post">
		<div>
                  <div class="txt_radio"><input name="type_gr" class="radio" type="radio" value="offre" /></div>
                  <div class="txt_radio"><div style="margin:7px 15px 0px 5px">Offre</div></div>
                  <div class="txt_radio"><input name="type_gr" class="radio" type="radio" value="demande" /></div>
                  <div class="txt_radio"><div style="margin:7px 15px 0px 5px">Demande</div></div>
		</div>
                  <p class="first">
            <select name="at_gr" id="cat_gr">
                      <option>Thème</option>
                      <?php  for($i=0;$i<$count_catm;$i++) { ?>
                          <option value="<?php echo $tab_catm[$i]["Id"]; ?>"><?php echo htmlentities($tab_catm[$i]["Category"]);?></option>
                          <?php } ?>
                    </select>
          </p>
                  <p>
				  <div id="listRegion">
										  <select id="region_dep" name="region_dep" style="float:left" class="required cp_views_dep">
											<option value="">Région</option>
										<?php
											for($i=0;$i<count($Tabreg);$i++){
											
											echo "<option value ='".$Tabreg[$i]["Region"]."'";
											
											
											if($_POST["region_recherche"]==$Tabreg[$i]["Id"])$affichage.="selected";
											
											
											echo ">".$Tabreg[$i]["Region"]."</option>";
											}
											?>
										  </select>
				  </div>
                   </p>
                  <p>
            <input class="input_depo_txt" type="text" name="titre_gr" value="Titre de votre annonce" onblur="if(this.value=='') this.value='Titre de votre annonce';" 
                        onfocus="if(this.value=='Titre de votre annonce') this.value='';"  />
          </p>
                  <p class="submit">
            <button type="submit">Envoyer</button>
          </p>
                </form>
      </div>-->
              
            </div>
    <div class="cont_center">
	<?php
			if(isset($_REQUEST["act"]) && $_REQUEST["act"]=="deconn" && $_REQUEST["id_i"]!= "")
			{
			?>
				<div><div class="successbox box-notification-content" style="text-align:center" > Déconnexion effectuée avec succès </div></div>
			<?php
			}
	?>
              <div class="titre_star">Les annonces Stars</div>
              
              <!-------------------------------Ex adsbook -> annonces stars----------------------------------------------------------->
              <?php 
                $annonces_stars = $annonce->get_ann_star();
       
                $liste_ids_stars = implode(',',$annonces_stars);
              ?>
              
              <div class="cn_wrapper">
			<div id="cn_preview" class="cn_preview">
			
			
			<!--||||||||||||||||||||||||||-->
			<?php 
			
						$tab = array();
						$ki = 0;
						  $maxRows_rs = 60;
							$pageNum_rs = 0;
							if (isset($_GET['pageNum_rs'])) {
							  $pageNum_rs = $_GET['pageNum_rs'];
							}
							$startRow_rs = $pageNum_rs * $maxRows_rs;
		
		
		
							$where  = "WHERE anon_Id IN (".$liste_ids_stars.") AND st_images.image_anon_Id = st_annonces.anon_Id AND st_images.image_Url3 IS NOT NULL AND anon_Valid =1 ";
							//si y a sous categorie
							if(isset($_GET['SCATID']) && $_GET['SCATID'] != -1 ){
								$where .= ' AND anon_cat_Id  = '.$_GET['SCATID'];
							}
							//Recherche par pays
							if(isset($_GET['pays_rech']) && $_GET['pays_rech'] != -1){
								$where .=' AND anon_pays_Id = '.$_GET['pays_rech'];
							}
							
							//Recherche par rÃ©gion
							if(isset($_GET['region_rech']) && $_GET['region_rech'] != -1){
								$where .=' AND anon_reg_Id = '.$_GET['region_rech'];
							}
							
								$query_rs = 'SELECT DISTINCT(anon_Id),anon_cat_Id,anon_Titre,anon_reg_Id,anon_long_Desc,anon_Dcr,image_Url3,anon_Visite FROM st_annonces, st_images '.$where.'  AND anon_indesi ="1" GROUP BY anon_Id ORDER BY anon_Id DESC';
		
		
		
						$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
						$res= mysql_query($query_limit_rs);
						$k = 0;
						
						while($row = mysql_fetch_array($res)){
							$region = new Region();
							$region->get_details($row['anon_reg_Id']);
							  //photo
							  $req_photo ="SELECT image_Url2 FROM st_images WHERE image_anon_Id='".$row['anon_Id']."'";
							  $res_photo = mysql_query($req_photo) or die(mysql_error());
							  $row_photo = array();
							  $i = 0;
							  while($ligne=mysql_fetch_row($res_photo))
							  {
							  	$row_photo[$i] = $ligne[0];
								$i++;
							  }


							  if(isset($row_photo[0]) && is_file("server/php/thumbnails/".$row_photo[0])){
							 	 $photo = $row_photo[0];
								 if(count($row_photo) == 1)
								 	$nbr_photos = "1 photo";
								else
								   $nbr_photos = count($row_photo)." photos";
							  }else{
								  $photo = "photo_indispo.png";
								  $nbr_photos = "";
							  }
							  $date_aff = explode(" ",$row['anon_Dcr']);
							  $ggg = $date_aff[0];
							  $date_today = date("Y-m-d");
							  if($date_aff[0] == date("Y-m-d"))
								$date_affich = "Aujourd'hui";							
							  else
								$date_affich = $date_aff[0];
								
							$date_affich = date("d/m/Y", strtotime($date_affich));
								
							$desc_brut_length = strlen($row['anon_long_Desc']);
							
							if($desc_brut_length > 70)
							{
								$desc_brut = substr($row['anon_long_Desc'],0,70);
								$tab_ess = explode(' ',$desc_brut);
								$descri = '';
								for($m=0 ; $m<(count($tab_ess)-1) ; $m++)
								{
									$descri .= $tab_ess[$m].' ';
									
								}
								$descri.= '...';
							}else {
								$descri = $row['anon_long_Desc'];
							}

								

								
							//Référence de l'annonce
							$tab_prov = explode("-",$ggg);
							$ref = $row['anon_Id'].$tab_prov[2];
							
							$tab[$ki]["anon_Id"] = $row['anon_Id'];
							$tab[$ki]["anon_cat_Id"] = getAnnCat($row['anon_cat_Id']);
							$tab[$ki]["photo"] = $photo;
							$tab[$ki]["anon_Titre"] = stripslashes($row['anon_Titre']);
							$tab[$ki]["date_affich"] = $date_affich;
							$tab[$ki]["anon_reg_Id"] = _get_region($row['anon_reg_Id']);
							$tab[$ki]["anon_long_Desc"] = $descri;
							$tab[$ki]["anon_Visite"] = $row['anon_Visite'];
							
							$ki++;
						}
						$ka = 0;
						foreach($tab as $annonce_star)
						{
							if($ka == 0)
								$style = " style='top:5px;'";
							else
								$style = "";
						$ka++;
						if($annonce_star['anon_Visite'] != 0)
							$visites = "Vue ".$annonce_star['anon_Visite']." fois";
						else 
							$visites = "";
						?>
						<div class="cn_content" <?php echo $style; ?>>
							<div style="width: 219px; text-align:center"><a href="detail.php?ann=<?php echo $annonce_star["anon_Id"]; ?>" style="width:100%; text-align:center; margin:auto" target="_blank"><img src="/server/php/thumbnails/<?php echo $annonce_star["photo"]; ?>" alt="<?php echo $annonce_star["anon_cat_Id"]; ?>" /></a></div> 
							<h1><?php echo $annonce_star["anon_Titre"]; ?></h1>
							<p><?php echo $annonce_star['anon_long_Desc'];?></p>
							<div>
							<div style="text-align:left; color:#FF6C00; text-shadow:none; float:left; width:105px;"><?php echo $visites ?>&nbsp;</div>
							<div style="text-align:left; float:left; width:105px; text-align:right;"><?php echo $annonce_star["date_affich"]; ?></div>
							</div>
							<div class="cn_category"><?php echo $annonce_star["anon_reg_Id"]; ?></div>
							<a href="detail.php?ann=<?php echo $annonce_star["anon_Id"]; ?>" target="_blank" class="cn_more">D&eacute;tail Annonce</a>
						</div>
						<?php
						}
		?>
			<!--||||||||||||||||||||||||||-->
				
			</div>
			<div id="cn_list" class="cn_list">
			<?php
			$comp = 0;
			$comp2 = 4;
			foreach($tab as $annonce_a)
			{
							
							//echo "<br>".$comp;
							if($comp == 0)
							{
								echo '<div class="cn_page" style="display:block;">';
								
							}
							elseif(($comp == $comp2))
							{
								echo '</div><div class="cn_page">';
								$comp2 = $comp2+4;
								
							}
								
						?>
								<div class="cn_item">
									<h2><?php echo $annonce_a["anon_Titre"]; ?></h2>
									<p><?php echo $annonce_a["date_affich"]; ?></p>
								</div>
							
						<?php	
							if( ($comp == 59)|| ($comp == count($tab)-1))
							{
								echo '</div>';

								
							}
							
						$comp ++;	

								
			}
			?>
			
				
				<div class="cn_nav">
					<a id="cn_prev" class="cn_prev disabled"></a>
					<a id="cn_next" class="cn_next"></a>
				</div>
			</div>
		</div>
              
              
              <!--------------------------------------FIN----Ex adsbook -> annonces stars------------------------------------------------>
        
              
              <div class="annonce_bottom">

        <div class="last_ann_index">
		<div class="titre_annon">
            <h2>Les dernières annonces</h2>
          </div>
		
		
                   <ul class="liste_search_index">
                  <?php 
						 
				$ch_last = 0;
				
				$dernieres_annonces = $annonce->getLastAdverts(7);
						
				foreach($dernieres_annonces as $ann)
				{

				 $ch_last ++;
				  if($ch_last == count($dernieres_annonces))
				  	echo "<li style='border:none !important'>";
				 else
				 	echo "<li>";
				?>
                  
                    <div class="liste_gauche_index">
					<div class="img">
                    
                    
						<a href="tunisie-annonce-<?php echo $ann['anon_Id'];?>-<?php echo format_url($ann['anon_Titre']); ?>-<?php echo format_url(_get_region_value($ann['anon_reg_Id'])); ?>" style="text-decoration:none; color:#069; font-size:12px" alt="<?php echo getAnnCat($ann['anon_cat_Id']); ?>">
							<div id="productImageWrapID_<?php echo $ann['anon_Id'];?>"><img src="/server/php/thumbnails/<?php echo $ann['photo']; ?>" alt="<?php echo getAnnCat($ann['anon_cat_Id']); ?>" style="max-height:88px; max-width:90px;" /></div></a>
                      <div class="num-photos"><?php echo $ann['nbr_photos'] ?></div>
                      </div>


                    </div>
                    <div class="liste_droite_index1">
                      <div class="titre_ann_home"><a href="tunisie-annonce-<?php echo $ann['anon_Id'];?>-<?php echo format_url($ann['anon_Titre']); ?>-<?php echo format_url(_get_region_value($ann['anon_reg_Id'])); ?>" style="text-decoration:none;" class="titre_ann_home"><strong><?php echo ucfirst(stripslashes($ann['anon_Titre'])); ?></strong></a></div>
                      <div class="prix">
                      <?php 
                      if($ann['anon_Prix'] != 0)
                      	echo number_format($ann['anon_Prix'], 0, ',', ' ')."<sup>dt</sup>"; 
                      else
                      	echo "N.D";
                      ?>
                      
                      </div>
                      <div class="plus">
                        <?php if (isset($_SESSION['user'])){?>
                        <div style="float:right" class="productPriceWrapRight"><a href="inc/functions.php?action=addToBasket&productID=<?php echo $ann['anon_Id'];?>" onclick="return false;"><img src="images/plus.gif" width="24" height="18" alt="Ajouter à ma selection" title="Ajouter à ma selection" style="cursor:pointer" id="featuredProduct_<?php echo $ann['anon_Id'];?>" /></a></div>
                        <?php }else{ ?>
                        <img src="images/plus.gif" width="24" height="18" alt="Ajouter à ma selection" title="Ajouter à ma selection" onclick="apprise('Merci de vous connecter pour ajouter les annonces favorites', {'animate':true});" style="cursor:pointer" />
                        <?php } ?>
                      </div>
                      <div class="desc"><?php echo stripslashes($ann["description"]);?></div>
                      <div style="float: left; width: 100%; text-align: right; color: #999; font-size:11px">Vue <?php echo $ann['anon_Visite']; ?> fois<!-- &nbsp;<img src="images/eye.png" alt="vue <?php echo $ann['anon_Visite']; ?> fois" title="vue <?php echo $ann['anon_Visite']; ?> fois" /> --></div>
                    </div>
                    <div class="bottom_liste">
                      <div class="location"><span class="text_1"><strong>&nbsp;Lieu :</strong> <span><?php echo _get_region($ann['anon_reg_Id']); ?></span></span> </div>
                      <div class="posted2"><span class="text_2"><strong>Post&eacute; </strong> <span><?php echo $ann["date_affich"]; ?></span></span> </div>
                      </div>
					  <div class="clr"></div>
                  </li>
                  <?php 
						
							
				} 
			  ?>
          </ul>
                </div>
                <div style="float:left; width:100%; text-align:right; color:#333"><a href="index_3em.php?modal=true" class="thickbox" style="float:left; width:100%; text-align:right; color:#999">>> Voir plus d'annonces</a></div>
      </div>
            </div>
    <div class="cont_right">
              <div class="carte_tun">
        <h2>Les annonces par région </h2>
      <div class="map_tuni boxgrid">
                  <!--////////////////MAP///////////////////-->
				  <div id="carte-map">

					<img src="images/carte_tunisie/none.png" alt="votre petite annonce gratuite par région en tunisie" name="tunisiemap" width="207" height="434" usemap="#Map" class="carte" id="tunisiemap"  style="border-style:none" />


					<map id="Map" name="Map" onmouseout="javascript:initMap('none', 'tunisie');">

					<area shape="poly" alt="BIZERTE" coords="76,16,77,13,82,11,86,9,100,5,111,1,118,2,114,7,116,13,121,13,123,10,121,7,131,7,134,9,132,14,135,17,136,21,137,23,123,25,118,23,111,28,102,30,97,36,94,34,94,30,91,27,87,22,83,19,79,18" href="recherche.php?region_recherche=BIZERTE" title="BIZERTE" onmouseover="javascript:changeImg('bizerte', 'tunisie');" id="bizerte" class="black" />

					<!--<area shape="poly" alt="GRAND TUNIS" coords="106,32,112,29,119,25,123,26,134,25,136,24,140,27,141,28,141,31,137,33,136,36,137,37,138,38,138,38,140,36,145,42,143,56,140,56,132,47,126,46,125,43,120,44,115,36,107,33" href="recherche.php?region_recherche=GTUNIS" title="GRAND TUNIS" onmouseover="javascript:changeImg('grand-tunis', 'tunisie');" id="grand-tunis"/>

					<area shape="poly" alt="NABEUL" coords="145,56,147,44,147,41,152,39,155,33,158,31,170,25,177,18,178,18,181,31,171,44,166,55,154,60,149,62,146,63,143,60" href="recherche.php?region_recherche=NABEUL" title="NABEUL" onmouseover="javascript:changeImg('nabeul', 'tunisie');" id="nabeul" />

					<area shape="poly" alt="BEJA" coords="75,17,71,20,71,22,75,27,75,29,73,32,77,40,80,49,79,52,78,54,81,60,86,59,90,60,95,56,101,54,104,56,108,55,112,54,117,47,119,45,113,37,107,34,105,33,103,32,99,37,97,38,93,37,91,36,92,30,84,22,79,20,78,19" href="recherche.php?region_recherche=BEJA" title="BEJA" onmouseover="javascript:changeImg('beja', 'tunisie');" id="beja" />



					<area shape="poly" alt="JENDOUBA" coords="69,23,66,25,59,26,57,28,59,31,59,34,55,36,48,37,50,42,46,47,36,54,35,54,35,55,40,55,44,58,46,59,52,57,67,56,74,53,77,51,78,49,75,40,71,34,73,28,70,23" href="recherche.php?region_recherche=JENDOUBA" title="JENDOUBA" onmouseover="javascript:changeImg('jandouba', 'tunisie');" id="jandouba" />

					<area shape="poly" alt="ZAGHOUAN" coords="120,49,115,53,113,61,110,65,107,69,113,72,114,77,120,76,129,79,136,72,140,70,142,67,144,64,141,59,138,56,128,49,126,49,124,46" href="recherche.php?region_recherche=ZAGHOUAN" title="ZAGHOUAN" onmouseover="javascript:changeImg('zagouan', 'tunisie');" id="zagouan" />

					<area shape="poly" alt="SOUSSE" coords="152,64,144,67,143,70,137,76,134,78,138,81,139,90,138,97,142,104,147,108,153,106,157,104,160,100,160,97,152,84,150,81,150,72,150,69" href="recherche.php?region_recherche=SOUSSE" title="SOUSSE" onmouseover="javascript:changeImg('sousse', 'tunisie');" id="sousse" />

					<area shape="poly" alt="MONASTIR" coords="151,109,156,107,160,105,161,101,167,100,169,104,172,106,176,108,177,109,177,110,172,111,168,113,154,113,150,109,151,108" href="recherche.php?region_recherche=MONASTIR" title="MONASTIR" onmouseover="javascript:changeImg('monastir', 'tunisie');" id="monastir" />

					<area shape="poly" alt="KEF" coords="46,62,60,60,68,60,71,58,73,69,78,78,79,83,75,96,75,100,65,96,58,95,54,103,49,101,42,103,39,102,38,101,42,80,43,72,46,63" href="recherche.php?region_recherche=KEF" title="KEF" onmouseover="javascript:changeImg('kef', 'tunisie');" id="kef" />

					<area shape="poly" alt="SILIANA" coords="75,56,73,58,77,71,84,81,78,95,77,101,78,103,89,108,94,113,97,112,95,107,89,101,89,98,94,99,95,99,98,96,99,94,101,85,109,80,113,77,112,74,106,72,104,67,109,64,111,60,109,56,106,58,100,56,95,59,90,63,85,61,80,61" href="recherche.php?region_recherche=SILIANA" title="SILIANA" onmouseover="javascript:changeImg('siliana', 'tunisie');" id="siliana" />

					<area shape="poly" alt="KAIROUAN" coords="93,102,97,106,103,119,107,125,114,135,123,138,128,143,132,138,138,134,136,119,141,108,141,105,138,102,135,94,137,87,137,82,135,80,133,80,132,82,125,80,119,79,115,80,112,81,106,87,102,87,102,93,103,96,102,98,99,100,98,102" href="recherche.php?region_recherche=KAIROUAN" title="KAIROUAN" onmouseover="javascript:changeImg('kairouan', 'tunisie');" id="kairouan"/>
					<area shape="poly" alt="MAHDIA" coords="142,109,140,116,139,121,139,125,141,133,146,135,153,134,157,131,162,127,167,127,170,128,172,134,173,137,174,135,179,137,180,137,184,133,183,132,178,127,178,120,179,119,179,113,177,112,174,112,170,115,154,115,149,110" href="recherche.php?region_recherche=MAHDIA" title="MAHDIA" onmouseover="javascript:changeImg('mehdia', 'tunisie');" id="mehdia"/>
					<area shape="poly" alt="SFAX" coords="177,138,176,145,172,149,171,154,161,169,156,172,155,176,148,178,144,183,136,185,128,195,126,198,118,196,113,195,108,192,116,192,117,189,112,185,121,184,133,175,130,170,120,167,119,164,126,156,131,145,137,138,141,135,144,138,150,137,158,134,161,130,164,129,169,129,170,136,171,139,173,139,176,137" href="recherche.php?region_recherche=SFAX" title="SFAX" onmouseover="javascript:changeImg('sfax', 'tunisie');" id="sfax"/>
					<area shape="poly" alt="KASSERINE" coords="42,106,45,119,42,127,48,132,45,142,41,150,40,156,41,159,49,164,51,164,55,161,64,160,70,154,76,152,77,147,83,140,88,139,88,132,82,128,82,125,90,119,91,116,91,112,76,104,69,100,64,97,58,98,56,104,56,106,52,106,48,103,43,104" href="recherche.php?region_recherche=KASSERINE" title="KASSERINE" onmouseover="javascript:changeImg('kasserine', 'tunisie');" id="kasserine"/>
					<area shape="poly" alt="SIDI BOUZIDE" coords="95,115,92,120,85,125,84,127,90,132,90,141,84,143,82,143,78,149,78,160,83,162,88,164,91,163,92,167,91,171,95,174,96,174,100,177,104,180,104,182,106,185,105,190,109,190,114,190,114,189,109,184,115,182,121,181,130,175,129,173,121,169,118,168,117,164,125,154,127,146,123,143,121,139,112,136,103,126,99,124,98,115" href="recherche.php?region_recherche=SIDI BOUZID" title="SIDI BOUZID" onmouseover="javascript:changeImg('sidi-bouzide', 'tunisie');" id="sidi-bouzide"/>
					<area shape="poly" alt="GAFSA" coords="41,163,38,173,27,182,31,189,38,194,43,197,55,200,74,198,78,193,88,193,93,190,97,192,100,191,103,190,103,184,96,175,92,175,88,170,89,167,85,166,74,162,75,155,71,157,66,161,64,162,57,163,54,164,50,167,42,163,41,162,40,163" href="recherche.php?region_recherche=GAFSA" title="GAFSA" onmouseover="javascript:changeImg('gafsa', 'tunisie');" id="gafsa"/>
					<area shape="poly" alt="GABES" coords="92,192,90,193,92,200,91,208,96,223,105,229,106,231,105,235,108,238,117,249,128,246,136,243,148,232,135,223,128,214,126,204,125,200,118,198,112,197,105,192,100,193,95,193,93,192" href="recherche.php?region_recherche=GABES" title="GABES" onmouseover="javascript:changeImg('gabes', 'tunisie');" id="gabes"/>
					<area shape="poly" alt="TOZEUR" coords="23,183,19,184,16,197,14,199,7,199,4,206,2,210,3,224,7,237,12,244,27,227,50,211,56,204,57,202,41,200,34,196,28,190,25,183" href="recherche.php?region_recherche=TOZEUR" title="TOZEUR" onmouseover="javascript:changeImg('tozeur', 'tunisie');" id="tozeur"/>
					<area shape="poly" alt="KEBILI" coords="60,202,56,208,28,230,13,243,13,255,14,258,20,259,31,264,42,282,43,297,43,298,53,291,69,286,80,287,103,283,111,277,118,279,123,284,127,286,124,277,127,274,126,267,123,263,125,255,120,252,115,251,105,238,103,238,100,234,104,232,98,229,92,219,88,209,89,200,88,195,80,195,78,196,75,200,60,201" href="recherche.php?region_recherche=KEBILI" title="KEBILI" onmouseover="javascript:changeImg('kebili', 'tunisie');" id="kebili"/>
					<area shape="poly" alt="MEDENINE" coords="164,217,170,217,174,220,178,221,172,227,167,225,166,226,163,230,160,238,160,241,163,244,169,242,174,239,174,235,174,234,180,236,181,248,184,257,186,261,190,260,203,263,202,271,200,276,201,294,204,299,203,305,198,309,192,311,193,303,198,297,198,294,190,286,190,269,184,262,168,255,165,250,148,253,140,257,136,257,128,262,126,263,127,254,120,250,132,249,142,241,149,233,157,232,161,229,163,228,164,225,165,222" href="recherche.php?region_recherche=MEDENINE" title="MEDENINE" onmouseover="javascript:changeImg('medenine', 'tunisie');" id="medenine"/>
					<area shape="poly" alt="TATAOUINE" coords="128,265,140,260,145,259,163,254,167,258,180,262,186,269,188,286,195,296,190,305,190,311,190,311,167,323,165,328,157,333,156,334,156,338,153,343,152,345,144,344,131,361,138,384,140,396,134,408,122,425,121,427,116,428,108,431,105,433,104,433,86,351,83,339,82,331,79,324,47,302,44,300,50,297,57,295,70,289,73,289,82,289,86,288,91,287,99,287,104,284,112,279,115,279,118,281,122,286,127,288,129,288,129,285,126,278,128,277,128,267" href="recherche.php?region_recherche=TATAOUINE" title="TATAOUINE" onmouseover="javascript:changeImg('tataouine', 'tunisie');" id="tataouine"/>-->
					<area shape="default" nohref="nohref" alt="" />
					</map>
					</div>
				  <!--///////////////////MAP////////////////-->
                </div>
      </div>
              <div class="bub_t"> <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="228" height="275" id="FlashID" title="publicite">
                  <param name="movie" value="flash/pub.swf" />
                  <param name="quality" value="high" />
                  <param name="wmode" value="opaque" />
                  <param name="swfversion" value="9.0.45.0" />
                  <!-- Cette balise <param> invite les utilisateurs de Flash Player en version 6.0 r65 et ultérieure à télécharger la version la plus récente de Flash Player. Supprimez-la si vous ne voulez pas que cette invite soit visible. -->
                  <param name="expressinstall" value="scripts/expressInstall.swf" />
                  <!-- La balise <object> suivante est destinée aux navigateurs autres qu'IE. Supprimez-la d'IE à l'aide d'IECC. -->
                  <!--[if !IE]>-->
                  <object type="application/x-shockwave-flash" data="flash/pub.swf" width="228" height="275">
                    <!--<![endif]-->
                    <param name="quality" value="high" />
                    <param name="wmode" value="opaque" />
                    <param name="swfversion" value="9.0.45.0" />
                    <param name="expressinstall" value="scripts/expressInstall.swf" />
                    <!-- Le navigateur affichera le contenu alternatif suivant pour les utilisateurs d'un lecteur Flash de version 6.0 ou de versions plus anciennes. -->
                    <div>
                      <h4>Le contenu de cette page nécessite une version plus récente d’Adobe Flash Player.</h4>
                      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obtenir le lecteur Adobe Flash" width="112" height="33" /></a></p>
                    </div>
                    <!--[if !IE]>-->
                  </object>
                  <!--<![endif]-->
                </object> </div>
              <div class="bub_tun"><a href="#"><img src="images/cv.gif" width="220" height="65" /></a>
        <div class="ombre_depo"><img src="images/ombre_bt.gif" width="220" height="20" /></div>
        <a href="contact.php"><img src="images/profe.gif" width="220" height="65" /></a>
        <div class="ombre_depo"><img src="images/ombre_bt.gif" width="220" height="20" /></div>
      </div>

            </div>
      <div class="clr"></div>      <!--<div id="pub_right" onClick="location.href='contact.php?obj=pub';"><img src="images/pub.jpg" /></div></div>-->
  </div>
  
        </div>
<div class="footer">
          <div class="FBG">
    <div class="FBG_resize">
              <div class="click_blog">
                <p>petites annonces gratuites en tunisie, tunisie immobilier, tunisie
            annonces, passer annonce gratuite, annonces algeriennes, petites
            annonces, passer une annonce, annonces immobilier, location, vente ,
            achat, maison, appartement, louer, vendre, acheter, location, immobilier, maison, locations de
            vacances en tunisie,</p>
        <div class="rss"><img src="images/twiter.gif" width="16" height="16" class="floated" /> <img src="images/fbicon.gif" width="16" class="floated" height="16" /> <img src="images/rss.gif" width="16" height="16" class="floated"/></div>
        <div class="clr"></div>
      </div>
              <div class="blog">
        <h2>Les catégories </h2>
        <div class="clr"></div>
        <ul style="float:left; width:150px; margin:0px 20px 0px 20px">
        <?php for($i=0;$i<$count_catm/2;$i++){ ?>
		<li>
     
			<a href="tunisie-annonce-recherche-tout-<?php echo $tab_catm[$i]["Id"]; ?>-<?php echo format_url($tab_catm[$i]["Category"])?>"><img src="images/row.png" border="0" />&nbsp;&nbsp;<?php echo htmlentities($tab_catm[$i]["Category"]);?></a>
			
		</li>
		<?php }?>
	</ul>

    <ul style="float:left; width:150px; margin:0px 20px 0px 20px">
        <?php for($i=$count_catm/2;$i<$count_catm;$i++){ ?>
		<li>
			<a href="tunisie-annonce-recherche-tout-<?php echo $tab_catm[$i]["Id"]; ?>-<?php echo format_url($tab_catm[$i]["Category"])?>"><img src="images/row.png" border="0" />&nbsp;&nbsp;<?php echo htmlentities($tab_catm[$i]["Category"]);?></a>
			</li>
		<?php }?>
		
		
	</ul>
        
      </div>

      <div class="blog1">
        <h2>Starannonces</h2>
        <div class="clr"></div>
        <ul>
                  <li><a href="aide.php">Comment ça marche</a></li>
                  <li><a href="flux_rss.php">Flus RSS</a></li>
                  <li><a href="#">Mentions Legales</a></li>
                  <li><a href="contact.php?objet=publicite">Publicité</a></li>
        </ul>
      </div>
              <div class="blog last">
        <h2>Contact</h2>
        <p>Phone: 71 459 369<br>
                  Fax: 71 459 369<br>
                  Site: <a href="#">www.benomedia.com</a><br>
                  Email: <a href="#">contact@benomedia.com</a><br>
                  Address: 51, rue palestine. </p>
      </div>
              <div class="clr"></div>
            </div>
  </div>
        </div>
<div class="footerbas">
          <div class="footer_resize">
    <p class="leftt">&copy; Copyright <a href="#">starannonces</a>. All Rights Reserved </p>
    <div class="clr"></div>
  </div>
        </div>

<script type="text/javascript" src="js/__.js"></script>
<!--//////////////////////ex-adsbook -> annonces stars//////////////////////////////-->
 <script type="text/javascript">
$(document).ready(function() {

            $(".signin").click(function(e) {          
				e.preventDefault();
                $("fieldset#signin_menu").toggle();
				$(".signin").toggleClass("menu-open");
            });
			
			$("fieldset#signin_menu").mouseup(function() {
				return false
			});
			$(document).mouseup(function(e) {
				if($(e.target).parent("a.signin").length==0) {
					$(".signin").removeClass("menu-open");
					$("fieldset#signin_menu").hide();
				}
			});			
			
        });
</script> 
<!-- The JavaScript -->
        
		<script type="text/javascript" src="jquery.easing.1.3.js"></script>
        <script type="text/javascript">
            $(function() {
                //caching
				//next and prev buttons
				var $cn_next	= $('#cn_next');
				var $cn_prev	= $('#cn_prev');
				//wrapper of the left items
				var $cn_list 	= $('#cn_list');
				var $pages		= $cn_list.find('.cn_page');
				//how many pages
				var cnt_pages	= $pages.length;
				//the default page is the first one
				var page		= 1;
				//list of news (left items)
				var $items 		= $cn_list.find('.cn_item');
				//the current item being viewed (right side)
				var $cn_preview = $('#cn_preview');
				//index of the item being viewed. 
				//the default is the first one
				var current		= 1;
				
				/*
				for each item we store its index relative to all the document.
				we bind a click event that slides up or down the current item
				and slides up or down the clicked one. 
				Moving up or down will depend if the clicked item is after or
				before the current one
				*/
				$items.each(function(i){
					var $item = $(this);
					$item.data('idx',i+1);
					
					$item.bind('click',function(){
						var $this 		= $(this);
						$cn_list.find('.selected').removeClass('selected');
						$this.addClass('selected');
						var idx			= $(this).data('idx');
						var $current 	= $cn_preview.find('.cn_content:nth-child('+current+')');
						var $next		= $cn_preview.find('.cn_content:nth-child('+idx+')');
						
						if(idx > current){
							$current.stop().animate({'top':'-300px'},600,'easeOutBack',function(){
								$(this).css({'top':'310px'});
							});
							$next.css({'top':'310px'}).stop().animate({'top':'5px'},600,'easeOutBack');
						}
						else if(idx < current){
							$current.stop().animate({'top':'310px'},600,'easeOutBack',function(){
								$(this).css({'top':'310px'});
							});
							$next.css({'top':'-300px'}).stop().animate({'top':'5px'},600,'easeOutBack');
						}
						current = idx;
					});
				});
				
				/*
				shows next page if exists:
				the next page fades in
				also checks if the button should get disabled
				*/
				$cn_next.bind('click',function(e){
					var $this = $(this);
					$cn_prev.removeClass('disabled');
					++page;
					if(page == cnt_pages)
						$this.addClass('disabled');
					if(page > cnt_pages){ 
						page = cnt_pages;
						return;
					}	
					$pages.hide();
					$cn_list.find('.cn_page:nth-child('+page+')').fadeIn();
					e.preventDefault();
				});
				/*
				shows previous page if exists:
				the previous page fades in
				also checks if the button should get disabled
				*/
				$cn_prev.bind('click',function(e){
					var $this = $(this);
					$cn_next.removeClass('disabled');
					--page;
					if(page == 1)
						$this.addClass('disabled');
					if(page < 1){ 
						page = 1;
						return;
					}
					$pages.hide();
					$cn_list.find('.cn_page:nth-child('+page+')').fadeIn();
					e.preventDefault();
				});
				
            });
        </script>
                
<!--/////////////////FIN/////ex-adsbook -> annonces stars//////////////////////////////-->
</body>
</html>
