package w3;

public class TestLoanCalculator {
    static void main(){
        LoanCalculator loanCal = new LoanCalculator();

        loanCal.setLoadDetails("Laptop",50000,5,2);
        loanCal.displayLoanDetails();
    }
}
