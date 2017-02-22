#!/usr/bin/env php
<?php

// Get cookie jar
$contents = file_get_contents(__DIR__ . '/jar.txt');

// Convert all newlines to unix
$contents = str_replace("\r\n","\n",$contents);
$contents = str_replace("\r","\n",$contents);

// Seperate cookies
$cookies = explode("\n\n", $contents);

// Load usage
touch(__DIR__.'/usage.json');
$usage = json_decode(file_get_contents(__DIR__.'/usage.json'),true);
if(is_null($usage)) {
  $usage = array();
}

// Make sure we have a current version
if(count($usage)!=count($cookies)) {
  $usage = array_fill(0, count($cookies), 0);
}

// Fetch the least used count
$minimum = -1;
foreach($usage as $cnt) {
  if( $minimum==-1 || $cnt<$minimum ) {
    $minimum = $cnt;
  }
}

// Keep numbers low
if($minimum>0) {
  $usage = array_map(function($c){return $c-1;}, $usage);
  $minimum -= 1;
}

// Fetch possible keys
$keys = array();
foreach($usage as $key => $cnt) {
  if($cnt==$minimum) {
    array_push($keys,$key);
  }
}

// Pick a random one
$key = array_rand($keys);

// Increment usage
$usage[$key] += 1;

// Output cookie
echo $cookies[$key], PHP_EOL;

// Save usage
file_put_contents(__DIR__.'/usage.json',json_encode($usage));
