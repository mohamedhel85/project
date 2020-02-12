/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projetpidev.service;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import projetpidev.Utils.JDBCSource;
import projetpidev.entity.cathegorie;

/**
 *
 * @author pc
 */
public class cathegorieService {
      
    Connection conn = JDBCSource.getInstance().getConnection();
      
     public void ajouterCathegorie(cathegorie c) throws SQLException{
        String query="INSERT INTO `cathegorie`( `nom_Cat`) VALUES (?)";
        PreparedStatement pst = conn.prepareStatement(query);
     //   pst.setString(1,String.valueOf(b.getId_b()));
        pst.setString(2,c.getNom_Cat());        
        pst.executeUpdate();  
       }
     
     
     public void afficherCathegorie(int  ID_Cat){
	
	PreparedStatement ps;
	ResultSet rs;
	try {
		String query="select * from cathegorie";
		ps=conn.prepareStatement(query);
		//ps.setString(1, sl_no);
		System.out.println(ps);
		rs=ps.executeQuery();
		while(rs.next()){
		System.out.println("identifiant"+rs.getInt("ID_Cat"));
		System.out.println("nom -"+rs.getString("nom_Cat"));                
		System.out.println("---------------");
		}
	} catch (Exception e) {
		System.out.println(e);
	}
}

     
     
      public void modifierBibliotheque(cathegorie c) throws SQLException{
        String query ="UPDATE `cathegorie` SET `nom_Cat`=?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(2,c.getNom_Cat());
        
        pst.executeUpdate();
    }
      
      
      public void supprimerCathegorie(cathegorie c){
	
	PreparedStatement ps;
	try {
		String query="delete from user where ID_Cat=?";
		ps=conn.prepareStatement(query);
		ps.setString(1, String.valueOf(c.getID_Cat()));
		System.out.println(ps);
		ps.executeUpdate();
	} catch (Exception e) {
		System.out.println(e);
	}

}
     
}
