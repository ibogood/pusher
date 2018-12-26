<?php
spl_autoload_register(function($className){
    include_once str_replace('/',DIRECTORY_SEPARATOR,'src/'.$className.'.php');
});