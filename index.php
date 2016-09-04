<?php
ini_set('display_errors', 1);
session_start();

/* For handling template files. */
include 'lib/class.templates.php';
$templates = new templates;

if (empty($_SESSION['id'])) {
    /* Authenciation required to generate a session key. */
    $front = 'front.html';
    $templates->Load($front);
    echo $front;
    unset($front);
    include 'lib/class.login.php';

    if (isset($_POST['username']) && isset($_POST['password'])) {

        if (!empty($_POST['username']) && !empty($_POST['password'])) {

            $login = new login($_POST['username'], $_POST['password']);

        }

    }

} else {

    /* After login this page will appear to the user. */
    include 'lib/class.filefunctions.php';
    $filepage1 = 'filepage1.html';
    $templates->Load($filepage1);
    echo $filepage1;
    unset($filepage1);
    include 'lib/class.delete.php';

    /* The class for viewing folders and files and perform all file. */
    $filefunctions = new filefunctions;

    if (isset($_POST['directory'])) {

        if (!empty($_POST['directory'])) {
            /* This function shows a list of files. */
            $directory = $_POST['directory'];
            $_SESSION['dir'] = $directory;
        }

    } else {

        $directory = '../';

    }

    $filefunctions->viewfile($directory);

    $filepage2 = 'filepage2.html';
    $templates->Load($filepage2);
    echo $filepage2;
    unset($filepage2);

    if (!empty($_POST['delete'])) {

        $delete = new delete($_POST['delete']);

    }

}
