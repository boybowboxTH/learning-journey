package w2;

import javax.swing.*;

public class Lab402 {
    static void main(){
        String stu_id = JOptionPane.showInputDialog("Enter student-id:");
        String major;

        while(stu_id.length() != 10){
            stu_id = JOptionPane.showInputDialog("Enter student-id:");
        }
        String major_id = stu_id.substring(2,5);

        switch (major_id){
            case "131":
                JOptionPane.showMessageDialog(null,"Student ID: " + stu_id +
                        "\nMajor: " + "Information Technology (IT)"); break;
            case "132":
                JOptionPane.showMessageDialog(null,"Student ID: " + stu_id +
                        "\nMajor: " + "Multimedia Technology (MT)"); break;
            case "133":
                JOptionPane.showMessageDialog(null,"Student ID: " + stu_id +
                        "\nMajor: " + "Digital Business Information Technology (BI)"); break;
            case "134":
                JOptionPane.showMessageDialog(null,"Student ID: " + stu_id +
                        "\nMajor: " + "Digital Technology in Mass Communication (DC)"); break;
            case "135":
                JOptionPane.showMessageDialog(null,"Student ID: " + stu_id +
                        "\nMajor: " + "Data Science and Data Analytics (DS)"); break;
            default: JOptionPane.showMessageDialog(null,"Student ID: " + stu_id +
                    "\nMajor: " + "Cannot found major"); break;
        }


    }

}
