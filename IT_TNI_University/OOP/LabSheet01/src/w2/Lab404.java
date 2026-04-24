package w2;

import java.util.Scanner;

public class Lab404 {
    static void main(){
        Scanner sc = new Scanner(System.in);

        System.out.print("Enter word: ");
        String word = sc.nextLine();
        String text = "";

        while(!word.equalsIgnoreCase("stop")){
            text = text.concat(word + " ");
            System.out.print("Enter word: ");
            word = sc.nextLine();
        }
        System.out.println(text);


    }
}
