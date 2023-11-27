<?php
require "../vendor/autoload.php";

$app = new Slim\Slim();
$plates = new League\Plates\Engine("../views");

$app->get("/", function () use ($plates) {
    echo $plates->render("main");
});

$app->get("/version", function () use ($plates, $app) {
    $app->response()->header("Content-Type", "application/json");
    echo file_get_contents("../version.json");
});

$app->get("/compose.yaml", function () use ($plates, $app) {
    $app->response()->header("Content-Type", "application/yaml");
    $port = $app->request()->get("port", 5001);
    $stacksPath = $app->request()->get("stacksPath", "/opt/stacks");
    echo <<< YAML
version: "3.8"
services:
  dockge:
    image: louislam/dockge:1
    restart: unless-stopped
    ports:
      - ${port}:5001
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
      - ./data:/app/data
      # ⚠️ Left Stacks Path === Right Stacks Path (MUST)
      - ${stacksPath}:${stacksPath}
    environment:
      # Tell Dockge where to find the stacks
      - DOCKGE_STACKS_DIR=${stacksPath}

YAML;
});

$app->run();
