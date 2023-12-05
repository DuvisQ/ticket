<?php
header("HTTP/1.1 301 Moved Permanently");
require_once ("./common/general.php");
require_once ("./common/db.php");
header("location:app/view/index.php");
