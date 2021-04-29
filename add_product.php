<?php
session_start();
require_once("require.php");//poziv iz require.php stranice
if(!login())
{
    echo "You need to me login to see this page.<br>";
    echo "<a href='login.php?link=".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."'>Log in </a>";
    exit();
}
if($_SESSION['statusUsers']!="Administrator")
{
    echo "You need to me login as Administrator to see this page.<br>";
    echo "<a href='login.php'>Log in </a>";
    exit();
}
require_once("require.php");//poziv iz require.php stranice
$db=new Baza(); //povezivanje sa bazom
$db->connect(); //konekcija za bazon
$poruka="";

if(isset($_POST['button']))//DUGME DA RADI CELA FORMA
{
    $header=$_POST['headRecept'];
    $description=$_POST['descriptionRecept'];
    $categoryRecepta=$_POST['categoryRecepta'];
    $headTwoRecept=$_POST['headTwoRecept'];
    $descriptionTwoRecept=$_POST['descriptionTwoRecept'];
    $Ingredients=$_POST['Ingredients'];
    $instruction=$_POST['instruction'];
    if($header!="" and $description!="" and $categoryRecepta!="0" and $headTwoRecept!="" and $descriptionTwoRecept!="" and $Ingredients!="" and $instruction!="")// PROVERA DAL SVI PODACI POSTOJE
    {
        $db->add_prod($header,$description,$categoryRecepta,$headTwoRecept, $descriptionTwoRecept,$Ingredients,$instruction );
        if($db->error($db))
        {
            echo"There was error".$db->error();
            Log::writeLog("logs/productsError.txt", $db->error());
        }
        else
            {
                $poruka="The recipe you added was successfully saved";
                Log::writeLog("logs/products.txt", "Successfully added recipe '$header' From user {$_SESSION['accNameUsers']}");
                if($_FILES['slike']['name']!="")
                {
                    $imeSlike=$db->insert_id().".jpg";
                    move_uploaded_file($_FILES['slike']['tmp_name'],"images/".$imeSlike);//gde pomera fajl i gde ga stavlja
                
                }
                else 
                    $poruka="Picture is was not uploaded";
                    
            }
    }
    else 
        $poruka="You didn't enter all information for this recepie";

}
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
             <div class="col-md-6">
                <h1 class="hrana">Add Recipe</h1>
                            <form action="add_product.php" method="POST" enctype="multipart/form-data" name="forma">
                                    <div class="col-md-mb-3">
                                        <label  class="form-label">Header</label>
                                        <input type="text" class="form-control headRecept " id="headRecept" name="headRecept" aria-describedby="emailHelp"> 
                                    </div><br><br>

                                    <div class="form-group col-md-mb-3">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control" name="descriptionRecept"  id="descriptionRecept" rows="3"></textarea>
                                    </div><br><br>

                                    <div class="col-md-mb-3">
                                        <label for="exampleFormControlTextarea1">Category for Recipe</label><br><br>
                                        <select class="form-select categoryRecepta" aria-label="Default select example" name="categoryRecepta" id="categoryRecepta">
                                            <option selected>Chose Category for Recipe</option>
                                            <?php
                                                    $upit="SELECT * FROM category";
                                                    $rez=$db->query($upit);
                                                    while($red=$db->fetch_object($rez))
                                                    {
                                                        echo "<option value='$red->idKategorije'>$red->nameKategorije</option>";
                                                    }
                                            ?>
                                        </select>
                                    </div><br><br>
                                    <div class="col-md-mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Second Header</label>
                                        <input type="text" class="form-control headTwoRecept " name="headTwoRecept" id="headTwoRecept" aria-describedby="emailHelp"> 
                                    </div><br><br>

                                    <div class="col-md-mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Second Description</label>
                                        <textarea class="form-control descriptionTwoRecept" name="descriptionTwoRecept"  id="descriptionTwoRecept" rows="3"></textarea>
                                    </div><br><br>

                                    <div class="col-md-mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Ingredients</label>
                                        <textarea class="form-control Ingredients" name="Ingredients"  id="Ingredients" rows="3"></textarea>
                                    </div><br><br>

                                    <div class="col-md-mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Instructions</label>
                                        <textarea class="form-control instruction" name="instruction"  id="instruction" rows="3"></textarea>
                                    </div><br><br>

                                    <div class="col-md-mb-3">
                                        <label for="formFile" class="form-label">Chose Picture</label>
                                        <input class="form-control slike" type="file" id="slike" name="slike"> 
                                    </div><br><br>

                                    <button  class="btn btn-warning" name="button">Submit</button>
                            </form>
                            <div><?= $poruka?></div>
                     </div>

            </div>
    </div>
<?php 
     include("_footer.php");
    ?>
</body> 