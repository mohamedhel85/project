/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projetpidev.service;

import projetpidev.Utils.JDBCSource;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import projetpidev.entity.User;

/**
 *
 * @author ASUS
 */
public class UserService {
    Connection conn = JDBCSource.getInstance().getConnection();
    public void ajouterUser(User u) throws SQLException{
        String query="INSERT INTO `user`(`ID_user`, `Nom`, `Prenom`, `Email`, `Mdp`, `Num_tel`, `Role_user`, `Etat`) VALUES (?,?,?,?,?,?,?,?)";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,String.valueOf(u.getId()));
        pst.setString(2,u.getNom());
        pst.setString(3,u.getPrenom());
        pst.setString(4,u.getEmail());
        pst.setString(5,u.getMdp());
        pst.setString(6,String.valueOf(u.getNum_tel()));
        pst.setString(7,u.getRole_user());
        pst.setString(8,u.getEtat());
        pst.executeUpdate();
    }
    public void UpdateUser(User u) throws SQLException{
        String query ="UPDATE `user` SET `Nom`=?,`Prenom`=?,`Email`=?, `Num_tel`=?,`Role_user`=? WHERE ID_user =?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,u.getNom());
        pst.setString(2,u.getPrenom());
        pst.setString(3,u.getEmail());
        pst.setString(4,String.valueOf(u.getNum_tel()));
        pst.setString(5,u.getRole_user());
        pst.setString(6,String.valueOf(u.getId()));
        pst.executeUpdate();
    }
    public void updateMdp(User u) throws SQLException{
        String query ="UPDATE `user` SET `Mdp`=? WHERE ID_user =?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,u.getMdp());
        pst.setString(2,String.valueOf(u.getId()));
        pst.executeUpdate();
        
    }
    public void supprimerUser(User u) throws SQLException{
        String query="DELETE FROM `user` WHERE ID_user=?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,String.valueOf(u.getId()));
        pst.executeUpdate();
    }
    
    public void LockUserAccount(User u) throws SQLException{
        String query="UPDATE `user` SET `Etat`=? WHERE ID_user =?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,"LOCKED");
        pst.setString(2,String.valueOf(u.getId()));
        pst.executeUpdate();
    }
    public void UnlockUserAccount(User u) throws SQLException{
        String query="UPDATE `user` SET `Etat`=? WHERE ID_user =?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,"UNLOCKED");
        pst.setString(2,String.valueOf(u.getId()));
        pst.executeUpdate();
    }
    public void afficherDetailUser(String id) throws SQLException{
        String query="SELECT * FROM `user` WHERE `ID_user` =?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,id);
        ResultSet rs=pst.executeQuery();
        while(rs.next()){
            User user = new User();
            user.setId(rs.getInt("ID_user"));
            user.setNom(rs.getString("Nom"));
            user.setPrenom(rs.getString("Prenom"));
            user.setEmail(rs.getString("Email"));
            user.setNum_tel(rs.getInt("Num_tel"));
            user.setRole_user(rs.getString("Role_user"));
            user.setEtat(rs.getString("Etat"));
            System.out.println(user.toString());
        }
        }
    
    public List<User> afficherListUser() throws SQLException{
        List<User> list = new ArrayList<>();
        String query="select * from user order by Nom ";
        Statement st = conn.createStatement();
        ResultSet rs= st.executeQuery(query);
        while(rs.next()){
            User user = new User();
            user.setId(rs.getInt("ID_user"));
            user.setNom(rs.getString("Nom"));
            user.setPrenom(rs.getString("Prenom"));
            user.setEmail(rs.getString("Email"));
            user.setNum_tel(rs.getInt("Num_tel"));
            user.setRole_user(rs.getString("Role_user"));
            user.setEtat(rs.getString("Etat"));
            list.add(user);
        }
        return list;
    }
    
    public List<User> afficherListUserParRole(String role) throws SQLException{
        List<User> list = new ArrayList<>();
        String query="SELECT * FROM `user` WHERE `Role_user` =?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,role);
        ResultSet rs=pst.executeQuery();
        while(rs.next()){
            User user = new User();
            user.setId(rs.getInt("ID_user"));
            user.setNom(rs.getString("Nom"));
            user.setPrenom(rs.getString("Prenom"));
            user.setEmail(rs.getString("Email"));
            user.setNum_tel(rs.getInt("Num_tel"));
            user.setRole_user(rs.getString("Role_user"));
            user.setEtat(rs.getString("Etat"));
            list.add(user);
        }
        return list;
    }
    
    public List<User> afficherListUserParEtat(String etat) throws SQLException{
        List<User> list = new ArrayList<>();
        String query="SELECT * FROM `user` WHERE `Etat` =?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,etat.toUpperCase());
        ResultSet rs=pst.executeQuery();
        while(rs.next()){
            User user = new User();
            user.setId(rs.getInt("ID_user"));
            user.setNom(rs.getString("Nom"));
            user.setPrenom(rs.getString("Prenom"));
            user.setEmail(rs.getString("Email"));
            user.setNum_tel(rs.getInt("Num_tel"));
            user.setRole_user(rs.getString("Role_user"));
            user.setEtat(rs.getString("Etat"));
            list.add(user);
        }
        return list;
    }
    public void countUser() throws SQLException{
    String query="select count(`ID_user`) from user";
    Statement st = conn.createStatement();
    ResultSet rs=st.executeQuery(query);
    while(rs.next()){
        System.out.println("nombre total des users enregistrer dans le systeme est egale a "+ rs.getInt(1));
    }
    }
    
    
}
