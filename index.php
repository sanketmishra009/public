<?php
    require "pdo.php";
    session_start();
    if(isset($_POST['studentName'])){
        // echo $_POST['studentName'];
        $sql = 'select * from students where name like :sname';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":sname"=>'%'.$_POST['studentName'].'%'));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$row){
            echo '<a href="add.php"> ADD</a>';
        }
        else{
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(":sname"=>'%'.$_POST['studentName'].'%'));
            echo "<table border=1>";
            echo "<tr><td>Name</td><td>Email</td><td></td></tr>";
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "<tr><td>";
                echo $row["name"];
                echo "</td><td>";
                echo $row["email"];
                echo "</td><td>";
                echo '<a href="edit.php?student_id='.$row["student_id"].'">Edit</a>';
                echo "/";
                echo '<a href="delete.php?student_id='.$row["student_id"].'">Delete</a>';
                echo "</td></tr>";
            }
        }
    }
?>


<?php
        if(isset($_SESSION['error'])){
        echo '<p style="color:red">'.$_SESSION["error"].'</p';
        unset($_SESSION["error"]);
        }
        if(isset($_SESSION['success'])){
            echo '<p style="color:green">'.$_SESSION["success"].'</p';
            unset($_SESSION["success"]);
        }
    ?>


<body>
    <form method='post'>
        <p>
            <input type="text" name='studentName' placeholder='student name' id='name'>
            <input type="submit" value='search'>
        </p>
    </form>
</body>