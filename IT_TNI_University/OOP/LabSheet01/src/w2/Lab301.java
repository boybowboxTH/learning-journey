package w2;

import java.util.Scanner;

public class Lab301 {
    static void main(){
        Scanner sc = new Scanner(System.in);

        System.out.print("Enter the first number: ");
        int number1 = sc.nextInt();

        System.out.print("Enter the first number: ");
        int number2 = sc.nextInt();

        for(int i = number1; i <= number2; i++){
            System.out.print(i + " ");
        }

        System.out.println("");

        // even number
        for(int i = number1; i <= number2; i++){
            if(i%2 == 0){
                System.out.print(i + " ");
            }

        }
    }
}
