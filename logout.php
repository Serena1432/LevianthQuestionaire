<?php
setcookie("LevianthAccessToken", "", time() - 3600, "/");
header("Location: ./");
?>