

<?php
function validanString($str)
{
    if(strpos($str, "=")!==false) return false;
    if(strpos($str, " ")!==false) return false;
    if(strpos($str, "(")!==false) return false;
    if(strpos($str, ")")!==false) return false;
    if(strpos($str, "'")!==false) return false;
    if(strpos($str, "/")!==false) return false;
    if(strpos($str, ";")!==false) return false;
    if(strpos($str, ":")!==false) return false;
    if(strpos($str, "<")!==false) return false;
    if(strpos($str, ">")!==false) return false;
    if(strpos($str, "{")!==false) return false;
    if(strpos($str, "}")!==false) return false;
    return true;
};

function login()
{
    if(isset($_SESSION['idUsers']) and isset($_SESSION['accNameUsers']) and isset($_SESSION['statusUsers']))
        return true;
    elseif(isset($_COOKIE['idUsers']) and isset($_COOKIE['accNameUsers']) and isset($_COOKIE['statusUsers']))
    { //generisemo sesije
        $_SESSION['idUsers']=$_COOKIE['idUsers'];
        $_SESSION['accNameUsers']=$_COOKIE['accNameUsers'];
        $_SESSION['statusUsers']=$_COOKIE['statusUsers'];
        $_SESSION['emailUsers']=$_COOKIE['emailUsers'];
        return true;
    }
    else
        return false;
    
}
function destroySession()
{
    session_unset();
    session_destroy();
    /*setcookie("idUsers", time()-86400, "/");
    setcookie("accNameUsers", time()-86400, "/");
    setcookie("statusUsers", time()-86400, "/");
    setcookie("emailUsers", time()-86400, "/");*/
}
function creatSeassion($idUsers,$accNameUsers,$statusUsers,$email)
{
    $_SESSION['idUsers']=$idUsers;
    $_SESSION['accNameUsers']=$accNameUsers;                                       
    $_SESSION['statusUsers']=$statusUsers;
    $_SESSION['emailUsers']=$email;
   /* if(isset($_POST['remeberme']))
    {  PROVERA ZA CHECK BOX
        setcookie("idUsers",$idUsers, time()+86400, "/");
        setcookie("accNameUsers",$accNameUsers, time()+86400, "/");
        setcookie("statusUsers",$statusUsers, time()+86400, "/");
        setcookie("emailUsers",$email, time()+86400, "/");
    }*/
}
function generisiLozinku()
{
    $ms=['a', 'b', 'c','d','e','q','w','r','t','y','u','i','o','p','s','f','g','h','j','k','l','z','v','n','m'];
    $vs=['Q', 'W', 'E','R', 'T', 'Y','U', 'I', 'O','P', 'S', 'A','D', 'F', 'G','H', 'J', 'K','L', 'Z', 'X', 'C', 'V', 'B', 'N', 'M'];// treba staviti celu abecedu
    $br=[1, 2, 3, 4,5, 6, 7, 8, 9, 0];
    $zn=['!', ".",",","#","$","%","^","&","*",];
    $lozinka=$ms[round(mt_rand(0, count($ms)-1))].$ms[round(mt_rand(0, count($ms)-1))].$vs[round(mt_rand(0, count($vs)-1))].$vs[round(mt_rand(0, count($vs)-1))].$br[round(mt_rand(0, count($br)-1))].$zn[round(mt_rand(0, count($zn)-1))];
	return  $lozinka;

}

//FROM PAGE single_recipes.php
function single_recept($id,$db)
{
    $html="";
    if(is_int($id)){
        $upit="SELECT * FROM view_recepta WHERE deleteRecept=0 and idRecept={$id}";
        $rez=$db->query($upit);
        if($db->num_rows($rez)!=0){
            $red=$db->fetch_object($rez);
            $html .= "<h2> $red->headRecept</h2>";
            $html .= "<p>$red->descriptionRecept</p>";
            $html .= "<img src='".((file_exists("images/$red->idRecept.jpg"))?"images/$red->idRecept.jpg":"")."' alt='No picture'>";
            $html .= " <div class='mt-10 sastojci'>";
            $html .= "<h2>$red->headerTwoRecept</h2>";
            $html .= "<p>$red->descriptionTwoRecept</p>";
            $html .= "<h3>ingredients</h3>";
            $html .= "$red->ingredientsRecept";
            $html .= "<h3>INSTRUCTIONS</h3>";
            $html .= "$red->instructionRecept";
            $html .= "</div>";
        }
        if(login())
        {
            if($_SESSION['statusUsers']=="Korisnika")
           echo"<a href='index_pdf.php?id=$id'> <button type='button' class='btn btn-warning' name='button'> Download Recipe</button></a>";
            
           
        }
        //view recepta povecava view za jedan svaki put kad neko pogleda 
            $upit="UPDATE recept SET viewRecept=viewRecept+1 WHERE idRecept={$id}";
            $db->query($upit);
        }
        else 
            echo "Recipe you chosen does not exists";
        
            return $html;
}

    function single_comments_prikaz($id,$db){
        $upit="SELECT * FROM comments WHERE recept_idRecept=$id and allowedComment=1  ORDER BY timeComments DESC ";
            $rez=$db->query($upit);
                if($db->num_rows($rez)!=0)
                {   
                     while($red=$db->fetch_object($rez))
                    {   
                        echo "<div class='card' style='width: 18reml'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>Name:$red->imeComments</h5>";
                        echo "<p class='card-text'>Time:$red->timeComments</p>";
                        echo "<div><p>$red->comComments</p></div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    
                }
                else
                    echo "We still don't have any comments wanna be first?";
    }

    function single_comments_post($id,$ime,$email,$komentar,$db){
        if($ime!="" and $email!="" and $komentar!="" )
        {
            $upit="INSERT INTO comments (recept_idRecept,imeComments,emailComments,comComments) VALUES ({$id},'{$ime}','{$email}','{$komentar}') ";
            $db->query($upit);
            if($db->error())echo "Something went wrong<br>".$db->error();
            else
                echo "Comment is saved, waiting for Administration to proved it before you can see it";
        }
        else
            echo "All fields are required";
    }
   
 //FUNCTION FOR PAGE aboutMe.php   
    function about_me($db){
        $upit="SELECT * FROM aboutme WHERE id=1";
        $rez=$db->query($upit);
        while($red=$db->fetch_object($rez)){
            echo "<h2> $red->headAboutMe </h2>";           
            echo "<p>$red->textAbooutMe</p>";
        }
    }

    function about_me1($db){
        $upit="SELECT * FROM aboutme WHERE id=2";
        $rez=$db->query($upit);
        while($red=$db->fetch_object($rez)){
            echo "<h4>$red->headAboutMe</h4>";
            echo "<p>$red->textAbooutMe</p>";  
        }
    }
    function about_me2($db){
        $upit="SELECT * FROM aboutme WHERE id=3";
        $rez=$db->query($upit);
        while($red=$db->fetch_object($rez)){ 
            echo "<div class='about-me'>";
            echo "<h4>$red->headAboutMe</h4>";
            echo "<p>$red->textAbooutMe</p>";
            echo "</div>";
        }
    }


    //comments.php

    function comments($db){
        $upit="SELECT * FROM comments WHERE allowedComment=0 ORDER BY timeComments DESC";
        $rez=$db->query($upit);
        if($db->num_rows($rez)!=0)
        {
            while($red=$db->fetch_object($rez)){
                echo "<div class='card' style='width: 18reml'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>$red->imeComments</h5>";
                echo "<h6 class='card-subtitle mb-2 text-muted'>$red->emailComments</h6>";
                echo "<p class='card-text'>$red->timeComments</p>";
                echo "<p class='card-text'>$red->comComments</p>";
                echo "<a href='comments.php?id=$red->idComments&funkcija=allowed' 'class='card-link'>Allowed</a> " ;
                echo "<a href='comments.php?id=$red->idComments&funkcija=delete' 'class='card-link'>Delete</a>";
                echo "</div>";
                echo "</div>";
            }
        }
        else 
            echo "There are no comments right now";
    }

//privacyPolicy.php
    function privacyP($db)
    {
        $upit="SELECT * FROM privpolicy";
        $rez=$db->query($upit);
        while($red=$db->fetch_object($rez)){
            echo "<div class='col-md-8 hrana'>";
            echo "<h2> $red->headerTermsCond </h2>";
            echo "<p>$red->textPrivPolicy</p>";
            echo "</div>";
        }
    }

//question.php
    function question($db){
        $upit="SELECT * FROM contactus WHERE isnull(answerContactUs) ORDER BY timeContactUs  DESC ";
                $rez=$db->query($upit);
                if($db->num_rows($rez)!=0)
                {
                    while($red=$db->fetch_object($rez)){
                        echo "<div class='card' style='width: 18reml'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>Email:$red->emailContactUs</h5>";
                        echo "<h6 class='card-subtitle mb-2 text-muted'>Name: $red->nameContactUs</h6>";
                       
                        echo "<p class='card-text'>Time: $red->qanswerContactUs</p>";
                        if($red->answerContactUs==null) echo "Status: No answer";
                        else
                        { 
                            echo "<p class='card-text'>Status: $red->timeContactUs</p>";
                        }
                        echo "<p class='card-text'>$red->messageContactUs</p>";
                        echo "<a href='mailto:$red->emailContactUs' 'class='card-link'>Replay</a> " ;
                        echo "<a href='question.php?id=$red->idContactUs&funkcija=delete' 'class='card-link'>Delete</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
                else 
                    echo "There are no comments right now";
    }
?>

