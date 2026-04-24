package w2;

import java.util.Scanner;

public class Lab405 {
    static void main(){
        Scanner sc = new Scanner(System.in);

        System.out.print("Input some sentence: ");
        String sentence = sc.nextLine();
        int spaceIndex;

        while (sentence.charAt(sentence.length() - 1) != '.'){
            System.out.print("The sentence must end with full stop point: ");
            sentence = sc.nextLine();

        }
        System.out.println(" ");

        while((spaceIndex = sentence.indexOf(' ')) != -1){
            String word  = sentence.substring(0,spaceIndex);

            System.out.println(word);

            sentence = sentence.substring(spaceIndex + 1);
        }
        System.out.println(sentence);
    }
}
