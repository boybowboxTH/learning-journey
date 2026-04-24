package w2;

import javax.swing.JOptionPane;
public class Ex301_1 {
    static void main() {
        double totalPrice = Double.parseDouble(
                JOptionPane.showInputDialog("Enter total price:"));

        //แสดงข้อความ confirm ว่ามีคูปองหรือไม่
        int coupon = JOptionPane.showConfirmDialog(null,
                "Do you have a coupon?");

        int discountRate;
        double discountBaht,priceAfterDiscount;

        if(coupon == JOptionPane.YES_OPTION) { //if(coupon == 0)
            discountRate = Integer.parseInt(
                    JOptionPane.showInputDialog("How many discount(%) on the coupon?"));
            discountBaht = totalPrice * discountRate/100;
            priceAfterDiscount = totalPrice - discountBaht;

            JOptionPane.showMessageDialog(null,
                    "You get discount "+
                            discountBaht + "baht."+
                            "\nTotal price is" + priceAfterDiscount+" baht.");
        }
        else{ //ถ้าไม่มีคูปอง
            if(totalPrice>=1500){
                discountBaht = totalPrice * 10/100;
                priceAfterDiscount =  totalPrice - discountBaht;
                JOptionPane.showMessageDialog(null,
                        "You get discount 10% (" + discountBaht + ")" +
                                "\nTotal price is" + priceAfterDiscount+" baht.");
            }
            else {
                JOptionPane.showMessageDialog(null,
                        "Total price is " + totalPrice + " baht.");
            }
        }
    }
}
