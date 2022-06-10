<?php
session_start();
unset($_SESSION['logado']);
session_destroy();
echo '<script>location.href="../view/index.html";</script>';
