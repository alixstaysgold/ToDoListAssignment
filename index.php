<?php
require ('database.php');


$newitem = filter_input(INPUT_POST, "newitem", FILTER_SANITIZE_STRING);
$newdesc = filter_input(INPUT_POST, "newdesc", FILTER_SANITIZE_STRING);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alix's To Do List</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>

<main>
    <header>
        <h1> To Do List </h1>
    </header><br>
    <!-- <?php if (!$newitem && !$newdesc) { ?> -->
    <section id="addItems">
        <h2> Add Items</h2>
        <form id ="submitform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method ="POST">
            <label for="newitem">New Item:</label>
            <input type="text" id="newitem" name="newitem"  required><br>
            <label for="newdesc">Description:</label>
            <input type="text" id="newdesc" name="newdesc" required>
            <button id="submitbutton" type="submit"> + </button>
        </form>
    </section>
    <!-- <?php }?>  -->
        <hr>

    <?php
           

            if ($newitem && $newdesc) {
                $query = "INSERT INTO todoitems
                            (Title, Description)
                        VALUES 
                            (:newitem, :newdesc)";
                $statement = $db->prepare($query);
                $statement->bindValue(':newitem', $newitem);
                $statement->bindValue(':newdesc', $newdesc);
                $statement->execute();
                $statement->closeCursor();
                header("location:index.php");}
            
                
            $query = 'SELECT * FROM todoitems';
                $statement = $db->prepare($query);
                // $statement->bindValue(':newitem',$newitem);
                // $statement->bindValue(':newdesc', $newdesc);
                $statement->execute();
                $results = $statement->fetchAll();
                $statement->closecursor(); 
                
                
              
                ?>
              
           
              <h2> Items To Do </h2><br>
                <section id="results">
                
                <?php foreach ($results as $result) : ?>
                
                <tr>
                    <td><?php echo $result['Title']; ?></td><br>
                    <td><?php echo $result['Description']; ?></td><br><br>
                </tr>
                <form class="delete" action="delete.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $result['ItemNum'] ?>">
                <button style="float:right" id ="deletebutton" type="deletebutton">X</button><br><br>
                </form>

                
                <?php endforeach; ?>
                </section>

                <?php if (!$results) {
                echo "Nothing in List";
            }  ?>
            
    
    
</body>
</html>