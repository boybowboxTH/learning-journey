package w5;

public class SmartPhone {
    private String brand;
    private String model;
    private int storageCapacity;
    private static final int MAX_STORAGE_CAPACITY = 521;

    public String getBrand() {
        return brand;
    }

    public String getModel() {
        return model;
    }

    public int getStorageCapacity() {
        return storageCapacity;
    }

    public void setBrand(String brand) {
        if(brand.length() < 2){
            System.out.println("Error: Brand must have at least 2characters!");
        }else{
            this.brand = brand;
        }
    }

    public void setModel(String model) {
        if(model.length() < 2){
            System.out.println("Error: Model must have at least 2characters!");
        }else{
            this.model = model;
        }
    }

    public void setStorageCapacity(int storageCapacity) {
        if(storageCapacity < 1 || storageCapacity > 512){
            System.out.println("Error: Storage capacity must be between 1 and 512GB!");
        }else{
            this.storageCapacity = storageCapacity;
        }
    }

    public void increaseStorage(int additionalStorage){
        int totalStorage = storageCapacity + additionalStorage;
        if(additionalStorage <= 0){
            System.out.println("Error: Additional storage must be positive!");
        } else if (storageCapacity > 0 && totalStorage < MAX_STORAGE_CAPACITY) {
            storageCapacity+= additionalStorage;
        }else{
            System.out.println("Error: Storage capacity cannot exceed " + MAX_STORAGE_CAPACITY + " GB!");
        }
    }

    public int getRemainingStorage(int usedStorage){
        int total = 0;
        if(usedStorage >= 0 && usedStorage <= this.storageCapacity){
            total = this.storageCapacity - usedStorage;
            return total;
        }else{
            System.out.println("Error: Used storage must be between 0 and " + this.storageCapacity + " GB!");
        }
        return -1;
    }

    public void printDetails(){
        System.out.println("SmartPhone Details:");
        System.out.println("Brand: " + this.brand);
        System.out.println("Model: " + this.model);
        System.out.println("Storage Capacity: " + this.storageCapacity + " GB");
    }

}
