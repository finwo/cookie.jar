#!/usr/bin/env php
<?php

// Get cookie jar
$contents = file_get_contents(__DIR__ . '/jar.txt');

// Convert all newlines to unix
$contents = str_replace("\r\n","\n",$contents);
$contents = str_replace("\r","\n",$contents);

// Display one cookie
$cookies = explode("\n\n", $contents);
print(array_rand($keys));
