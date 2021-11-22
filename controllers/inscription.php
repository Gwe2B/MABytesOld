<?php

//TODO: Add the flash messages

if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) &&
isset($_POST['pwd']) && isset($_POST['cpwd'])) {
    if(!(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) ||
    empty($_POST['pwd']) || empty($_POST['cpwd']))) {
        if($_POST['pwd'] === $_POST['cpwd']) {
            $usr = new MABytes\User();
            $usr->setNom(htmlspecialchars($_POST['nom']));
            $usr->setPrenom(htmlspecialchars($_POST['prenom']));
            $usr->setEmail(htmlspecialchars($_POST['email']));
            $pwd = htmlspecialchars($_POST['pwd']);

            MABytes\UserManager::getInstance($bdd)->createUser($usr, $pwd);
            header('Location: /');
        }
    }
}