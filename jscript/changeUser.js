$(document).ready(function(){
    prikazi();
        $("#ocisti").click(function(){
        ocistiSve();
        });
        $("#save").click(function(){
            //alert($("#idUsers").val() );
            //alert($("#accName").val());
            if($("#idUsers").val()=="" && $("#accName").val()=="")
            {
                alert("You didn't choose user");
                return false;
            }
            if($("#idUsers").val()!="")
            {
                  $.post("ajax/ajax_update.php?funkcija=update",{
                      idUsers: $("#idUsers").val(), 
                      accNameUsers: $("#accName").val(), 
                      fName: $("#fName").val(), 
                      lName: $("#lName").val(),
                      email: $("#email").val(), 
                      password: $("#password").val(), 
                      status: $("#status").val()}
            ,  function(response){
                $("#odgovor").html(response);
                prikazi();
                ocistiSve();
            });
            }
                else
                $.post("ajax/ajax_update.php?funkcija=insert",{ 
                    accNameUsers: $("#accName").val(), 
                    fName: $("#fName").val(), 
                    lName: $("#lName").val(), 
                    email: $("#email").val(), 
                    password: $("#password").val(), 
                    status: $("#status").val()}
                ,  function(response){
                    $("#odgovor").html(response);
                    prikazi();
                    ocistiSve();

                });
            });
        $("#delete").click(function(){
            let idUsers=$("#idUsers").val();
            if(idUsers=="")
            {
                $("#odgovor").html("You didn't chose User to delete");
            }
            //if(!confirm("Are you sure you want to DELETE that user")) return false;
            $.post("ajax/ajax_update.php?funkcija=delete",{idUsers:idUsers}, function(response){
                $("#odgovor").html(response);
                prikazi();
                ocistiSve();
            })
        })
    });
    function prikazi(){
        $("#chose_user").load("ajax/fill_users.php", function(response){
            //document.write(response);
            let odgovor=JSON.parse(response);
              $("#chose_user").html(""); 
            for(let i in odgovor) 
                $("#chose_user").append("<div class='korisnik' data-id='"+odgovor[i].idUsers+"' data-accname='"+odgovor[i].accNameUsers+"' data-ime='"+odgovor[i].imeUsers+"' data-prezime='"+odgovor[i].lastNameUsers+"' data-email='"+odgovor[i].emailUsers+"' data-password='"+odgovor[i].passwordUsers+"' data-status='"+odgovor[i].statusUsers+"'>" + odgovor[i].accNameUsers + ": " + odgovor[i].imeUsers+ " " +odgovor[i].lastNameUsers+"</div>");
                //$("#chose_user").append("<div>"+ odgovor[i].accNameUsers + ": " + odgovor[i].imeUsers+ " " +odgovor[i].lastNameUsers+"</div")
            $(".korisnik").click(function(){    
            $("#idUsers").val($(this).data("id"));
            $("#accName").val($(this).data("accname"));
            $("#fName").val($(this).data("ime"));
            $("#lName").val($(this).data("prezime"));
            $("#email").val($(this).data("email"));
            $("#password").val($(this).data("password"));
            $("#status").val($(this).data("status"));
            $("#email").attr("disabled", "disabled");
            //$("#password").attr("disabled", "disabled");
            });
        });

       
    }
    function ocistiSve(){
         $("input").val("");
         $("select").val("0");
         $("#email").removeAttr("disabled");
         $("#password").removeAttr("disabled");
    }