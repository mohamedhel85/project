/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projetpidev.service;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Calendar;
import java.util.Date;
import projetpidev.Utils.JDBCSource;
import projetpidev.entity.bibliothèque;

/**
 *
 * @author pc
 */
public class bibliothèqueService {

    private final static String UPLOAD_PATH = "C:/wamp64/www/ischool/uploads/bibliotheque/";
    Connection conn = JDBCSource.getInstance().getConnection();

    private String getExtension(File f) {
        return f.getName().substring(f.getName().lastIndexOf(".") + 1);
    }

    // Generates a random filename and returns it
    // This name will be stored in "fichier" field in database
    private String uploadFile(File f) {
        String fileExtension = getExtension(f);
        Date now = Calendar.getInstance().getTime();
        String uploadedFilename = String.valueOf(now.getTime()) + "." + fileExtension;

        File uploaded = new File(UPLOAD_PATH + uploadedFilename);
        try {
            FileInputStream fis = new FileInputStream(f);
            FileOutputStream fos = new FileOutputStream(uploaded);

            byte[] buffer = new byte[1024];
            int length;

            while ((length = fis.read(buffer)) > 0) {
                fos.write(buffer, 0, length);
            }
                fis.close();
                fos.close();
            return uploadedFilename;
        } catch (Exception e) {
            System.out.println(e.getMessage());
            return "";
        }
    }

    public void ajouterBibliotheque(bibliothèque b, File f) throws SQLException {

        String fileName = uploadFile(f);
        if (fileName == "") {
            System.out.println("Error uploading file");
            return;
        }

        b.setfichier(fileName);

        String query = "INSERT INTO `bibliothèque`( `nom_b`, `type`, `nom_matiere`, `fichier`) VALUES (?,?,?,?)";
        PreparedStatement pst = conn.prepareStatement(query);
        //   pst.setString(1,String.valueOf(b.getId_b()));
        pst.setString(1, b.getNom_b());
        pst.setString(2, b.gettype());
        pst.setString(3, b.getnom_matiere());
        pst.setString(4, b.getfichier());
        pst.executeUpdate();
    }

    public void afficherBibliotheque() {

        PreparedStatement ps;
        ResultSet rs;
        try {
            String query = "select * from bibliothèque";
            ps = conn.prepareStatement(query);
            //ps.setString(1, sl_no);
            System.out.println(ps);
            rs = ps.executeQuery();
            while (rs.next()) {
                System.out.println("identifiant" + rs.getInt("id_b"));
                System.out.println("nom -" + rs.getString("nom_b"));
                System.out.println("type -" + rs.getString("type"));
                System.out.println("nom_matiere -" + rs.getString("nom_matiere"));
                System.out.println("fichier -" + rs.getString("fichier"));
                System.out.println("---------------");
            }
        } catch (Exception e) {
            System.out.println(e);
        }
    }

    public void modifierBibliotheque(bibliothèque b) throws SQLException {
        String query = "UPDATE `bibliothèque` SET `nom_b`=?,`type`=?,`nom_matiere`=?,`fichier`=? WHERE id_b =?";
        PreparedStatement pst = conn.prepareStatement(query);
        pst.setString(1, b.getNom_b());
        pst.setString(2, b.gettype());
        pst.setString(3, b.getnom_matiere());
        pst.setString(4, b.getfichier());
        pst.setString(5, String.valueOf(b.getId_b()));
        pst.executeUpdate();
    }

    public void supprimerBibliotheque(bibliothèque b) {

        PreparedStatement ps;
        try {
            String query = "delete from bibliothèque where id_b=?";
            ps = conn.prepareStatement(query);
            ps.setString(1, String.valueOf(b.getId_b()));
            System.out.println(ps);
            ps.executeUpdate();
        } catch (Exception e) {
            System.out.println(e);
        }

    }

}
