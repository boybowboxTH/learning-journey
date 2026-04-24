package w3;

public class TestEmployees {
    static void main(){
        Employee emp1 = new Employee();
        Employee emp2 = new Employee();

        emp1.setEmployeeDetails("John",45,20.0);
        emp2.setEmployeeDetails("Jane",38,25.0);

        System.out.println("Employee#1 details");
        emp1.displayEmployeeDetails();

        System.out.println();
        System.out.println("Employee#2 detail");
        emp2.displayEmployeeDetails();
    }
}
