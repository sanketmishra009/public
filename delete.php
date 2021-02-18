<?php
    session_start();
    require "pdo.php";
    if(isset($_POST["delete"]) && isset($_POST["student_id"])){
        $sql = "delete from students where student_id = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":zip"=>$_POST["student_id"]));
        $stmt = $pdo->prepare("select * from students where student_id = :zip");
        $stmt->execute(array(":zip"=>$_POST["student_id"]));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row===false){
            $_SESSION["success"]="Successfully deleted.";
            header("Location: index.php");
            return;
        }
        else{
            $_SESSION["error"]="deleted unsuccessful";
            header("Location: index.php");
            return;
        }
    }
    $stmt = $pdo->prepare("select * from students where student_id = :zip");
    $stmt->execute(array(":zip"=>$_GET["student_id"]));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($row);
    if($row === false){
            $_SESSION["error"]="Not a valid user.";
            header("Location: index.php");
            return;
    }
    ?>

<body>
    <form method="post">
        <p class="">Confirm Deleting:<?= htmlentities($row["name"])?>
        </p>
        <input type="submit" name="delete" value="Delete">
        <input type="hidden" name="student_id" value="<?= $row['student_id']?>">
        <a href="index.php">Cancel</a>
    </form>
</body>