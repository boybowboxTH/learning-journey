package w2;

import java.util.Scanner;

public class Ex401 {
    static void main(){
        Scanner sc = new Scanner(System.in);

        System.out.print("Enter a string: ");
        String s = sc.nextLine();

        System.out.println("Length message : " + s.length());

        System.out.println("Uppercase :" + s.toUpperCase());

        System.out.println("Lowercase :" + s.toLowerCase());

        System.out.println("First character : " + s.charAt(0));

        System.out.println("character : " + s.charAt(s.length() - 1));
    }
}
