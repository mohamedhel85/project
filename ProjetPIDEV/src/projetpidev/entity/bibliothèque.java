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
public class bibliothèque {
    private int id_b;
    private String nom_b;
    private String type;
    private String nom_matiere;
    private String fichier;
   
    
    
    public bibliothèque(){}
    
    public bibliothèque(int id_b, String nom_b, String type, String nom_matiere, String fichier) {
        this.id_b = id_b;
        this.nom_b = nom_b;
        this.type = type;
        this.nom_matiere = nom_matiere;
        this.fichier = fichier;
        
    }

    public int getId_b() {
        return id_b;
    }

    public void setId_b(int id_b) {
        this.id_b = id_b;
    }

    public String getNom_b() {
        return nom_b;
    }

    public void setNom_b(String nom_b) {
        this.nom_b = nom_b;
    }

    public String gettype() {
        return type;
    }

    public void settype(String type) {
        this.type = type;
    }

    public String getnom_matiere() {
        return nom_matiere;
    }

    public void setnom_matiere(String nom_matiere) {
        this.nom_matiere = nom_matiere;
    }

    public String getfichier() {
        return fichier;
    }

    public void setfichier(String fichier) {
        this.fichier = fichier;
    }

    

    @Override
    public String toString() {
        return "bibliothèque{" + "id=" + id_b + ", nom=" + nom_b + ", type=" + type + ", nom_matiere=" + nom_matiere + ", fichier=" + fichier + '}';
    }
    
    
    
}
