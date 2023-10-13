<?php

print_r($_SESSION['user']) .br;

$s = "  hi my name is 323 dd--~`'cd'']}f>< ابراهيم سلطان ";

echo $s .br;
echo slug_creater($s) .br;

$s =  "<h1>hi</h1>";
echo esc($s) .br;
echo ($s) .br;