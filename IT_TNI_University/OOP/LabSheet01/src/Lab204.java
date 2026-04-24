import java.util.Scanner;
public class Lab204 {
    static void main(){
        Scanner sc = new Scanner(System.in);

        System.out.print("Input hour : ");
        int hour = sc.nextInt();

        System.out.print("Input hour : ");
        int minute = sc.nextInt();

        int hourTomin = hour * 60;

        System.out.println("Total time is " + (hourTomin + minute) + " minutes");
    }
}
