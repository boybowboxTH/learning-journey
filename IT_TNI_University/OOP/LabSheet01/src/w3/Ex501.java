package w3;

import java.util.Scanner;

public class Ex501 {
    static void main(){
        Scanner sc = new Scanner(System.in);

        System.out.print("Enter an integer: ");
        int number = sc.nextInt();

        //boolean inNumber = true;

        boolean inNumber = is_even(number);
        if(inNumber){
            System.out.println("Your number is: even number");
        }else{
            System.out.println("Your number is: odd number");
        }


        String sentence = check_type_number(number);
        System.out.print("Your number is: " + sentence);
    }
    static boolean is_even(int num){
        if(num % 2 == 0)
            return true;
        else
            return false;
    }

    static  String check_type_number(int num){
        if(num>0){
            return "Positive number";
        } else if (num<0) {
            return "Negative number";
        }
        return "Zero number";
    }

}
