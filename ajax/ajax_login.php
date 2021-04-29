<?php 
$izlaz['greska']="";
$izlaz['putanja']="";
require_once("../require.php");//poziv iz require.php stranice
session_start();


//If $_SESSION['time'] is set, then disaloow log in for user for 1 minut
if(isset($_SESSION['time']))
{
    //When 1 minut is passed, unset this sessions
    if(time()-30>$_SESSION['time'])
    {
        unset($_SESSION['time']);
        unset($_SESSION['greska']);
    }
}

//Show message for users that need to wait 1 minut for login, and stop program for 1 minut
if(isset($_SESSION['greska']) and $_SESSION['greska']==5)
{
    $izlaz['greska']="you have mistaken Password or Eamil to many times please wait for 60 sec";
    Log::writeLog("../logs/zabrane.txt", "Korisnik sa IP adrese - ".$_SERVER['REMOTE_ADDR']." je dobio zabranu na 1 minut");

    if(!isset($_SESSION['time']))
    {
       $_SESSION['time']=time(); 
    }
    echo JSON_encode($izlaz, 256);
    exit();  
}

$db=new Baza(); //povezivanje sa bazom
$db->connect(); //konekcija za bazon
$funkcija=$_GET['funkcija'];
if($funkcija=="login")
{
    if(isset($_POST['accName']) AND isset($_POST['password']))
    {
        
        $accName=$_POST['accName'];
        $password=$_POST['password'];
        if($accName!="" and $password!="")
        {
            if(validanString($accName) and validanString($password))
            {
                $upit="SELECT * FROM users WHERE accNameUsers='{$accName}'";
                $rez=$db->query($upit);
                if($db->num_rows($rez)==1)
                {
                    $red=$db->fetch_object($rez);
                    if($red->passwordUsers==$password)
                    {
                        
                        creatSeassion($red->idUsers,$red->accNameUsers,$red->statusUsers, $red->emailUsers);
                        Log::writeLog("../logs/logs.txt", "Successful login for user {$_SESSION['accNameUsers']}");
                        if($red->statusUsers=="Korisnika")
                            $izlaz['putanja']="homepage";
                        elseif($red->statusUsers=="	Editor")
                            $izlaz['putanja']="question.php";
                        else
                            $izlaz['putanja']="register.php";
                    }
                    else{
                         $izlaz['greska']="Password is incorect please try again";
                    Log::writeLog("../logs/password.txt", "Password is incorect for user {$accName} from IP:".$_SERVER['REMOTE_ADDR']);//upisuje ovaj tekst ako je neko pogresio pass i ispisuje ip adresu
                    if(!isset($_SESSION['greska']))
                    {
                        //Seting $_Session mistake
                        $_SESSION['greska']=1; 
                    }
                    else
                    {
                        //Counter for $_Session mistake
                        ++$_SESSION['greska'];
                    }
                    }
                   
                }
                else{
                       $izlaz['greska']="User with that name does not exists $accName";
               Log::writeLog("../logs/name.txt", "Name is incorect for user {$accName} from IP:".$_SERVER['REMOTE_ADDR']);
                    if(!isset($_SESSION['greska']))
                    {
                        //Seting $_Session mistake
                        $_SESSION['greska']=1; 
                    }
                    else
                    {
                        //Counter for $_Session mistake
                        ++$_SESSION['greska'];
                    }
                    
                }
             
            }
            else
            {
                $izlaz['greska']="Accname or password contain illegal characters";
                Log::writeLog("../logs/characters.txt", "Those characters are now allowed {$accName} i {$password} from IP:".$_SERVER['REMOTE_ADDR']);
            }
        }
        else
        {
            $izlaz['greska']="Some of your information are missing";
        }

    }
        echo JSON_encode($izlaz, 256);
        
}

//REGISTRACIJA KORISNIKA
    if($funkcija=="registracija")
    {
        if(isset($_POST['raccname']) and isset($_POST['rname']) and isset($_POST['rlastname']) and isset($_POST['remail']))
        {
            $accName=$_POST['raccname'];
            $rname=$_POST['rname'];
            $rlastname=$_POST['rlastname'];
            $remail=$_POST['remail'];
            $rpassword=generisiLozinku();
            $vreme=time(); 
            if($accName!="" and $rname!="" and $rlastname!="" and $remail!="" )
            {
                if(validanString($accName)and validanString($rname) and validanString($rlastname) and validanString($remail) and validanString($rpassword))
                {
                    $sql="SELECT * FROM users WHERE emailUsers='{$remail}' LIMIT 1";
                    $rez=$db->query($sql);
                    if($db->num_rows($rez)!=1){
                          $valid_number=validNumber();
                        $sql="INSERT INTO users (accNameUsers, imeUsers, lastNameUsers, emailUsers, passwordUsers, statusUsers,timeUsers ) VALUES('{$accName}','{$rname}','{$rlastname}','{$remail}','{$rpassword}','Korisnika',".$vreme.")";
                        $db->query($sql);
                        if($db->error())echo $db->error();
                        else
                        {
                            $poruka="Registration successfull for $accName, check email for more confirmation ";
                            @mail($remail, "Potvrda registracije - Budget Byte", $poruka);
                            $izlaz['greska']= $poruka;
                        }
                    }else
                    $izlaz['greska']="User with that email adress already exsits please try another email address";
                        Log::writeLog("../logs/sameEmail.txt", "This IP adress and $accName is trying to register again with same email address:".$_SERVER['REMOTE_ADDR']);
                }else
                $izlaz['greska']="You can't use thos characters";
                    Log::writeLog("../logs/forbidenchar.txt", "This IP adress and $accName is trying to use forbiden characters:".$_SERVER['REMOTE_ADDR']);
            }
            else
            $izlaz['greska']=  "You didn't eneter all information for registration";
                Log::writeLog("../logs/registracija.txt", "Not all information are entered for registration from IP:".$_SERVER['REMOTE_ADDR']);
        }
        else 
        {
            $izlaz['greska']=  "You didn't eneter all information for registration";
            Log::writeLog("../logs/registracija.txt", "Not all information are entered for registration  from IP:".$_SERVER['REMOTE_ADDR']);
        }

        echo JSON_encode($izlaz, 256);
            
    }
    if($funkcija=="lozinka")
    {
        if(isset($_POST['email']))
        {
            $email=$_POST['email'];
            if($email!="")
            {
                $novalozinka=generisiLozinku();
                $sql="UPDATE users SET passwordUsers='{$novalozinka}' WHERE email='{$email}'";
                $db->query($sql);
                if($db->affected_rows()==1)
                {
                    $poruka="<h4>USPESNA Promena lozinka</h4><br> Korisnicko ime: $accName<br>Lozinka: $novalozinka<br>";
                    @mail($email, "Potvrda registracije - Budget Byte", $poruka);
                    $izlaz['greska']= "You passowrd is successfully changed ".$poruka;
                }
                else
                $izlaz['greska']=  "There is no user with that email";
            }
            else
            $izlaz['greska']=  " Niste uneli emai;";
        }

        echo JSON_encode($izlaz, 256);
    }
   
?>