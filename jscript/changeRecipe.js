$(document).ready(function(){
    prikazi();
            $("#ocisti").click(function(){
                ocistiSve();     
            });
            
   $("#save").click(function(){
        if($("#idRecept").val()=="" && $("#headRecept").val()=="")
        {
            alert("You didn't chose recipe");
            return false;
        }
        if($("#idRecept").val()!=="")
        {
           
            $.post("ajax/ajax_recipe.php?funkcija=update",{
                idRecept: $("#idRecept").val(),
                headRecept: $("#headRecept").val(),
                descRecept: $("#descriptionRecept").val(),
                category: $("#category").val(),
                headTtecept: $("#headTwoRecept").val(),
                descTrecept: $("#descriptionTwoRecept").val(),
                ingredients: $("#ingredients").val(),
                instruction: $("#instruction").val()}
                , function(response){
                    $("#odgovor").html(response);
                    prikazi();
                    ocistiSve();
            });
        }
                else
                    $.post("ajax/ajax_recipe.php?funkcija=insert",{
                        idRecept: $("#idRecept").val(),
                        headRecept: $("#headRecept").val(),
                        descRecept: $("#descriptionRecept").val(),
                        category: $("#category").val(),
                        headTtecept: $("#headTwoRecept").val(),
                        descTrecept: $("#descriptionTwoRecept").val(),
                        ingredients: $("#ingredients").val(),
                        instruction: $("#instruction").val()}
                        , function(response){
                            $("#odgovor").html(response);
                            prikazi();
                            ocistiSve();
                        })                         
            
            })

            $("#delete").click(function(){
                let idRecept=$("#idRecept").val();
                if(idRecept=="")
                {
                    $("#odgovor").html("You didn't chose recippe to delete");
                }
                //if(!confirm("Are you sure you want to DELETE that user")) return false;
                $.post("ajax/ajax_recipe.php?funkcija=delete",{idRecept:idRecept}, function(response){
                    $("#odgovor").html(response);
                    prikazi();
                    ocistiSve();
                })
            })
        });

function prikazi(){
    $("#chose_product").load("ajax/fill_recipe.php", function(response){
        let odgovor=JSON.parse(response);
        $("#chose_product").html("");
        for(let i in odgovor)
        $("#chose_product").append("<div class='korisnik' data-id='"+odgovor[i].idRecept+"' data-headrecept='"+odgovor[i].headRecept+"' data-desc='"+odgovor[i].descriptionRecept+"' data-category ='"+odgovor[i].category_idKategorije+"' data-headtwo='"+odgovor[i].headerTwoRecept+"' data-desctwo='"+odgovor[i].descriptionTwoRecept+"' data-ingri='"+odgovor[i].ingredientsRecept+"' data-instruction='"+odgovor[i].instructionRecept+"'>" + odgovor[i].idRecept + " : " +odgovor[i].headRecept+"</div>");
            $(".korisnik").click(function(){
                $("#idRecept").val($(this).data("id"));
                $("#headRecept").val($(this).data("headrecept"));
                $("#descriptionRecept").val($(this).data("desc"));
                $("#category").val($(this).data("category"));
                $("#headTwoRecept").val($(this).data("headtwo"));
                $("#descriptionTwoRecept").val($(this).data("desctwo"));
                $("#ingredients").val($(this).data("ingri"));
                $("#instruction").val($(this).data("instruction"));
                
            });
    });
}
function ocistiSve(){
    $("input").val("");
    $("textarea").val("");
    //$("select").val("0");
    //data-category ='"+odgovor[i].category_idKategorije+"' deo koji treba da budem ubacen u append fuckboy
}


