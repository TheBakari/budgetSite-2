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
            <div class="row food-wrapper">
                <div class="hrana col-md-12 mb-5">
                    <h2>Search Results</h2>
                 </div> 

                
               
                <?php 

                            
                            $html="";
                            if(isset($_POST['search']))$upit="SELECT * FROM  view_headlinetwo WHERE deleteRecept=0 and (headRecept LIKE ('%".$_POST['search']."%') OR descriptionRecept LIKE ('%".$_POST['search']."% ') OR nameKategorije LIKE('%".$_POST['search']."%'))  ORDER BY idRecept DESC";//pravi upit is view gde mogu da pretraze sve recepte preko head ili diskripcije  preko post metode
                            $rez=$db->query($upit);
                            while($red=$db->fetch_object($rez))
                            {
                            $html .= "<div class='col-md-3 mb-10 archive-post'>";
                            $html .="<a href='recipe=$red->idRecept'><img  class='img-fluid' src='".((file_exists("images/$red->idRecept.jpg"))?"images/$red->idRecept.jpg":"")."' class='img-fluid' alt='Responsive image'> <h2 class='postTopTitle'>$red->headRecept</h2></a>"; 
                            $html .= "</div>";

                        }
                        echo $html;
                        
                    ?>
                
               <!--  <div class="col-md-3 mb-10 archive-post">
                        <a href="#">
                            <img src="images/breakfest/breafest1.jpg" alt="#">
                            <h4 class="title">Freezer Breakfast Burritos</h4>
                        </a>
                </div>
                -->
            </div>
        </div>


   <?php 
    include("_footer.php");
    ?>
</body>
