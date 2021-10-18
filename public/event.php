<?php

use Date\Events;

require '../src/bootstrap.php';
require '../src/Date/Events.php';
require '../views/header.php';
$pdo = get_pdo();
$events = new Events($pdo);
if (!isset($_GET['id'])) {
    header('location: /404.php');
}
$event = $events->find($_GET['id']);
?>

<h1></h1>

<?php
require '../views/footer.php';
?>