package w2;

import javax.swing.*;

public class Ex302 {
    static void main(){
        int score = Integer.parseInt(JOptionPane.showInputDialog(null,"Enter your score: "));
        while(score <= 0 || score >= 100){
            score = Integer.parseInt(JOptionPane.showInputDialog(null, "Enter your score"));
        }

        if(score >= 50){
            JOptionPane.showMessageDialog(null,"Your score is " + score + "(PASS)");
        }else{
            JOptionPane.showMessageDialog(null,"Your score is " + score + "(FAIL)");
        }
    }
}
