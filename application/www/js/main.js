'use strict';





/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////
function onSubmitFormChange(e){
    e.preventDefault();

    // var form = $("#formPagePerso")[0];
    // var formData = new FormData(form);
    // console.log(form);
    // console.log(formData);

    var nom = $("#nom").val();
    var prenom = $("#prenom").val();
    var adresse = $("#adresse").val();
    var cp = $("#cp").val();
    var city = $("#city").val();
    var phone = $("#phone").val();
    
    console.log(nom, prenom, adresse, cp, city, phone);

    $.ajax({
        url : getRequestUrl() + "/user/login/pageperso",
        method :'post',
        dataType : 'json',
        data : {LastName : nom, FirstName : prenom , Address : adresse, ZipCode : cp, City : city, Phone : phone},
        
        success : function(){
            console.log("success");
        }
    })
}
function deleteProduct(e){
    e.preventDefault();

    // var selectedProduct = new FormData($('#formMealCheck input:checked')[0]);
    // console.log(selectedProduct);

    var tab = [];
    var balises = $('.products:checked');
    for(var i = 0; i < balises.length; i++){
        tab.push(balises[i].value);
    }

    //tab = Array.from(check);
    //tab.push(check);
    console.log(balises);
    console.log(tab);

    //Je fais un appel Ajax:
    $.ajax({
        url:getRequestUrl() + "/admin/meal",
        method:'post',
        datatype: 'json',
        data:  {tab : tab},     
        success: function (){
            // console.log("success");
            window.location.replace(getRequestUrl() + "/admin/meal");
            
            
        },
        error: function(){
            console.log("error");
        }
    });


}

 function addFavoris(e){
    e.preventDefault();

    var inter = $('#favoris').data('favoris');
    console.log(inter);
        
        var recette= $(location).attr('href');
        
        var newrecette =recette.split("=");
        var recette_Id = newrecette[1];
        
        if(inter == 'add'){
            //Je fais un appel Ajax:
            $.ajax({
                url:getRequestUrl() + "/favoris",
                method:'post',
                data: {recette_Id : recette_Id},
                datatype: 'json',
                success: function (data){
                    console.log("success");
                    
                    var inter = $('#favoris').data('favoris', 'delete');
                    location.reload();
                    
                },
                error: function(){
                    console.log("error");
                }

            });

        }else if(inter == 'delete'){
             $.ajax({
            url:getRequestUrl() + "/favoris/delete",
            method:'post',
            data: {recette_Id : recette_Id},
            datatype: 'json',
            success: function (data){
                console.log("success");
                
                    var inter = $('#favoris').data('favoris', 'add');
                    location.reload();
                    
            },
            error: function(){
                console.log("error");
            }

            });
        }

    }

function AjoutProduit(e){
    e.preventDefault();

    var $this = $(this);
    console.log($this);
    var id = $this.attr('data-id');
    var name = $this.attr('data-name');
    var quantity = $this.attr('data-quantity');
    var price = $this.attr('data-price');
    
    
    var panierTemp;

    console.log(id, name, quantity, price);
   
    panierTemp = new BasketSession();    
    panierTemp.add(id, name, quantity, price);
    $this.after('<div class="alert alert-success" role="alert">Votre produit a été ajouté au panier</div>')
    $(".alert-success").fadeOut(3000);

    

}






function runFormValidation()
{
    var $form;
    var formValidator;

    $form = $('form:not([data-no-validation=true])');

    // Y a t'il un formulaire à valider sur la page actuelle ?
    if($form.length == 1)
    {
        // Oui, exécution de la validation de formulaire.
        formValidator = new FormValidator($form);
        formValidator.run();
    }
}

function runOrderForm()
{
    var orderForm;
    var orderStep;

    orderForm = new OrderForm();

    // A quelle étape de la commande sommes-nous ?
    orderStep = $('[data-order-step]').data('order-step');

    switch(orderStep)
    {
        case 'run':
        orderForm.run();        // Commande en cours
        break;

        case 'success':
        orderForm.success();    // Succès du paiement de la commande
        break;
    }
}



/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

$(function()
{
    // Effet spécial sur la boite de notifications (le flash bag).
    $('#notice').delay(3000).fadeOut('slow');


    // Exécution de la validation de formulaire si besoin.
    runFormValidation();

    // Exécution de la gestion du processus de commande si besoin.
    if(typeof OrderForm != 'undefined')
    {
        runOrderForm();
        
    }

   
    $("#favoris").on('click', addFavoris);
    
    $(".panierTemp").on('click' ,AjoutProduit);
    
    $("#boutonSupprimer").on('click', deleteProduct);
    $("#formPagePerso").on("submit", onSubmitFormChange);
   



}); 



