<?php
    include('./connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/newrecipe.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>New Recipe</title>
</head>
<body>
    <?php
    include('./navbar.php');
    ?>
    
    <form action="" method="POST" enctype="multipart/form-data" class="form-new-recipe">
        <div>
            <label for="dishname">Recipe Name:</label>
            <input type="text" id="dishname" name="dishname" required>
        </div>

        <div>
            <label for="timereq">Time Required(in mins):</label>
            <input type="number" id="timereq" name="timereq" required>
        </div>

        <div>
            <label>Vegeterian Type: </label>
            <input type="radio" id="veg" name="vegtype" value="Veg" required>
            <label for="veg">Veg</label>
            <input type="radio" id="nonveg" name="vegtype" value="Non-Veg" required>
            <label for="nonveg">Non-Veg</label>
        </div>

        <div>
            <label>Meal Type:</label>
            <input type="radio" id="snacks" name="dishtype" value="Snacks" required>
            <label for="snacks">Snacks</label>
            <input type="radio" id="lunch" name="dishtype" value="Lunch" required>
            <label for="lunch">Lunch/Dinner</label>
            <input type="radio" id="beverages" name="dishtype" value="Beverages" required>
            <label for="beverages">Beverages</label>
            <input type="radio" id="dessert" name="dishtype" value="Dessert" required>
            <label for="dessert">Dessert</label>
        </div>

        <div>
            <label for="ingredients">Ingredients</label>
            <textarea id="ingredients" name="ingredients" required></textarea>
        </div>

        <div>
            <label for="process">Recipe:</label>
            <textarea id="process" name="process" required></textarea>
        </div>

        <div>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>

        <div>
            <button type="submit" name="submit" required>Add Recipe</button>
        </div>

    </form>
</body>
</html>

<?php
    if(isset($_POST['submit']))
    {
        $dishname = $_POST['dishname'];
        $timereq = $_POST['timereq'];
        $vegtype = $_POST['vegtype'];
        $dishtype = $_POST['dishtype'];
        $ingredients = $_POST['ingredients'];
        $process = $_POST['process'];

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }


        $sql = "INSERT INTO Recipes(dishname,timereq,vegtype,dishtype,ingredients,process,imagepath) 
        VALUES('$dishname','$timereq','$vegtype','$dishtype','$ingredients','$process','{$_FILES['fileToUpload']['name']}')";


        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
        header("Location: index.php");
        
    }
    ?>