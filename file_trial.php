<?php
	
	$redis = new Redis() or die("Cannot load Redis module.");
	$redis->connect('127.0.0.1');

	//include domain here starting with "."
	$cookie_domain = 'localhost/evoke';
	 
	//unique visitor timeframe in seconds
	$unique_timeframe = 1800;
	 
	//track a unique visitor
	$unique = FALSE;
	 
	//set initial visitor cookie
	if (!isset($_COOKIE['vst'])) {
	        setcookie("vst", 1, time() + $unique_timeframe, "/", $cookie_domain);
	        $unique = TRUE;
	}
	 
	//set time variables
	$day = date('Y-m-d');
	$day_hour = date('Y-m-d:G');
	 
	//get handle to Predis client
	try {
	        $redis = new Redis();
	        $redis->connect('127.0.0.1');
	} catch (Exception $e) {
	        die("Cannot load Redis module.");
	}
	 
	//track pageviews
	$redis->incr('pageviews-by-day:' . $day);
	 
	if ($unique) {
	        //track unique visitors
	        $redis->incr('uniques-by-day:' . $day);
	}

	$date = date('Y:m:d', $_SERVER['REQUEST_TIME']);

	$redis->incr($date.':visitors');
	$redis->sadd($date.':uniqueVisitors', $user_ip);
	$redis->sadd($date.':uniqueVisitorsID', $user_id);
	
	var_dump($redis->get($date.':visitors'));
	var_dump($redis->scard($date.':uniqueVisitors'));
	//output appropiate headers and serve pixel
	// $pixel = '1x1.gif';
	// header('Content-Length: ' . filesize($pixel));
	// header('Content-Type: image/gif');
	// header("Cache-Control: no-cache, must-revalidate");
	// header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	// print file_get_contents($pixel);

	/* Multiple redis functions for seeing what's inside */

	// $redis->sAdd('myset', 'item1');
	// $redis->sAdd('myset', 'item2');
	// $redis->sAdd('myset', 'item3');
	 
	// var_dump($redis->sContains('myset', 'item1')); // true
	// var_dump($redis->sContains('myset', 'item4')); // false
	 
	// var_dump($redis->sSize('myset'));
	 
	// var_dump($redis->sMembers('myset'));
	 
	// $redis->sAdd('myset2', 'item2');
	// $redis->sAdd('myset2', 'item3');
	// $redis->sAdd('myset2', 'item4');
	 
	// var_dump($redis->sDiff('myset','myset2'));
	// var_dump($redis->sUnion('myset','myset2'));
	// var_dump($redis->sInter('myset','myset2'));


	/* Inserting mutiple keys and values -- Hashmaps or Hash: It’s a key/value map stored under a distinct id. For example a user with the key user-1 can have a key/value map with {name:’derfichtl’, ‘email’:'test@test.at’} */

	// $redis->hSet('user-derfichtl', 'username', 'derfichtl');
	// $redis->hSet('user-derfichtl', 'email', 'derfichtl[AT]gmail.com');
	// $redis->hSet('user-derfichtl', 'name', 'Michael Feichtinger');
	 
	// or so:
	 
	$redis->hMset('user-derfichtl', array('username'=>'derfichtl', 'email'=>'derfichtl@gmail.com', 'name'=>'Michael Feichtinger')); // user-derfichtl is the key and username, email and name are keys for map
	$redis->hMset('user-derfichtl2', array('username'=>'johannes', 'email'=>'johannes@gmail.com', 'name'=>'Johannes Feichtinger'));

	// reading
	 
	foreach($redis->hKeys('user-derfichtl') as $key) {
	    //var_dump($key.': '.$redis->hGet('user-derfichtl', $key)); // prints the key/value map from 'user-derfichtl'
	}
	 
	// or so:
	 
	// var_dump($redis->hVals('user-derfichtl')); // prints the array
	// var_dump($redis->hGetAll('user-derfichtl')); // prints the array by key
	 
	//if($redis->hExists('user-derfichtl', 'name')) {
	    //var_dump($redis->hGet('user-derfichtl', 'name')); //get single
	//}

	$redis->publish('notifs', $redis->hGet('user-derfichtl', 'name'));
	$redis->publish('notifs', $redis->hGet('user-derfichtl2', 'name'));

	$redis->lpush('hashed', 'user-derfichtl');
	$redis->lpush('hashed', 'user-derfichtl2');

	// $yay = 0;

	// $redis->lpush($yay.'a', 'yep');
	// $redis->lpush($yay.'a', 'derfichtl@gmail.com');

	// var_dump($yay.'a');
	var_dump($redis->llen('hashed'));
	// var_dump($redis->llen($yay.'a'));
	// var_dump($redis->lrange($yay.'a', 0, 200));

	/* Simple insertions */

	// $redis->set('random', rand(5000,6000));
	// var_dump($redis->get('random'));

	// OR
	 
	// $redis->set('hello', 'world');
	// $retval = $redis->get('hello');
	 
	// var_dump($retval);


