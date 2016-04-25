<?php
$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
$elementsChemin = pathinfo($fileName);
$extensionFichier = $elementsChemin['extension'];
$extensionsAutorisees = array("wapt");
if (!$fileTmpLoc) { // if file not chosen
    echo "Erreur : Merci de selectionner un fichier avant de cliquer sur le bouton de t�l�chargement ";
    exit();
}
if (!(in_array($extensionFichier, $extensionsAutorisees))) {
   echo "ERREUR : Le fichier n'est pas un fichier wapt ou le fichier est trop gros";
   exit();
}
if(move_uploaded_file($fileTmpLoc, "wapt/$fileName")){
    echo "Le fichier wapt ".$fileName. " a �t� t�l�charg� dans le d�p�t";
    echo "<br><br>Reg�n�ration du fichier Packages en cour ...";
    exec("/usr/bin/python /opt/wapt/wapt-scanpackages.py ./wapt/");
    echo "<br><br>Reg�n�ration du fichier termin�e";
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

} else {
    echo "Echec du d�placement du fichier ";
}
?>
