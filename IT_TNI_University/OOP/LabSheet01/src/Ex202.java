import java.util.Scanner;
public class Ex202 {
    static void main(){
        Scanner input = new Scanner(System.in);

        System.out.print("Enter student-id: ");
        String studentId = input.nextLine();
        System.out.print("Enter student name: ");
        String studentName = input.nextLine();

        System.out.println();
        System.out.println("Student-Id : " + studentId);
        System.out.println("Student name : " + studentName);
    }
}
