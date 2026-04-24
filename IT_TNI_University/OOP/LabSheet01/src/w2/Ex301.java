package w2;

import java.util.Scanner;

public class Ex301 {
    static void main(){
        Scanner sc = new Scanner(System.in);

        System.out.print("Enter a message to display on loop: ");
        String msg = sc.nextLine();

        System.out.print("Enter a number o loop: ");
        int loopNum = sc.nextInt();

        for (int i = 1; i <= loopNum; i++){
            System.out.print(i + " " + msg);
        }

    }
}
