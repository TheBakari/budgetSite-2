<section class="container cont" >
    <div class="row rowklasa" >
        <h3><span>Trending </span></h3>
        
            <?php
                $html="";
                $upit="SELECT * FROM view_headlinetwo ORDER BY viewRecept DESC LIMIT 12 ";
                $rez=$db->query($upit);
                while($red=$db->fetch_object($rez)){
                    $html .= "<div class='col-md-2 col-6 topRecipe'>";
                    $html .="<a href='recipe=$red->idRecept'><img  class='img-fluid' src='".((file_exists("images/$red->idRecept.jpg"))?"images/$red->idRecept.jpg":"")."' class='img-fluid' alt='Responsive image'> <h2 class='postTopTitle'>$red->headRecept</h2></a>";
                    $html .= "</div>";
                    
                }
                echo $html;
            ?>
        
    </div>
</section>