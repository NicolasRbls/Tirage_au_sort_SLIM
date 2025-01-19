<?php

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

session_start(); // Démarrer une session PHP

$app = AppFactory::create();

// Initialiser la liste des étudiants dans la session
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

// Route : page principale
$app->get('/', function (Request $request, Response $response, $args) {
    $html = file_get_contents(__DIR__ . '/templates/index.html');
    $response->getBody()->write($html);
    return $response->withHeader('Content-Type', 'text/html');
});

// Route : ajouter un étudiant
$app->post('/add_student', function (Request $request, Response $response, $args) {
    $data = json_decode($request->getBody()->getContents(), true);
    $name = trim($data['name'] ?? '');

    if (empty($name)) {
        $response->getBody()->write(json_encode(['error' => "Le nom de l'étudiant ne peut pas être vide."]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    if (in_array($name, $_SESSION['students'])) {
        $response->getBody()->write(json_encode(['error' => 'Cet étudiant est déjà dans la liste.']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    $_SESSION['students'][] = $name;
    $response->getBody()->write(json_encode(['message' => 'Étudiant ajouté avec succès.', 'students' => $_SESSION['students']]));
    return $response->withHeader('Content-Type', 'application/json');
});

// Route : obtenir la liste des étudiants
$app->get('/get_students', function (Request $request, Response $response, $args) {
    $response->getBody()->write(json_encode(['students' => $_SESSION['students']]));
    return $response->withHeader('Content-Type', 'application/json');
});

// Route : tirer un étudiant
$app->post('/pick_student', function (Request $request, Response $response, $args) {
    if (empty($_SESSION['students'])) {
        $response->getBody()->write(json_encode(['error' => 'La liste des étudiants est vide.']));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
    }

    $chosen_student = $_SESSION['students'][array_rand($_SESSION['students'])];
    $_SESSION['students'] = array_values(array_diff($_SESSION['students'], [$chosen_student]));

    $response->getBody()->write(json_encode(['chosen_student' => $chosen_student, 'remaining_students' => $_SESSION['students']]));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
