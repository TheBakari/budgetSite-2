$(function(){
    //alert("rade");
    let poruka=$("#poruka");
    $("#btnPrijava").click(function(){
        let accName=$("#accName").val();
        let password=$("#password").val();
        $.post("ajax/ajax_login.php?funkcija=login",{accName:accName, password:password}, function(response){
            //poruka.html(response);
            let odgovor=JSON.parse(response);
            if(odgovor.greska!="")
                alert(odgovor.greska);
            else
                window.location.assign(odgovor.putanja);
                
        });
    });
    $("#btnPrikaziLozinku").click(function(){
        $("#btnPosaljiLozinku").toggle();
        $("#lostPassword").toggle();
        
    })

    $("#btnRegistracija").click(function(){
        let raccname=$("#raccname").val();
        let rname=$("#rname").val();
        let rlastname=$("#rlastname").val();
        let remail=$("#remail").val();  
            
        $.post("ajax/ajax_login.php?funkcija=registracija",{raccname:raccname, rname:rname, rlastname:rlastname, remail:remail}, function(response){
                let odgovor=JSON.parse(response);
                if(odgovor.greska!="")
                    alert(odgovor.greska);
          
                
        });
    });
    $("#btnPosaljiLozinku").click(function(){
        let email=$("#remail").val();
        $.post("ajax/ajax_login.php?funkcija=lozinka", {email:email}, function(response){
            let odgovor=JSON.parse(response);
            if(odgovor.greska!="")
                alert(odgovor.greska);
        })
    })
});