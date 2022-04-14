<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>E-lolning Forum</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/font-face.css" />
    <link rel="stylesheet" href="../css/shared.css" />
    <link rel="stylesheet" href="../css/forum.css" />
  </head>
  <body>
   
  <?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/client/view/php/header.php");
	require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/admin/mysqli.php");
	$mysqli = getMysqli();
  ?>
  
  <div>
    <h1> Forum </h1>
    <?php
	date_default_timezone_set("Etc/GMT-2");
    if(isset($_REQUEST["topic"]) && !empty($_REQUEST["topic"]))
    {
		if($_REQUEST["topic"] == "new")
		{
			if(isset($_REQUEST["create"]))
			{
				if(isset($_REQUEST["name"]) && !empty($_REQUEST["name"]))
				{
					createTopic($_REQUEST["name"]);
				}
				else
				{		
					showCreateTopicForm(array("Missing topic name"));
				}
			}
			else
			{
				showCreateTopicForm();
			}
		}
		else
		{
			if(isset($_REQUEST["msg"]) && !empty($_REQUEST["msg"]))
			{
				addAnswer($_REQUEST["msg"], $_REQUEST["topic"]);	//TODO: sanitize input
			}
			//TODO: sanitize input
			$requete = "SELECT * FROM topics WHERE id=" . $_REQUEST["topic"] . ";";
			$result = $mysqli->query($requete,MYSQLI_STORE_RESULT);
			$topic = $result->fetch_assoc(); 
			showTopic($topic);
		}
    }
    else 
    {
		$requete = "SELECT * FROM topics;";
		$result = $mysqli->query($requete,MYSQLI_STORE_RESULT);
		$topics = $result->fetch_all(MYSQLI_ASSOC); 
	
        listTopics($topics);
    }
	
	closeMysqli($mysqli);
    ?>
  </div>

    <!-- JS -->
	<script src="../js/jquery.js"></script>
    <script src="../js/shared.js"></script>
	<script src="../js/forum.js"></script>
  </body>
</html>

<?php

function listTopics($topics) 
{
    ?>
	<form method="get">
		<h2> Topics </h2>
		<button name="topic" value="new"> New Topic </button>
		<table>
		<tbody>
		<?php 
		foreach($topics as $topic)
		{
			echo "<tr> <td> <button name='topic' value='". $topic["id"] ."'> ". $topic["name"]. " </button> </td> </tr>";    
		}
		?>
		</tbody>
		</table>
	</form>
    <?php
}

function showTopic($topic) 
{
	//debug :  $messages as parameter
	global $mysqli;
	?>
	<div>
		<button id="backBtn"> Back </button>
	</div>
    <h2> <?php echo $topic["name"] ?> </h2>
    <table>
    <tbody>
    <?php
	$requete = "SELECT * FROM topics_posts WHERE topic=". $topic["id"] .";";
	$result = $mysqli->query($requete,MYSQLI_STORE_RESULT);
	$messages = $result->fetch_all(MYSQLI_ASSOC); 
    foreach($messages as $message)
    {
       showMessage($message);
    }
    ?>
    </tbody>
    </table>
    <?php
    //TODO: show only if logged ?
    showInputZone($topic->id);
}

function showMessage($message)
{
	global $mysqli;
	echo "<tr> <td>";
    //TODO distinct if current user = author
	$requete = "SELECT * FROM users WHERE id=" . $message["author"] . ";";
	$result = $mysqli->query($requete,MYSQLI_STORE_RESULT);
	$author = $result->fetch_assoc(); 
    $author_name = $author["firstname"] . " " . $author["lastname"];
    $date = date('m/d/Y H:i:s', $message["date"]);
    echo $author_name . "<br /> $date </td> <td> ". $message["content"] . " </td> </tr>";
}

function showInputZone($topicId) 
{
    ?>
    <form method="post">
        <div id="containerInputZone">
	        <input hidden name="topic" value="<?php echo $topicId ?>" />
            <textarea id="msgArea" name="msg" placeholder="Type your reply..."></textarea>
            <input id="addAnswerBtn" type="submit" value="Answer" />
        </div>
    </form>
    <?php
}

function addAnswer($msg, $topic_id)
{
	global $mysqli;
	//TODO sanitize inputs
	$mysqli->query("INSERT INTO topics_posts (author, date, content, topic) VALUES (5,".time().", '".$msg."', ". $topic_id.");");
}

function showCreateTopicForm($errors = array())
{	
	echo "<div id='errorsDiv'>";
	foreach($errors as $e)
	{
		echo "<p> $e </p>";
	}
	echo "</div>";

	?>
	<h2> Create a new topic </h2>
	<button id="backBtn"> Back </button>
	<form method="post">
		<input name="topic" value="new" hidden />
		<label for="inputName"> Name : </label>
		<input name="name" type="text" id="inputName"/>
		
		<button id="createTopicBtn" name="create"> Create </button>
	</form>
	<?php
}

function createTopic($name)
{
	global $mysqli;
	//TODO sanitize inputs
	//TODO load real user
	$mysqli->query("INSERT INTO topics (name, author) VALUES ('".$name."', 5);");
	
	$requete = "SELECT * FROM topics WHERE id=" . $mysqli->insert_id . ";";
	$result = $mysqli->query($requete,MYSQLI_STORE_RESULT);
	$topic = $result->fetch_assoc(); 
	showTopic($topic);
}

?>