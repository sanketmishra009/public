<?php
require "pdo.php";
session_start();
if(isset($_POST["name"])&&isset($_POST["email"])){
    $sql = "insert into students(name, email) values(:name, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array("email"=>$_POST["email"],
    ":name"=>$_POST["name"]
    ));
    $_SESSION["success"]="Successfully Inserted";
    header("Location: index.php");
    return;
}
?>

<body>
    <h1> Add new user.</h1>
    <form method="post">
        <p>
            Name: <input type="text" name="name" placeholder="your name">
        </p>
        <p>
            Email: <input type="email" name="email" placeholder="your email">
        </p>
        <input type="submit" value="add">
    </form>
    <a href="index.php">Cancel</a>
</body>