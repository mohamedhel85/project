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
import projetpidev.entity.bibliothèque;

/**
 *
 * @author pc
 */
public class bibliothèqueService {
      
    Connection conn = JDBCSource.getInstance().getConnection();
      
     public void ajouterBibliotheque(bibliothèque b) throws SQLException{
        String query="INSERT INTO `bibliothèque`( `nom_b`, `type`, `nom_matiere`, `fichier`) VALUES (?,?,?,?)";
        PreparedStatement pst = conn.prepareStatement(query);
     //   pst.setString(1,String.valueOf(b.getId_b()));
        pst.setString(2,b.getNom_b());
        pst.setString(3,b.gettype());
        pst.setString(4,b.getnom_matiere());
        pst.setString(5,b.getfichier());
        pst.executeUpdate();  
       }
     
     
     public void afficherBibliotheque(int  id_b){
	
	PreparedStatement ps;
	ResultSet rs;
	try {
		String query="select * from bibliothèque";
		ps=conn.prepareStatement(query);
		//ps.setString(1, sl_no);
		System.out.println(ps);
		rs=ps.executeQuery();
		while(rs.next()){
		System.out.println("identifiant"+rs.getInt("id_b"));
		System.out.println("nom -"+rs.getString("nom_b"));
                System.out.println("type -"+rs.getString("type"));
		System.out.println("nom_matiere -"+rs.getString("nom_matiere"));
                System.out.println("fichier -"+rs.getString("fichier"));
		System.out.println("---------------");
		}
	} catch (Exception e) {
		System.out.println(e);
	}
}

     
     
      public void modifierBibliotheque(bibliothèque b) throws SQLException{
        String query ="UPDATE `bibliothèque` SET `nom_b`=?,`type`=?,`nom_matiere`=?, `fichier`=? WHERE id_b =?";
        PreparedStatement pst = conn.prepareStatement(query);
       pst.setString(2,b.getNom_b());
        pst.setString(3,b.gettype());
        pst.setString(4,b.getnom_matiere());
        pst.setString(5,b.getfichier());;
        pst.executeUpdate();
    }
      
      
      public void supprimerBibliotheque(bibliothèque b){
	
	PreparedStatement ps;
	try {
		String query="delete from user where id_b=?";
		ps=conn.prepareStatement(query);
		ps.setString(1, String.valueOf(b.getId_b()));
		System.out.println(ps);
		ps.executeUpdate();
	} catch (Exception e) {
		System.out.println(e);
	}

}
     
}