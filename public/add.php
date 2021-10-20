<?php
require '../src/bootstrap.php';


$data = [
    'date' => $_GET['date'] ?? date('Y-m-d')
];

$validator = new \App\Validator($data);
if (!$validator->validate('date', 'date')) {
    $date['date'] = date('Y-m-d');
}
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $validator = new Date\EventValidator();
    $errors = $validator->validates($data);
    if (empty($errors)) {
        $events = new \Date\Events(get_pdo());
        $event = $events->hydrate(new \Date\Event(), $data);
        $events->create($event);
        header('Location:/index?success=1');
        exit();
    }
}
render('header', ['title' => 'Ajouter un événement']);
?>


<div class="container">
    <?php
    if (!empty($errors)) :
    ?>
        <div class="alert alert-danger">
            Merci de bien corriger vos erreurs
        </div>
    <?php endif; ?>
    <h1>Ajouter un événement</h1>

    <form action="" method="POST" class="form">
        <?php render('calendar/form', ['data' => $data, 'errors' => $errors]); ?>
        <div class="form-group">
            <button class="btn btn-primary">Ajouter l'évènement</button>
        </div>
    </form>
</div>

<?php

use Date\EventValidator;

render('footer');
?>