<?php
define("ROOT_PATH",str_replace('\\','/',realpath('./')));
define("_BASE_","http://localhost/demo/sp");
define("_PUB_","http://localhost/demo/sp/public");
define("_PUB_HOME_",_PUB_."/home");
define("_PUB_DEFAULT_",_PUB_."/default");
define("_HOME_URL_",_BASE_."/home.php");
define("IS_POST",$_SERVER['REQUEST_METHOD']);
define("_FILE_PHP_","http://127.0.0.1/web/");

define("REDIS",1);


//define("WATER_PIC","upload/water/water.png");
//define("_FILE_PATH_","http://files.zhoufup2p.com");
//define("_MALL_URL_",_BASE_."/mall");
//date_default_timezone_set('PRC');
//数据库配置见：admincation|application/config/database.php
