<?php
require "../vendor/autoload.php";

$app = new Slim\Slim();
$plates = new League\Plates\Engine("../views");

$app->get("/", function () use ($plates) {
    echo $plates->render("main");
});

$app->run();
