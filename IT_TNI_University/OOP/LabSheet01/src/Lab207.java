import javax.swing.JOptionPane;
import java.text.DecimalFormat;
public class Lab207 {
    static void main(){
        DecimalFormat df = new DecimalFormat("#,###.00");
        JOptionPane.showMessageDialog(null,"Welcome to the payroll application");

        String emp_name = JOptionPane.showInputDialog(null,"Enter employee name:");
        int emp_TimeWork = Integer.parseInt(JOptionPane.showInputDialog(null,"Enter total hour for this employee:"));

        double earning = emp_TimeWork * 7.50;
        double tax = earning * 0.15;

        JOptionPane.showMessageDialog(null,"Employee name: " + emp_name +
                "\nHour worked: " + emp_TimeWork +
                "\nHourly wage: $7.50" +
                "\nGross earnings: $" + df.format(earning) +
                "\nTax rate: 0.15" +
                "\nTax: $" + df.format(tax) +
                "\nNet earnings: $" + df.format(earning - tax));

    }
}
