<!DOCTYPE html>
<html>
<head>
	<title> PHP Home </title>
</head>
<body>

	<?Php

		echo "Hello World <br />";

		if(isset($_GET['start']) && isset($_GET['end']))//This is typed into the querystring
		{
			$start=$_GET['start'];
			$end=$_GET['end'];

			//echo $_GET['start'] . ' ' . $_GET['end'];
		}
		elseif(isset($_POST['txtStart']) && isset($_POST['txtEnd']))//This is from the form the being submitted
		{
			$start=$_POST['txtStart'];
			$end=$_POST['txtEnd'];
		}
		else //This is everything else
		{
			echo 'This Page requires you to input a start and end value <br />';
			$start=1;
			$end=10;
		}

		for($i=$start; $i <= $end; $i++)
		{
		//	echo $i . '<br />';
		}

		$i = $start;
		while($i <= $end)
		{
			switch($i)
			{
				case 3:
					echo 'I am number three';
					$i++;

				default:
					echo $i++;
			}
			echo '<br />';
		}

		//phpinfo();

	?>

	<form method='post'>

		Start 
		<input type='text' id='txtStart' name='txtStart' />

		<br /><br />
		
		End 
		<input type='text' id='txtEnd' name='txtEnd' />
		
		<br /><br />

		<input type='submit' id='btnSubmit' name='btnSubmit' value='Generate' />
		




		

	</form>



</body>
</html>