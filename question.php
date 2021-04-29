<?php
session_start();
require_once("require.php");//poziv iz require.php stranice
if(!login())
{
    echo "You need to me login to see this page.<br>";
    echo "<a href='login.php?link=".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."'>Log in </a>";
    exit();
}
if($_SESSION['statusUsers']!="Administrator" and $_SESSION['statusUsers']!="Editor")
{
    echo "You need to me login as Administrator to see this page.<br>";
    echo "<a href='login.php'>Log in </a>";
    exit();
}
require_once("require.php");//poziv iz require.php stranice
$db=new Baza(); //povezivanje sa bazom
$db->connect(); //konekcija za bazon
$poruka="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Java script-->
    
    <link rel="stylesheet" type="text/css" href="icons/css/all.css">
    
    <!--CSS-->
    <link href="css/style_new.css" rel="stylesheet">
    <title>Budget Byte</title>
</head>
<body>
<?php 
        include("_header.php");
    ?>

   
    <div class="container">
        <div class="row">
        <div class="col-md-4">
        
        <h2>Question</h2>
        <?php
                //Brisanje komentara
                 if(isset($_GET['id']) and isset($_GET['funkcija']) )
             {  
                 
                $id=$_GET['id'];
                $funkcija=$_GET['funkcija'];
                
                if($funkcija=="allowed")
                {
                    $upit="SELECT * FROM contactus WHERE emailContactUs={$id}";
                    $rez=$db->query($upit);
                    $red=$db->fetch_object($rez);
                    $email=$red->emailContactUs;
                    // The message
                    $message = "$odgovor";

                    // In case any of our lines are larger than 70 characters, we should use wordwrap()
                    $message = wordwrap($message, 70, "\r\n");

                    // Send
                    mail($email, 'This is asnwer to your question', $message);
                   // echo  "<a href='mailto:nikoladraganic@gmail.com'$red->emailContactUs></a>";
                   
                }
                else $upit="DELETE FROM contactus WHERE idContactUs={$id} ";
                $db->query($upit);
                if($db->error()) echo "Something is not right<br>".$db->error();
                 else echo "Message was deleted ";
             }
            ?>

                <?php
                    echo question($db);
                ?></div>
        </div>
    </div>
<?php 
     include("_footer.php");
    ?>
</body>