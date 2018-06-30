<?php
require 'steamauth/SteamConfig.php';
require 'prod.php';
session_name('NMCORE');
session_start();
session_unset();
session_destroy();
header('Location: '.$redirecturl);
exit;

?>
