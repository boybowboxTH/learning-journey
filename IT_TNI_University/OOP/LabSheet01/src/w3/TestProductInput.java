package w3;

import java.util.Scanner;

public class TestProductInput {
    static void main(){
        Product pro1 = new Product();
        Scanner sc = new Scanner(System.in);

        System.out.print("Enter Product Name: ");
        String name = sc.nextLine();

        System.out.print("Enter Product price: ");
        double price = sc.nextDouble();

        System.out.print("Enter VAT rate (%): ");
        double vat = sc.nextDouble();

        pro1.setProductDetails(name,price,vat);

        pro1.displayProductDetails();

    }
}
