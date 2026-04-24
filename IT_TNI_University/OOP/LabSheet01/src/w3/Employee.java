package w3;

public class Employee {
    String name;
    int hoursWorked;
    double hourlyRate;

    public void setEmployeeDetails(String name, int hoursWorked, double hourlyRate) {
        this.name = name;
        this.hoursWorked = hoursWorked;
        this.hourlyRate = hourlyRate;
    }

    public  double calculateSalary(){
        double totalSalary = hourlyRate * hoursWorked;
        if(hoursWorked > 40){
            totalSalary = totalSalary + totalSalary*0.1;
        }
        return totalSalary;
    }

    public void displayEmployeeDetails(){
        System.out.println("Name: " + name);
        System.out.println("Hours Worked: " + hoursWorked);
        System.out.println("Hourly Rate: " + hourlyRate);
        System.out.println("Salary: " + calculateSalary());
    }
}
