import java.util.Scanner;
import java.text.DecimalFormat;
public class Lab203 {
    static void main(){
        Scanner sc = new Scanner(System.in);
        DecimalFormat df = new DecimalFormat("#,###.00");

        System.out.print("Enter product id      : ");
        String productId = sc.nextLine();

        System.out.print("Enter product name    : ");
        String productName = sc.nextLine();

        System.out.print("Enter product item    : ");
        int productQuantity = sc.nextInt();

        System.out.print("Enter price per piece : ");
        double productPrice = sc.nextDouble();

        System.out.println("----------------------------------------");

        System.out.println("Product name: " + productName + " ("+ productId +")" +
                "\nProduct item: " + productQuantity +" (" + df.format(productPrice) + " baht/piece)" +
                "\nTotal price : " + df.format(productPrice * productQuantity) + "baht");

    }
}
