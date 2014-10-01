<?php
//echo "hello";
$redis = new Redis() or die("Cannot load Redis module.");
$redis->connect('gabriela');
$redis->set('random', rand(5000,6000));
echo $redis->get('random');