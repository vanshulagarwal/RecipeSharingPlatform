<?php
    include('./connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {        
        if (isset($_POST["submit"])) {
            $recipeid = $_POST["recipeid"];
        }
    } else {
        echo "<div>
            <p>Error: Form not submitted.</p>
        </div>";
    }


    $sql="delete from Recipes where id=$recipeid";
    $allrecipes= mysqli_query($conn,$sql);

    header("Location: index.php");

?>