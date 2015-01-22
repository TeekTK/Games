<?php

class db
{
	//public static function addTwoNumbers($numberOne,$numberTwo)
	//{
	//	return $numberOne+$numberTwo;
	//}

	public static function open()
	{
		//start of opening database

		$servername = '192.168.0.25';
		$username = 'isarc';
		$password = '1s4rcLimited';
		$defaultSchema = 'Thomas';

		$link = new mysqli($servername, $username, $password, $defaultSchema);

		if($link -> errno)
		{
			die('Connection to database failed -'.$link -> error);
		}
	
		$link -> set_charset('utf-8');
		//end of opening database connection
		return $link;
	}

	
}

