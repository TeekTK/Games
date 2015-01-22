<?php
	
	require 'db.php';

	//echo db::addTwoNumbers(4,6);

		//start of insert

		$link = db::open();


		$sql = "SELECT
					Games.GameID,
					Games.Title,
    				Games.Rating,
    				Publishers.Title AS Publisher,
    				Developers.Title AS Developer
				FROM Games
				LEFT JOIN Publishers ON Games.Publisher=Publishers.PublisherID
				LEFT JOIN Developers ON Games.Developer=Developers.DeveloperID
				";

		$stmt = $link -> prepare ($sql);

		//$stmt -> bind_param('si', $title, $rating);

		$stmt -> bind_result($gameID,$title,$rating,$developer,$publisher);

		$stmt -> execute();

		$tbl = '';

		while($stmt -> fetch())
		{
			if(isset($_GET['n']) && $_GET['n'] == $gameID)
			{
				$tbl .= "<tr class='new' onclick='document.location.href=\"edit.php?gameid=$gameID\";'>";
			}
			else
			{
				$tbl .= "<tr onclick='document.location.href=\"edit.php?gameid=$gameID\";'>";
			}
			
			$tbl .= "<td>$title</td>";
			$tbl .= "<td>$rating</td>";
			$tbl .= "<td>$developer</td>";
			$tbl .= "<td>$publisher</td>";
			$tbl .= "</tr>";
		}

		$stmt -> close();
		//end of insert

		//start of class database
		$link -> close();
		//end of class database

?>

<!DOCTYPE html>
<html>

	<head>



		<title>

			 Games

		</title>

		<style type="text/css">

			html,body
    		{
				margin: 0;
				padding: 0;
			}

				
			

			table
			{
				border: 1px #00476B;
				margin: auto;
				border-collapse:collapse;
				
			}
			td
			{
				padding: 10px;
				
			}
			th
			{
				background-color: #5C89A1;
				color: white;
				font-family: helvetica;
				font-weight: 100;

			}

			tr:nth-child(2n+1)
			{
				background-color: #E6F0F5;
			}

			tr:hover
			{
				background-color: #8DACBD;
			}

			.new /* When a new entry is created, it is highlighed on the table */
			{
				background-color: #2E617B !important;
			}

		</style>


	</head>

	<body>

		<?php require 'title.php'; ?>

		<table style='table'>

			<tbody>

				<tr>

					<th>Title</th>

					<th>Rating</th>

					<th>Developer</th>

					<th>Publisher</th>

				</tr>	

				<?=$tbl ?>

			</tbody>

		</table>

		

	</body>

</html>