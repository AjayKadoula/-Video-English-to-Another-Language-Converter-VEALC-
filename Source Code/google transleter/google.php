<?php

require_once ('vendor/autoload.php');
use \Statickidz\GoogleTranslate;
 
$source = 'en';
$target = 'hi';
$text = ' This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo  This is demo ';
 
$trans = new GoogleTranslate();
$result = $trans->translate($source, $target, $text);
 
echo $result;

?>