import java.util.Scanner;

public class Lab202 {
    static void main(){
        Scanner sc = new Scanner(System.in);

        System.out.print("Enter number 1: ");
        int num1 = sc.nextInt();

        System.out.print("Enter number 2: ");
        int num2 = sc.nextInt();

        System.out.println();

        System.out.println("Summation = " + (num1 + num2) +
                "\nSubtraction = " + (num1 - num2) +
                "\nMultiplication = " + (num1 * num2) +
                "\nDivision = " + ((double)num1 / num2) +
                "\nModulus = " + (num1 % num2));

    }
}
