<?php
    include('./connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/showrecipe.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Recipe</title>
</head>
<body>
    <?php
        include('./navbar.php');
    ?>

    <div class="recipe-content">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {        
                if (isset($_POST["submit"])) {
                    $recipeid = $_POST["recipeid"];
                }
            } else {
                echo "<div>
                    <p>Error: Form not submitted.</p>
                </div>";
            }
    

            $sql="Select * from Recipes where id=$recipeid;";
            $allrecipes= mysqli_query($conn,$sql);
        
            $row = mysqli_fetch_array($allrecipes);
            if($row['vegtype']=='Veg'){
                $veg="<img class='veg-image' src='images/veg-symbol.png'>";
            }
            else{
                $veg="<img class='veg-image' src='images/nonveg-symbol.png'>";
            }
        ?>
            <div class="recipeimg">
                <img class="recipeimg" src="uploads/<?php echo $row['imagepath']?>" alt="">
            </div>
            <div class='flex'>
                <h1 class='recipe-title'><?php echo $row['dishname'] ?></h1>
                <p><?php echo $veg ?></p>
            </div>
                <p>⏱️: <?php echo $row['timereq'] ?> mins</p>
                <p>🍴Best for <?php echo $row['dishtype'] ?></p>

            <div>
                <h2>Ingredients:</h2>
                <p><?php echo $row['ingredients'] ?></p>
            </div>
            <div>
                <h2>Process:</h2>
                <p><?php echo $row['process'] ?></p>
            </div>
            <form action="deleterecipe.php" method="POST">
                <input type='hidden' name='recipeid' value='<?php echo $row['id']?>'>
                <button class="recipe-delete-btn" type="submit" name="submit">Delete Recipe</button>
            </form>
    </div>
</body>
</html>