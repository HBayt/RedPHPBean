<?php
session_start();
echo "<pre>";
var_dump($_SESSION); // Affiche toutes les variables de session pour le debugging
echo "</pre>";

if (isset($_SESSION["login"]) && $_SESSION["login"]) {
    echo "Session login is set.<br>";

    // Chemin relatif pour config.php
    echo "Including ../config.php<br>";
    if (file_exists('../config.php')) {
        require '../config.php';
        echo "config.php included successfully.<br>";
    } else {
        echo "config.php does not exist.<br>";
    }

    // Chemin relatif pour header.php
    echo "Including vue/partials/header.php<br>";
    if (file_exists('vue/partials/header.php')) {
        require 'vue/partials/header.php';
        echo "header.php included successfully.<br>";
    } else {
        echo "header.php does not exist.<br>";
    }

    // Chemin relatif pour connectdb.php
    echo "Including ../utils/connectdb.php<br>";
    if (file_exists('../utils/connectdb.php')) {
        include '../utils/connectdb.php';
        echo "connectdb.php included successfully.<br>";
    } else {
        echo "connectdb.php does not exist.<br>";
    }

    // Chemin relatif pour admin.php model
    echo "Including ../model/admin.php<br>";
    if (file_exists('../model/admin.php')) {
        require '../model/admin.php';
        echo "admin.php model included successfully.<br>";
    } else {
        echo "admin.php model does not exist.<br>";
    }

    // Chemin relatif pour nav.php
    echo "Including vue/partials/nav.php<br>";
    if (file_exists('vue/partials/nav.php')) {
        include 'vue/partials/nav.php';
        echo "nav.php included successfully.<br>";
    } else {
        echo "nav.php does not exist.<br>";
    }

    // Vérification de l'existence de la fonction getAdmin
    if (function_exists('getAdmin')) {
        $admin = getAdmin();
        echo "Admin data retrieved.<br>";
    } else {
        echo "Function getAdmin() does not exist.<br>";
    }

    // Vérification et traitement des données de formulaire
    if (isset($_POST['name']) && isset($_POST['password'])) {
        echo "Creating admin with name: " . htmlspecialchars($_POST['name']) . "<br>";
        createAdmin($_POST['name'], $_POST['password']);
        header("Refresh:0");
    }

    if (isset($_POST['id_admin'])) {
        echo "Deleting admin with ID: " . htmlspecialchars($_POST['id_admin']) . "<br>";
        deleteAdmin($_POST['id_admin']);
        header("Refresh:0");
    }

    // Chemin relatif pour admin.php view
    echo "Including vue/admin.php<br>";
    if (file_exists('vue/admin.php')) {
        include 'vue/admin.php';
        echo "admin.php view included successfully.<br>";
    } else {
        echo "admin.php view does not exist.<br>";
    }

    // Chemin relatif pour footer.php
    echo "Including vue/partials/footer.php<br>";
    if (file_exists('vue/partials/footer.php')) {
        require 'vue/partials/footer.php';
        echo "footer.php included successfully.<br>";
    } else {
        echo "footer.php does not exist.<br>";
    }
} else {
    echo "Redirecting to /admin/.<br>";
    header("Location: /admin/");
    exit();
}
?>
