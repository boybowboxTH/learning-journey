package w3;

public class BMICalculator {
    private double weight;
    private double height;

    public void setDetails(double weight,double height){
        this.weight = weight;
        this.height = height;
    }

    public double calculateBMI(){
        double heightCm = height/100;
        return weight / (heightCm*heightCm);
    }

    public String getBMICategory() {
        double bmi = calculateBMI();
        if (bmi < 18.5) {
            return "Underweight";
        } else if (bmi < 25) {
            return "Normal weight";
        } else if (bmi < 30) {
            return "Overweight";
        }else{
            return "Obese";
        }
    }
}
