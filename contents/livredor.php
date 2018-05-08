<?php

//Recup des messages
$json_source = file_get_contents('http://php-decouverte.bwb/template/messages.json');
$listeMessages = json_decode($json_source, true);

if($_SESSION){
     $user = $_SESSION['login'];
}else{
    header("location: ./connexion.php");
}

if ($_POST) {
    //Recup des infos
    $dateMessage = date("d/m/Y H:i");
    $user = $_POST['login'];
    $message = $_POST['message'];

    //Determiner le nouvel ID
    $newID = end($listeMessages)['id'] + 1;

    //Creation du post au format tableau
    $postTableau = ['id' => $newID, 'user' => $user, 'date' => $dateMessage, 'message' => $message];

    //Integration au tableau en cours
    array_push($listeMessages, $postTableau);

    //Conversion au format JSON
    $listePostsJson = json_encode($listeMessages, JSON_PRETTY_PRINT); //This parameter will format our JSON object and store it in json file
    
    //Recup du fichier d'origine
    $file = "/home/cantinelli/ServeurWeb/php-decouverte.bwb/template/messages.json";    //chmod 777 -R template/ effectué
    
    //Ecrire la nouvelle liste dans le fichier messages.json
    file_put_contents($file, $listePostsJson);

};
?>

<div class="row">

    <form class="form" action="http://php-decouverte.bwb/?page=livredor" role="form" method="post">
        <div class="input-group mb-3 col-auto">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Message</span>
            </div>
            <input type="text" class="form-control text-center" id="message" name="message" aria-label="pwd"
                   aria-describedby="basic-addon1" style="max-width: 200px">
        </div>

        <button type="submit" class="btn btn-outline-success">Publier</button>
    </form>
</div>
<br>
<!-- Affichage des messages-->
<div class="d-flex flex-column-reverse">
<?php
foreach ($listeMessages as $object) {
    ?>
        <div class="p-2">
            <h4><?= $object['user']; ?> </h4>
            <h6><i><?= $object['date']; ?></i></h6>
            <h5><?= $object['message']; ?> </h5>
        </div>
    <?php
}
?>
</div>