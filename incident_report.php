<?php
    session_start();
    include 'new-connection.php';
    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        $query = "SELECT * FROM users WHERE id ='" . $userid . "'";
        $userinfo = fetch_record($query);
        $email = $userinfo['email'];
        $first = $userinfo['first_name'];
        $last = $userinfo['last_name'];
    } else {
        header('location: logoff.php');
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>CodingDojo Crime Watch</title>
    <meta name="description" content="Greenbelt Exam - 07/18/14 - CodingDojo Crime Watch!">
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){
                $("<p class='standout'>Please verify this information, there was an error verifying this entry.</p>").insertBefore(".errors");
            });
    </script>
</head>
<body>
<div id="container">
    <div id="wrapper">
        <div id="title">
        <h1>Coding Dojo Crime Watch</h1>
            <div id="user">
                <?php 
                    if(isset($user)){
                        echo "<h6>Welcome " . $first . "!  </h6>";
                        echo "<a href='logoff.php' class='button blue'>Log off</a>";
                    }else{
                        echo "<a href='index.php' class='button blue'>Log in</a>";
                    } 
                ?>
            </div>
        </div>
        <div id="body">
            <div id="report">
            <?php 
                $query = "SELECT * FROM incidents WHERE id=" . $_GET['incident_id'];
                $query2 = "SELECT * FROM user_seen_incident JOIN users ON user_seen_incident.users_id=users.id WHERE user_seen_incident.incidents_id=" . $_GET['incident_id'];
                $incident = fetch_record($query);
                $witnesses = fetch_all($query2);
            ?>
            <h2>Incident Name: <?php echo $incident["name"]; ?></h4>
            <h2>Incident Date: <?php echo $incident["created_on"]; ?></h4>
            <h2>Seen by: <?php echo count($witnesses); ?> people</h4>
            <h3>The Witnesses</h3>
                <?php 
                    foreach($witnesses as $witness){
                        echo "<p>" . $witness['first_name'] . " " . $witness['last_name'] . "</p>";
                    }
                ?>
                <a href="crime_dashboard.php" class="button green">Back to Crime Watch</a> <a href="delete.php?incident_id=<?php echo $_GET['incident_id']; ?>" class="button red">Delete Incident</a>
            </div>
        </div>
        <div id="footer">
        </div>
    </div>
</div>
</body>
</html>