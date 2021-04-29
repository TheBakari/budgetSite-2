<?php
//session_start();
require_once("require.php");//poziv iz require.php stranice
$db=new Baza(); //povezivanje sa bazom
$db->connect(); //konekcija za bazon

?>
<section class="container">
    <div class="row">
        
                    <?php
                        $html="";
                        $upit="SELECT * FROM view_recepta ORDER BY rand() LIMIT 1";
                        
                        $rez=$db->query($upit);
                        $html.= "<div class='col-md-12 id='imgHighlight'>";
                        $html.= "<div class='row '>";
                        while($red=$db->fetch_object($rez))
                        {   
                            $html.= "<div class='col-md-6'id='test' >";
                            $html.= " <img class ='img-fluid'src='".((file_exists("images/$red->idRecept.jpg"))?"images/$red->idRecept.jpg":"")."' alt='No picture'>";
                            $html.= "</div>";
                            $html.= "<div class='col-md-6 itemText '>";
                            $html.= "<span >LATEST & GREATEST</span>";
                            $html.="<h5>$red->headRecept</h5>";
                            $html.= "<p>$red->descriptionRecept</p>";
                            $html.= "<a href='recipe=$red->idRecept'>READ  MORE... </a>";
                                        
                            $html.= "</div>";
                        }
                        $html.="</div>";
                        $html.="</div>";
                        echo $html;
                        
                    ?>
      
              
                    
        
    </div>
</section>
<section class="container">
    <div class="row" id="redRecepta">
        
    <?php 
        
        $html = "";   
                $upit="SELECT * FROM view_headlinetwo ORDER BY idRecept DESC LIMIT 6";
                $rez=$db->query($upit);
                    while($red=$db->fetch_object($rez)){
                        $html .= "<div class='col-md-4 col-6  topRecipe'>";
                        $html .="<a href='recipe=$red->idRecept'><img  class='img-fluid' src='".((file_exists("images/$red->idRecept.jpg"))?"images/$red->idRecept.jpg":"")."' class='img-fluid' alt='Responsive image'><h2 class='postTopTitle'>$red->headRecept</h2></a>";
                        $html .= "</div>";
                    }
                echo $html;
        ?>
       
    </div>
</section>


  
        
       