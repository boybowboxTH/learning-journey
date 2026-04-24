package w4;

public class Ractangle {
    private float length;
    private float width;

    Ractangle(){
        length = 1.0f;
        width = 1.0f;
    }

    Ractangle(float length,float width){
        this.length = length;
        this.width = width;
    }

    public void setLength(float length){
        this.length = length;
    }

    public void setWidth(float width){
        this.width = width;
    }

    public float calculateArea(){
        return length * width;
    }

    public float calculatePerimeter(){
        return 2 * (length * width);
    }

    public String toString(){
        return "Ractangle [length=" + length + ", width=" + width +"]";
    }

}
