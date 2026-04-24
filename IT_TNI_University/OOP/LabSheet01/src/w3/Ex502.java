package w3;
import javax.swing.*;

public class Ex502 {
    static void main(){
        int midtermScore = check_limit_score("Enter midterm-score", 35);
        int finalScore = check_limit_score("Enter final-score", 65);
        int calculateScore = cal_score(midtermScore,finalScore);
        boolean isPass = is_pass(calculateScore);
        JOptionPane.showMessageDialog(null,"Your score is " + calculateScore
                + "\nYour result is " +  (isPass?"Yes":"No"));
    }

    static int check_limit_score(String msg,int limitScore){
        int score = Integer.parseInt(JOptionPane.showInputDialog(msg));
        while(score < 0 || score > limitScore){
            JOptionPane.showMessageDialog(null,"Invalid score\n" + "Score must between 0 and " + limitScore);
        score = Integer.parseInt(JOptionPane.showInputDialog(msg));
        }
        return score;
    }

    static int cal_score(int midtermScore,int finalScore){
        return (midtermScore+finalScore);
    }

    static boolean is_pass(int totalScore){
        if(totalScore>=50){
            return true;
        }else
            return false;
    }
}
