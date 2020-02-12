/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projetpidev.service;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import projetpidev.Utils.JDBCSource;
import projetpidev.entity.Club;

/**
 *
 * @author LeaDzR
 */
public class ClubService {
    Connection conn = JDBCSource.getInstance().getConnection();
    public void ajouterClub(Club c) throws SQLException{
        String query="INSERT INTO `club`(`nom_club`, `desc_club`, `logo_club`) VALUES (?,?,?)";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,c.getNom_club());
        pst.setString(2,c.getDesc_club());
        pst.setString(3,c.getLogo_club());
        pst.executeUpdate();
        System.out.println("club ajoutée");
    }
    public void UpdateClub(Club c) throws SQLException{
        String query ="UPDATE `club` SET `nom_club`=?,`desc_club`=?,`logo_club`=? WHERE ID_club =?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,c.getNom_club());
        pst.setString(2,c.getDesc_club());
        pst.setString(3,c.getLogo_club());
        pst.setString(4,String.valueOf(c.getID_club()));
        pst.executeUpdate();
        System.out.println("club modifie");
    }
    public void supprimerClub(Club c) throws SQLException{
        String query="DELETE FROM `club` WHERE ID_club=?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1,String.valueOf(c.getID_club()));
        pst.executeUpdate();
        System.out.println("club supprimé");
    }
    
}
