<?php
	
	require 'db.php';

	//start of opening database
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$link=db::open();

		//start of insert
		$title = $_POST['txtTitle'];
		
		if(empty($_POST['lstRating']))
		{
			$rating = NULL;
		}
		else
		{
			$rating = $_POST['lstRating'];
		}

		if(empty($_POST['lstDeveloper']))
		{
			$developer = NULL;
		}
		else
		{
			$developer = $_POST['lstDeveloper'];
		}

		if(empty($_POST['lstPublisher']))
		{
			$publisher = NULL;
		}
		else
		{
			$publsiher = $_POST['lstPublisher'];
		}
		
		


		$sql = "INSERT INTO 
					Games (Title, Rating, Developer, Publisher) 
				VALUES 
					(?,?,?,?)";

		$stmt = $link -> prepare ($sql);
		$stmt -> bind_param('siii', $title, $rating, $developer, $publisher);

		if($stmt -> execute())
		{
			//echo 'Inserted - The new record has an ID of' .$stmt -> insert_id;
			header("location:listgames.php?n=" . $stmt -> insert_id); // 
		}
		else
		{
			echo'welp... thats an error';
		}

		$stmt -> close();
		//end of insert

		//start of class database
		$link -> close();
		//end of class database

	}//close request method

	$link = db::open();

		//Developers
		$sql = "SELECT
					Developers.DeveloperID,
	    			Developers.Title
				FROM Developers";

		$stmt = $link -> prepare($sql);
		$stmt -> bind_result($developerID, $developerTitle);
		$stmt -> execute();
		$developers='';

		while($stmt -> fetch())
		{
			$developers .= "<option value='$developerID'>$developerTitle</option>";
		}

		$stmt -> close();


		//Publishers
		$sql = "SELECT
					Publishers.PublisherID,
	    			Publishers.Title
				FROM Publishers";

		$stmt = $link -> prepare($sql);
		$stmt -> bind_result($publisherID, $publisherTitle);
		$stmt -> execute();
		$publishers='';

		while($stmt -> fetch())
		{
			$publishers .= "<option value='$publisherID'>$publisherTitle</option>";
		}

		$stmt -> close();

	$link -> close();
?>

<!DOCTYPE html>
<html>

	<head>

		<title>

			New Game

		</title>

		<style type="text/css">

			html,body
    		{
				margin: 0;
				padding: 0;
			}

		</style>

	</head>

	<body>


		<?php require 'title.php'; ?>
		

		<p>Add Game:</p>

		<form method='post'>

			Name:<input type='text' name='txtTitle' id='txtTitle'/>
			<br />

			Rating:<select name='lstRating' id='lstRating'/> <!-- Drop down list-->
				<option value=''>none</option>
				<option value='1'>1</option>
				<option value='2'>2</optoin>
				<option value='3'>3</option>
				<option value='4'>4</option>
				<option value='5'>5</option>
			</select>

			<br/>

			Developer:<select name='lstDeveloper' id='lstDeveloper'>

				<option value=''>none</option>
				<?=$developers ?>

			</select>

			<br/>

			Publisher:<select name='lstPublisher' id='lstPublisher'>

				<option value=''>none</option>
				<?=$publishers ?>

			</select>

			<br />
			<br />

			<input type='submit' id='btnSubmit' name='btnSubmit' value='Add Game'/>



		</form>

	</body>

</html>