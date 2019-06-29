<?php
  header('Location: ../../' . substr(getcwd(), strrpos(getcwd(),'/') + 1), true, 301);
  exit();
?>