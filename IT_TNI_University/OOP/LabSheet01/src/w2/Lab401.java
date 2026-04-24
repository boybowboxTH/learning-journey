package w2;

import javax.swing.*;

public class Lab401 {
    static void main(){
        String fullName = JOptionPane.showInputDialog("Enter your full name");

        while(fullName.trim().indexOf(" ") == -1) {
            fullName = JOptionPane.showInputDialog("Enter your full name");
        }

        String firstName = fullName.substring(0,fullName.indexOf(" "));
        String LastName = fullName.substring(fullName.indexOf(" ")+1);

        char charFirstName = firstName.toUpperCase().charAt(0);
        String secondName = firstName.toLowerCase().substring(1);
        firstName = charFirstName+secondName;

        JOptionPane.showMessageDialog(null,"Welcome, " + firstName + " " + LastName.toUpperCase());
    }
}
