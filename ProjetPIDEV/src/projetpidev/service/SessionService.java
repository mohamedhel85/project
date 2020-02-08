/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projetpidev.service;

import projetpidev.Utils.JDBCSource;
import java.sql.PreparedStatement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import projetpidev.entity.Session;
import projetpidev.entity.User;

/**
 *
 * @author ASUS
 */
public class SessionService {
    
    Connection conn=JDBCSource.getInstance().getConnection();
    
    public Boolean createSession(Session s) throws SQLException{
        //String query2="INSERT INTO `session`(`ID_user`) VALUES ('"+s.getID_user()+"')";
        String query = "select * from session where ID_user='"+s.getID_user()+"'";
        String query2="INSERT INTO `session`(`ID_user`) VALUES ('"+s.getID_user()+"') ON DUPLICATE KEY UPDATE ID_user='"+s.getID_user()+"'";
        Statement st= conn.createStatement();
        if(st.executeQuery(query).next()==true){
            System.out.println("you are already connected.");
        return false;
    }else
        st.executeUpdate(query2);
        /*PreparedStatement rs2 = conn.prepareStatement(query2);
                    rs2.setString(1, String.valueOf(s.getID_user()));
                    rs2.executeUpdate(query2);*/
        return true;
    }
    public void destroySession(Session s) throws SQLException{
        String query="DELETE FROM `session` WHERE ID_user=?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,String.valueOf(s.getID_user()));
        pst.executeUpdate();
        System.out.println("logout");
    }
    
    public void login(User u) throws SQLException{
        Session s;
        String query ="SELECT * FROM `user` WHERE Email=? AND Mdp=?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1, u.getEmail());
        pst.setString(2, u.getMdp());
        ResultSet rs=pst.executeQuery();
        while(rs.next()){
            //System.out.println(rs.getString("Etat"));
            if(rs.getString("Etat").equals("LOCKED")){
                System.out.println("unable to connect to your acount, please contact the admin for additional support....");
                break;}
            
            if(rs.getString("Etat").equals("UNLOCKED")){
                
            if(rs.getString("Role_user").equals("STAFF")){
                    s= new Session(rs.getInt(1));
                    if(this.createSession(s)) {
                    System.out.println("A staff member has connected...,welcome "+rs.getString("Nom")+" "+rs.getString("Prenom"));
                    break;}
            }
            
            if(rs.getString("Role_user").equals("ELEVE")){
                  s= new Session(rs.getInt(1));
                  if(this.createSession(s)){
                    System.out.println("A student has connected...,welcome "+rs.getString("Nom")+" "+rs.getString("Prenom"));
                    break;}
                    
                }
            
            if(rs.getString("Role_user").equals("ENSEIGNANT")){
                    s= new Session(rs.getInt(1));
                    if(this.createSession(s)){
                    System.out.println("A teacher has connected...,welcome "+rs.getString("Nom")+" "+rs.getString("Prenom"));
                    break;}
                    
                }
            
            if(rs.getString("Role_user").equals("PARENT")){
                    s= new Session(rs.getInt(1));
                    if(this.createSession(s)){
                    System.out.println("A parent has connected...,welcome "+rs.getString("Nom")+" "+rs.getString("Prenom"));
                    break;}
                }
            
            }
            else{
                System.out.println("the account entred does not exist....");
           }
            
        }
        
        //System.out.println("fin login");   
    }
    public void logout (User u) throws SQLException{
    Session s= new Session(u.getId());
    this.destroySession(s);
        //System.out.println("fin logout");
    }
    
    public void countConnectedUser() throws SQLException{
    String query="select count(`ID_user`) from session";
    Statement st = conn.createStatement();
    ResultSet rs=st.executeQuery(query);
    while(rs.next()){
        System.out.println("nombre total des users connectées dans le systeme est egale a "+ rs.getInt(1));
    }
    
}
}
