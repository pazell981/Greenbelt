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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
<div id="container">
    <div id="wrapper">
        <div id="title">
        <h1>Coding Dojo Crime Watch</h1>
            <div id="user">
                <?php 
                    if(isset($userinfo)){
                        echo "<h6>Welcome " . $first . "!  </h6>";
                        echo "<a href='logoff.php' class='button blue'>Log off</a>";
                    }else{
                        echo "<a href='index.php' class='button blue'>Log in</a>";
                    } 
                ?>
            </div>
        </div>
        <div id="body">
            <h1>Welcome <?php echo $first ?> to Crime Watch!</h1>
            <table>
                <thead>
                    <tr>
                        <th>Incident</th>
                        <th>Date</th>
                        <th>Reported</th>
                        <th>Did you see it?</th>
                        <th>View Report</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT incidents.id, incidents.name, incidents.created_on, users.first_name FROM incidents JOIN users ON users.id=incidents.creator_id ORDER BY incidents.created_on DESC";
                    $results = fetch_all($query);
                    $i=0;
                    foreach ($results as $result) {
                        echo "<tr ";
                        if ($i%2==0){
                            echo "class= 'gray'";
                        }
                        echo "><td>" . $result['name'] . " </td><td>" . date('F jS, Y',strtotime($result['created_on'])) . "</td><td>" . $result['first_name'] . "</td>";
                        echo "<td><a href='witnessed.php?user_id={$userid}&incident_id={$result['id']}' class='button green'>Yes</a></td>";
                        echo "<td><a href='incident_report.php?incident_id={$result['id']}'>View</a></td><tr>";
                        $i++;
                    }

                    ?>
                </tbody>
            </table>
            <h1>Add a new incident...</h1>
            <form action="incident.php" method="post">
                <input type='hidden' name="secure">
                <input type='hidden' name="user_id" value="<?php echo $userid; ?>">
                <label>Incident name:</label>
                <input type='text' name='name'>
                <label>Incident date:</label>
                <input type='date' name='date'>
                <input type='submit' nvalue='Add Incident' class='button purple'>
            </form>
        </div>
        <div id="footer">
        </div>
	</div>
</div>
</body>
</html>