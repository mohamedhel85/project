# project
This is our project repository
# update 10/02/2020
-changed database name to ischool.
-add personne table to database.
# update 09/02/2020
-added databse SQL script file.
# update 08/02/2020
## account management module version 0.1a
the module is composed of:

-user entity

-session entity


-userService a class containing all methode related to the user management.

-the userService class contains the following methodes:


	-ajouterUser(User u): a methode that allows the creation of a new user.

	-UpdateUser(User u):  a methode that allows the creation of a new user.

	-updateMdp(User u): a methode that allows the modification of the user's account password.

	-supprimerUser(User u):a methode that allows the deletion of user account.

	-LockUserAccount(User u): a methode that  lockes the user account.

	-UnlockUserAccount(User u): a methode that unlockes the user account.

	-afficherDetailUser(String id): a methode that displays user details.

	-afficherListUser(): returns the list of all registred users in the system.

	-afficherListUserParRole(String role): returns the list of all registred users in the system by role.

	-afficherListUserParEtat(String etat):returns the list of all registred users in the system by account status.

	-countUser(): return the total number  of all registred user in the system.


-SessionService aclass containing all methode related to the session management.

the SessionService class contains the following methodes:

        -createSession(Session s): a methode that create a new session.(this methode will check if the user is already connected before creation a new session).

	-DestroySession(Session s):a methode that destroy a specific user session.

	-login(User u): a methode that allow the user to login to his account.

        -the login methode operate as follows:

	-the methode will first check if the user is already registred in the system

	-the methode will check the status of his/her account.

	-the methode will check the user role in order to display the appropriate interface

	-logout (User u): this methode will allow the user to logout from his/her account.

	-countConnectedUser(): this methode will return the number of all users currently connected to the application.
