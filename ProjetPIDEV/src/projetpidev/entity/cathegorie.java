/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projetpidev.entity;

/**
 *
 * @author ASUS
 */
public class cathegorie {
    private int ID_Cat;
    private String nom_Cat;
    
   
    
    public cathegorie(){}
    
    public cathegorie(int ID_Cat, String nom_Cat) {
        this.ID_Cat = ID_Cat;
        this.nom_Cat = nom_Cat;
        
        
    }

    public int getID_Cat() {
        return ID_Cat;
    }

    public void setID_Cat(int ID_Cat) {
        this.ID_Cat = ID_Cat;
    }

    public String getNom_Cat() {
        return nom_Cat;
    }

    public void setNom_Cat(String nom_Cat) {
        this.nom_Cat = nom_Cat;
    }

    
        @Override
    public String toString() {
        return "cathegorie{" + "id=" + ID_Cat + ", nom=" + nom_Cat + '}';
    }
    
}
