<?php


class UserController
{
	public function httpGetMethod(Http $http)
	{

        $userSession = new UserSession();
        if($userSession->getAdmin() != 1)
        {
           $http->redirectTo('/user/login');
        }
      
        $userSession = new UserModel();
        $users = $userSession->selectAllUsers();
		return [ 
         'users' => $users,   
         '_form' => new AdminUserForm() 
         ];
	}

	public function httpPostMethod(Http $http, array $formFields)
	{
        $userSession = new UserSession();
        if($userSession->getAdmin() != 1)
        {
           $http->redirectTo('/user/login');
        }

		try
		{

			// Inscription de l'utilisateur en tant qu'administrateur.
            $userAccountModel = new UserAccountModel();
            $userAccountModel->create
			(
				$formFields['email'],
				$formFields['password']
			);

            // Redirection vers le panneau d'administration.
            $http->redirectTo('/admin');
		}
		catch(DomainException $exception)
		{
            // Réaffichage du formulaire avec un message d'erreur.
            $form = new AdminUserForm();
            $form->bind($formFields);
            $form->setErrorMessage($exception->getMessage());

			return [ '_form' => $form ];
		}
	} 
}