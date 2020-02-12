/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projetpidev;

import projetpidev.entity.User;
import projetpidev.service.SessionService;
import projetpidev.service.UserService;
import projetpidev.Utils.JDBCSource;
import java.sql.SQLException;
import java.util.List;
import projetpidev.entity.Club;
import projetpidev.service.ClubService;

/**
 *
 * @author ASUS
 */
public class ProjetPIDEV {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws SQLException {
        // TODO code application logic here
        JDBCSource jdbc = JDBCSource.getInstance();
        User u = new User(1, "mohamed", "helali", "mohamed.helali@esprit.tn", "test", 55151858, "STAFF", "UNLOCKED");
        UserService us = new UserService();
        //us.ajouterUser(u);
/*------------------upadteinfouser------------------*/        
//u.setNom("ALI2");
        //u.setPrenom("nait");
       // u.setNum_tel(98898988);
        //u.setEmail("ali.nait@esprit.tn");
        //us.UpdateUser(u);
        //u.setMdp("testali");
        //us.updateMdp(u);
  /*-------------------Delete------------------------*/
  //us.supprimerUser(u);
  /*-----------------lock&unlock account------------*/
  //us.LockUserAccount(u);
  us.UnlockUserAccount(u);
  /*----------------Afficher detail user ------------*/
  //us.afficherDetailUser("1");
  //us.countUser();
  /*----------------Afficher liste utilisateur---------*/
  //List<User>list;
  //list=us.afficherListUser();
       // System.out.println(list);
  //list=us.afficherListUserParRole("STAFF");
    //    System.out.println(list);
    //list=us.afficherListUserParEtat("LOcKED");
      //  System.out.println(list);
  /*--------------------session-------------------------*/
  SessionService ss = new SessionService();
   ss.login(u);
  //ss.logout(u);
  ss.countConnectedUser();
  /*-------------------club-----------------------------*/
  Club c = new Club("firas", "firas", "logo_club");
  ClubService cs = new ClubService();
  //cs.ajouterClub(c);
  c.setID_club(1);
  c.setDesc_club("azerty");
  //cs.UpdateClub(c);
  cs.supprimerClub(c);
  
    }
    
}
