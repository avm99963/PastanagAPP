<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<script src="./js/utils.js"></script>
<?php
        $servername = "fdb22.awardspace.net";
        $username = "3155560_users";
        $password = "btechnoro@fox4news.info";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, "3155560_users");
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
        $conn->set_charset("utf8");
        
        $id = $_POST['user'];
        $query = "SELECT * FROM users WHERE id=".$id;

        if ($result = $conn->query($query)) {
            
            while ($row = $result->fetch_row()) {
                echo "<script>let db_info = {'id': ".$row[0];
                echo ", 'nom':'".$row[1]."', 'curs':".$row[2].", 'grau':".$row[3];
                echo ", 'quimata':".$row[4].", 'quielmata':".$row[5];
                echo "}; console.log(db_info);</script>";
            }
        
            $result->close();
        } else {
            echo "Wrong query";
        }
        
        // Close connection
        $conn->close(); 
?>
</head>
<body>
<?php
// Rebut l'SQL, l'enviem com a JSON a main.html
echo '
<script>
let infoString = JSON.stringify(db_info);
let infoBase64 = b64EncodeUnicode(infoString);

window.location.href = "./main.html?info=" + infoBase64;
</script>
';
?>
</body>
</html>
