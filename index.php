<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>Wapt Dépôt</title><link rel="stylesheet" href="style.css" type="text/css" media="screen"><meta http-equiv="content-type" content="text/html; charset=utf-8"><link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"></head>
<body>
<div style="text-align: center;">
<table style="text-align: left; width: 750px; margin-left: auto; margin-right: auto; height: 863px; background-color: white;" border="0" cellpadding="0" cellspacing="0">


    <tbody><tr>
      <td style="vertical-align: top;">

<script>
function _(el){
	return document.getElementById(el);
}
function uploadFile(){
	var file = _("file1").files[0];
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("file1", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "file_upload_parser.php");
	ajax.send(formdata);
}
function progressHandler(event){
	_("loaded_n_total").innerHTML = "Téléchargement de "+event.loaded+" bytes sur "+event.total+ " bytes";
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	_("status").innerHTML = Math.round(percent)+"% Téléchargement... Merci de patienter";
}
function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	_("progressBar").value = 0;
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}
</script>

   


<b>


</b><div style="text-align: left;">
<table style="text-align: center; width: 900px; margin-left: auto; margin-right: auto; height: 863px; background-color: white;" border="0" cellpadding="0" cellspacing="0">


  <tbody>
    <tr>
      <td style="vertical-align: top; width: 300px;">
      <div style="text-align: center; background-color: white;">

<br>
<br>
<div style="text-align: center;"><img alt="" src="/wiki.png" style="color: rgb(0, 0, 0); font-family: 'Arial'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-align: center; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; width: 135px; height: 105px;"><span style="color: rgb(0, 0, 0); font-family: 'Arial'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-align: center; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; display: inline ! important; float: none;"><span class="Apple-converted-space"> </span></span><br style="color: rgb(0, 0, 0); font-family: 'Arial'; font-size: medium; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-align: center; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px;">
      </div>

<br>
   <span style="color: rgb(0, 0, 0); font-size: medium; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; text-align: center; text-indent: 0px; text-transform: none; white-space: normal; word-spacing: 0px; font-family: Arial; font-weight: bold;"><a href="/wapt/?C=M;O=D" style="color: rgb(102, 51, 51);">https://user:password@wapt.reseaux85.fr/wapt</a></span><br>

      <div class="" style="text-align: center; background-color: white;">
<br>

<br>
<br>
<b>
Transfère de fichier wapt vers le dépôt:</b>
 <br> 
<br>

<form id="upload_form" enctype="multipart/form-data" method="post">
  <input name="file1" id="file1" type="file"><br>
<br>
  <input value="Envoyer" onclick="uploadFile()" type="button">
  <progress id="progressBar" value="0" max="100" style="width: 300px;"></progress>
  <h3 id="status"></h3>
  <p id="loaded_n_total"></p>
</form>


<br>

<div style="text-align: left; background-color: white;">
<div style="text-align: left;">
<br>
<?php 

setlocale (LC_TIME, 'fr_FR.utf8','fra');
echo '<fieldset><legend><b>Supression et téléchargement de fichier wapt du dépôt</b></legend><br>';

$adresse = "./wapt/";
if(isset($_GET['nom']))
{
     $nom=''.$adresse.$_GET['nom'].'';
     $elementsChemin = pathinfo($nom);
     $extensionFichier = $elementsChemin['extension'];
     $extensionsAutorisees = array("wapt");
     if ((in_array($extensionFichier, $extensionsAutorisees))) {
          unlink($nom);
          exec("/usr/bin/python /opt/wapt/wapt-scanpackages.py ./wapt/");
          echo '<b><FONT color="red">Le fichier "'.$_GET['nom'].'" a été éffacé !</FONT></b></a><br><br>';
          echo "La regénération du fichier Packages a été lancée, cela peut prendre plusieurs minutes ...<br><br>";
          sleep(1);
          echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
     }
}
chdir($adresse);
array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
foreach($files as $Fichier)
{

     $elementsChemin = pathinfo($Fichier);
     $extensionFichier = $elementsChemin['extension'];
     $extensionsAutorisees = array("wapt");

     if ((in_array($extensionFichier, $extensionsAutorisees))) {


     $datemodify = date ("d/m/Y H:i", filemtime($Fichier));

$taille=filesize($Fichier);
if ($taille >= 1073741824)
{$taille = round($taille / 1073741824 * 100) / 100 . " Go";}
elseif ($taille >= 1048576)
{$taille = round($taille / 1048576 * 100) / 100 . " Mo";}
elseif ($taille >= 1024)
{$taille = round($taille / 1024 * 100) / 100 . " Ko";}
else
{$taille = $taille . " o";}

if($taille==0) {$taille="-";}
  echo '<div style="text-align:left;"> <a id="mybutton" href="/wapt/'.$Fichier.'" title="Télécharger"><button>Télécharger</button></a>                     <a id="mybutton" href="index.php?nom='.$Fichier.'" onclick="return(confirm(\'Voulez vous confirmez la supression de '.$Fichier.' ?\'))"   ><button>Supprimer</button></a>               <a target="_blank">'.$Fichier.'</a></div>  <div style="text-align:right;"><FONT color="grey"><a target="_blank">'.$taille.'</a>&nbsp; |    <a target="_blank">'.$datemodify.'&nbsp;</a></FONT></div><br>';

                                                               }



     }
echo '<br></fieldset>';


?>
<br>

<br>
</div>

</div>
      </div></div></td>
    </tr>
  </tbody>

</table>
<b><br>
</b>
  </div></td></tr></tbody></table></div></body></html>
