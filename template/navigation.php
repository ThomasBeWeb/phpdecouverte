<?php
//Barre de navigation

//Dossier racine
//$homedir = "http://php-decouverte.bwb/";
$homedir = "http://localhost:8888/phpdecouverte/";

//recup de la liste des fichiers du dossier content
$fichiers = scandir("/Users/utilisateur/MesApps/phpdecouverte/contents/");

//Creation de la liste de fichiers sous la forme: nom du lien => lien
$listeFichiers = array("home" => $homedir);

foreach($fichiers as $value){
    
      if($value !== "." AND $value !== ".."){     //Verifie si pas "." ou ".."
          
          //recup du nom du lien: nom du fichier sans .php
          $name = explode(".php", $value);
          $listeFichiers[$name[0]] = $homedir."?page=".$name[0];
      }
}
?>

<div class="d-flex flex-row">
    <?php
    //Boucle sur la liste des fichiers et affiche
    
    foreach($listeFichiers as $key => $value){
        ?>
            <div class="p-2">
                <a href=<?=$value;?>><?=$key;?></a>
            </div>
         <?php
    }
 ?>
</div>