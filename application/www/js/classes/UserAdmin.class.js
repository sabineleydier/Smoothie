'use strict';

var UserAdmin = function() 
{
	this. = $('#firstName');
	this. = $('#lastName');
	this. = $('#userId') ; 
	this. = $('#Email');
	this. = $('#Admin');
};


UserAdmin.prototype.onChangeUser = function()
{
    var UserId;

    // Récupération de l'id de l'utilisateur sélectionné dans la liste déroulante.
    UserId = this.$UserId.val();

    /*
     * Exécution d'une requête HTTP GET AJAJ (Asynchronous JavaScript And JSON)
     * pour récupérer les informations de l'aliment sélectionné dans la liste déroulante.
     */
    $.getJSON
    (
        getRequestUrl() + '/meal?id=' + mealId, // URL vers un contrôleur PHP
        this.onAjaxChangeMeal.bind(this)        // Méthode appelée au retour de la réponse HTTP
    ); 
};