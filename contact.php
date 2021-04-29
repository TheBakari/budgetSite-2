<?php
session_start();
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
    <script src="jscript/jquery-3.5.0.js"></script>
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
                    <div class=" col-md-12 hrana">
                        <h2 >Contact</h2>
                    <p>If you have a quick question about a specific recipe, the fastest way to get a response is to ask via the comment form at the bottom of the recipe page. Comments are moderated at least once per day and I’ll do my best to answer your question! :)</p>
                    <p>
                        <a href="#">Instagram</a>, <a href="#">Facebook</a> and <a href="#">Twitter</a> are also usually checked daily, so those are also great options for a quick response.
                    </p>
                    <p>If you have a more complex question or want to share your story (I love hearing them!), you can email me using the contact form below. It may take a few days for me to get back to you.</p>
                    <p>Media, advertising, and promotional inquiries can be submitted via the contact form below.</p>
                    <p>Thanks and I look forward to hearing from you!</p>
                    </div>
                    <div class="col-md-8">
                         <form action="contactus" method="POST">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input type="text" class="form-control" placeholder="Name" name="fName" id="fName"><br>
                                <?php 
                                    $html="";
                                    if(!login()){
                                        $html .= " <label for='exampleFormControlInput1' class='form-label'>Email</label>";
                                        $html .= " <input type='email' class='form-control'name='email' id='email' placeholder='Email'><br>";
                                    }
                                    echo $html;
                                ?>
                                <!-- <label for="exampleFormControlInput1" class="form-label">Email</label>
                                 <input type="email" class="form-control"name="lName" id="lName" placeholder="Email"><br>
                                     -->
                             </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Message</label>
                                <label for="exampleFormControlTextarea1" class="form-label"></label>
                                <textarea class="form-control question" name="question" id="question" rows="3"></textarea><br>
                                <button type="submit" class="btn btn-warning" name="button">Submit</button>
                            </div>

                    </form>
                    </div>
                    <?php   // snimanje pitanja
                        if(isset($_POST['question']))
                        {
                            $pitanje=$_POST['question'];
                            if(login())
                                {
                                    $email=$_SESSION['emailUsers'];
                                }
                            else
                                $email=$_POST['email'];
                                $fName=$_POST['fName'];
                               
                            if($pitanje!="" and $email!="")
                                {
                                   if(login())
                                        $upit="INSERT INTO contactus (idUser,nameContactUs,emailContactUs,messageContactUs) VALUES ({$_SESSION['idUsers']},'{$fName}','{$email}','{$pitanje}')";
                                   else 
                                        $upit="INSERT INTO contactus (nameContactUs,emailContactUs,messageContactUs) VALUES ('{$fName}','{$email}','{$pitanje}')";
                                        $db->query($upit);
                                    if($db->error())
                                        echo "Something went wrong<br>".$db->error();
                                    else 
                                        echo "Your message was send we will get back to you soon as possible ";
                                }
                            else echo "Svi podaci su obavezni <br>";
                        }
                        
                        
                ?>
                   

                    </div>
            </div>
        </div>
    
   <?php 
    include("_footer.php");
    ?>
</body>
