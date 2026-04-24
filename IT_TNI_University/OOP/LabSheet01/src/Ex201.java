import java.text.DecimalFormat;
public class Ex201 {
    static void main(){
        DecimalFormat df = new DecimalFormat("#,###.00");

        String productId = "PD-001";
        String productName = "Pencil box";
        int productQuantity = 112;
        float productPrice = 30.20f;

        System.out.println("Product name: " + productName + " ("+productId+")");
        System.out.println("Product item: " + productQuantity + " ("+df.format(productPrice)+" bath/piece)");

        float totalPrice = productQuantity * productPrice;
        System.out.println("Total price: " + df.format(totalPrice) + " bath");
    }
}
