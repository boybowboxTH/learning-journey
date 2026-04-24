package w5;

public class Car {
    private String companyName;
    private String modelName;
    private int year;
    private double mileage;

    Car(){
        companyName = "Unknown";
        modelName = "Unknown";
        year = 2000;
        mileage = 0.0;
    }

    Car(String companyName,String modelName,int year,double mileage){
        this.companyName = companyName;
        this.modelName = modelName;
        this.year = year;
        this.mileage = mileage;
    }

    public void setCompanyName(String companyName){
        if(companyName == null || companyName.trim().isEmpty()){
            System.out.println("Error: Invalid company or model name!");
        }else {
            this.companyName = companyName;
        }
    }

    public void setModelName(String modelName){
        if(modelName == null || modelName.trim().isEmpty()){
            System.out.println("Error: Invalid company or model name!");
        }else{
            this.modelName = modelName;
        }
    }

    public void setYear(int year){
        if(year < 1886){
            System.out.println("Error: Invalid year!");
        }else{
            this.year = year;
        }
    }


    public String getCompanyName(){
        return this.companyName;
    }

    public String getModelName(){
        return this.modelName;
    }

    public int getYear(){
        return this.year;
    }

    public  double getMileage(){
        return this.mileage;
    }

    public void showMsg(){
        System.out.println("Company Name: " + this.companyName);
        System.out.println("Model Name: " + this.modelName);
        System.out.println("Year: " + this.year);
        System.out.println("Mileage: " + this.mileage);
    }

}
