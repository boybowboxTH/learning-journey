package w3;

public class Product {
    String name;
    double price;
    double vatRate;

    public void setProductDetails(String name,double price, double vatRate){
        this.name = name;
        this.price = price;
        this.vatRate = vatRate;
    }

    public double calculateTotalPrice(){
        double total = price + ((price*vatRate)/100);
        return total;
    }

    public void displayProductDetails(){
        System.out.println("Product Details:");
        System.out.println("Product Name: " + name);
        System.out.println("Price (Before VAT): " + price);
        System.out.println("Price (After VAT): " + calculateTotalPrice());
    }

}
