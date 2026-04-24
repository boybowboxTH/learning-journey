import javax.swing.*;
public class Lab205 {
    static void main(){
        int getMinute = Integer.parseInt(JOptionPane.showInputDialog(null,"Input minutes:"));

        int Hour = getMinute / 60;
        int Minute = getMinute % 60;

        JOptionPane.showMessageDialog(null, getMinute + " minutes is " + Hour + " hour " + Minute + " minute");
    }
}
