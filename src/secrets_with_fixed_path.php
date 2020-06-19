<?php
  $secret = file_get_contents("/run/secrets/qc_password");
  echo $secret . PHP_EOL;
?>
