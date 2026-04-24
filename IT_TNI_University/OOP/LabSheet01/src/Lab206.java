import javax.swing.*;
import java.text.DecimalFormat;
public class Lab206 {
    static void main(){
        DecimalFormat df = new DecimalFormat("#,####.00");

        int numCus = Integer.parseInt(JOptionPane.showInputDialog(null,"How many customer?"));

        double sumPriceWithNet = (numCus * 299) + ((numCus * 299) * 0.07);

        int discount = Integer.parseInt(JOptionPane.showInputDialog(null,"Price with NET is " + sumPriceWithNet + " baht." + "\nHow much of discount(%) on your coupon?"));

        double totalPrice = sumPriceWithNet - (sumPriceWithNet * ((double) discount / 100));

        double cash = Double.parseDouble(JOptionPane.showInputDialog(null,"Total price is " + df.format(totalPrice) + " baht." +
                "\nEnter the amount the customer paid:"));

        JOptionPane.showMessageDialog(null,"Total price is " + df.format(totalPrice) + " baht." +
                "\nCustomer paid " + df.format(cash) + " baht." + "\nGet change " + df.format(cash - totalPrice) + " baht.");
    }
}
