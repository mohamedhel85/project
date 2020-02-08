/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projetpidev.Utils;

import com.mysql.jdbc.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 *
 * @author ASUS
 */
public class JDBCSource {
    Connection conn;
    String url="jdbc:mysql://localhost:3306/projet";
    String user="root";
    String password="";
    static JDBCSource instance;
    private JDBCSource(){
        try{
        conn= (Connection) DriverManager.getConnection(url, user, password);
        System.out.println("success, establi4shed connection with database "+conn.getCatalog());
        } catch(SQLException ex){
            System.out.println(ex.getMessage());
        }
        
    }
    public static JDBCSource getInstance(){
            if(instance==null)
                instance= new JDBCSource();
        return instance;
        }
    
    public Connection getConnection(){
        return conn;
    }
    
}
