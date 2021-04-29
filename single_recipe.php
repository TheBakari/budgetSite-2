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
                <div class="col-md-9 mb-5  hrana">
                <?php 
                    $html="";
                     if(isset($_GET['id'])){
                         $id=$_GET['id'];
                         $id=intval($id);
                        echo single_recept($id,$db); //poziv funkcije 
                    }
                    else
                        echo "ID is not a number";
                
                
                    echo $html;
                ?>
            <?php
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                    echo single_comments_prikaz($id,$db);
                }
                    
            ?>               
                
                               
                <form action="recipe=<?php echo $id ?>" method="post">
                            <div class="mb-3 mt-5">
                                <h2>Comments</h2>
                                <p>Your email address will not be published. Required fields are marked</p>
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input type="text" class="form-control"  name="name" id="name"><br>
                              
                                 <label for="exampleFormControlInput1" class="form-label">Email</label> 
                                 <input type="email" class="form-control"name="email" id="email" ><br>
                                    
                             </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Comment</label>
                                <label for="exampleFormControlTextarea1" class="form-label"></label>
                                <textarea class="form-control question" name="komentar" id="komentar" rows="3"></textarea><br>
                                <button type="submit" class="btn btn-warning" name="button">Submit</button>
                            </div>

                    </form>
                                                     
                    <?php
                        
                        if(isset($_POST['name']) and isset($_POST['email']) and isset($_POST['komentar']))
                        {
                            $ime=$_POST['name'];
                            $email=$_POST['email'];
                            $komentar=$_POST['komentar'];
                           // $idRecepta=$_GET['idRecept'];
                           single_comments_post($ime,$email,$komentar,$db);
                        }

                    ?>
                </div>

            </div>
        </div>
<?php 
    include("_footer.php");
    ?>
</body>