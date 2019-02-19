<?php
$autoloader = function($full_class_name) {
        // on prépare le terrain : on remplace le séparteur d'espace de nom par le séparateur de répertoires du système
        $name = str_replace('\\', DIRECTORY_SEPARATOR, $full_class_name);
        // on construit le chemin complet du fichier à inclure :
        // il faut que l'autoloader soit toujours à la racine du site : tout part de là avec __DIR__
        $path = __DIR__.DIRECTORY_SEPARATOR.$name.'.php';
     
        // on vérfie que le fichier existe et on l'inclut
        // sinon on passe la main à une autre autoloader (return false)
        if (is_file($path)) {
            include $path;
        } else {
            return false;
        }
    };
     
    spl_autoload_register($autoloader);

    ?>