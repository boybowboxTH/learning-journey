package w5;

public class DemoCar {
    static void main(String[] args){
        Car car = new Car("Chevrolet", "Cruze", 2009,150000.0);

        car.showMsg();

        System.out.println();
        System.out.println("Updated Car Details:");
        car.setCompanyName("Toyota");
        car.setModelName("Corolla");
        car.setYear(2015);

        System.out.println("Company Name: " + car.getCompanyName());
        System.out.println("Model Name: " + car.getModelName());
        System.out.println("Year: " + car.getYear());

        car.setYear(100);
        car.setModelName(null);

    }
}
