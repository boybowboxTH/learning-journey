package w3;

import java.util.Scanner;

public class TestBMICalculator {
    static void main(){
        Scanner sc = new Scanner(System.in);

        System.out.print("Enter height: ");
        double height = sc.nextDouble();

        System.out.print("Enter weight: ");
        double weight = sc.nextDouble();

        BMICalculator bmi = new BMICalculator();

        bmi.setDetails(weight,height);
        System.out.println("BMI: " + bmi.calculateBMI());
        System.out.println("Category: " + bmi.getBMICategory());

    }
}
