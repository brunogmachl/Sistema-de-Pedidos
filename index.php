<?php
@session_start();
// require_once("verificar.php");
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/view/html/header.php';

use App\Routes;

$teste = new Routes();

require __DIR__.'/view/html/footer.php';

?>