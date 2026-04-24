import javax.swing.*;
import java.text.*;
public class Ex203 {
    static void main(){
        DecimalFormat df = new DecimalFormat("#,###.00");
        final int fee_credit_lecture = 1900;
        final int fee_credit_lab = 3500;

        String srtCreditLecture = JOptionPane.showInputDialog(null,"How many credits of lecture courses that you registerd : ");
        int creditLecture = Integer.parseInt(srtCreditLecture);

        int creditLab = Integer.parseInt(JOptionPane.showInputDialog(null,"How many credits of lab courses that you registerd : "));

        int totalCredit_Lecture = fee_credit_lecture * creditLecture;
        int totalCredit_Lab = fee_credit_lab * creditLab;

        int paymentCourse = totalCredit_Lab + totalCredit_Lecture;

        JOptionPane.showMessageDialog(null,"Lecture: " + creditLecture + "x" + fee_credit_lecture + "=" + df.format(totalCredit_Lecture) +
                "\nLaboratory: " + creditLab + "x" + fee_credit_lab + "=" + df.format(totalCredit_Lab) +
                "\nTotal price: " + df.format(paymentCourse));

    }
}
