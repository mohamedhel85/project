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
public class Session {
    private int ID_session;
    private int ID_user;
    public Session(){}
    public Session(int ID_user) {
        this.ID_user = ID_user;
    }

    public int getID_session() {
        return ID_session;
    }

    public void setID_session(int ID_session) {
        this.ID_session = ID_session;
    }

    public int getID_user() {
        return ID_user;
    }

    public void setID_user(int ID_user) {
        this.ID_user = ID_user;
    }

    @Override
    public String toString() {
        return "Session{" + "ID_session=" + ID_session + ", ID_user=" + ID_user + '}';
    }
    
    
    
}
