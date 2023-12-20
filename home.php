<body>
    <?php
        $sql="Select * from Recipes;";
        $allrecipes= mysqli_query($conn,$sql);

        while($row = mysqli_fetch_array($allrecipes))
        {
            $imgurl="uploads/".$row['imagepath'];
            if($row['vegtype']=='Veg'){
                $veg="<img class='veg-image' src='images/veg-symbol.png'>";
            }
            else{
                $veg="<img class='veg-image' src='images/nonveg-symbol.png'>";
            }
            echo "
            <div class='recipe'>
                <div class='recipeimg'>
                    <img src='".$imgurl."'> 
                </div>
                <div class='recipecontent'>
                    <div class='flex'>
                        <h2 class='recipe-title'>{$row['dishname']}</h2>
                        <p>".$veg."</p>
                    </div>
                    <p class='recipe-time'>Time Required: {$row['timereq']} mins</p>
                    <p>Best for {$row['dishtype']}</p>
                
                    <form action='showrecipe.php' method='post'>
                        <input type='hidden' name='recipeid' value='{$row['id']}'>
                        <input class='recipe-view-btn' type='submit' name='submit' value='View Full Recipe'>
                    </form>
                </div>
            </div>";
        }
    ?>
</body>
