package w2;
import javax.swing.*;

public class Lab403 {
    static void main(){
        String ad_username = "admin";
        String ad_password = "Admin1234";

        String username = JOptionPane.showInputDialog("Enter username:");
        String password = JOptionPane.showInputDialog("Enter password:");

        while(!(username.equalsIgnoreCase(ad_username) && password.equals(ad_password))){
            JOptionPane.showMessageDialog(null,"Login Fail...", "Incorrect username or password", JOptionPane.WARNING_MESSAGE);
            username = JOptionPane.showInputDialog("Enter username:");
            password = JOptionPane.showInputDialog("Enter password:");
        }
        JOptionPane.showMessageDialog(null,"Login Success!!");

    }
}
