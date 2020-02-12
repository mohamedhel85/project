/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package projetpidev.entity;

/**
 *
 * @author LeaDzR
 */
public class Club {
    private int ID_club;
    private String nom_club;
    private String desc_club;
    private String logo_club;
    
    
    public Club(){}
    
    
    public Club(String nom_club,String desc_club,String logo_club){
    this.nom_club=nom_club;
    this.desc_club=desc_club;
    this.logo_club=logo_club;

    }

    public int getID_club() {
        return ID_club;
    }

    public void setID_club(int ID_club) {
        this.ID_club = ID_club;
    }

    public String getNom_club() {
        return nom_club;
    }

    public void setNom_club(String nom_club) {
        this.nom_club = nom_club;
    }

    public String getDesc_club() {
        return desc_club;
    }

    public void setDesc_club(String desc_club) {
        this.desc_club = desc_club;
    }

    public String getLogo_club() {
        return logo_club;
    }

    public void setLogo_club(String logo_club) {
        this.logo_club = logo_club;
    }

    @Override
    public String toString() {
        return "Club{" + "ID_club=" + ID_club + ", nom_club=" + nom_club + ", desc_club=" + desc_club + ", logo_club=" + logo_club + '}';
    }

    
    
}
