<div class="container">
    <div class="row">
        <div class="col-md-7 about" > 
            
          <div class="row">
              <section class="col-md-6">
                  <img src="images/about.jpg"  class="img-fluid"  alt="Responsive image">
              </section>
                
                    <article class="col-md-6 align-items-center" id="textAbout">  <?php
                            $upit="SELECT * FROM aboutme WHERE id=4";
                            $rez=$db->query($upit);
                            while($red=$db->fetch_object($rez))
                            {
                                echo "<h3>$red->headAboutMe</h4>";
                                echo "<p>$red->textAbooutMe</p>";
                            }
                        ?>
                         <div id="aboutLinks">
                            <a href="#"> <i class="fa fa-rss "></i></a>
                            <a href="#"> <i class="fab fa-twitter ml-2"></i></a>
                            <a href="#"> <i class="fab fa-facebook-f ml-2"></i></a>
                            <a href="#"> <i class="fab fa-pinterest-p ml-2"></i></a>
                            <a href="#"> <i class="fab fa-instagram ml-2"></i></a>
                        </div>
                    </article> 
                     
                   
          </div>
        </div>
        <section class="col-md-5 about_left">
                <a href=""><img src="images/about2.jpg" class="img-fluid"  alt="Responsive image"></a>
        </section>
    </div>
</div>