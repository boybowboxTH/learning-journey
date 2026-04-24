package w3;

import javax.swing.JOptionPane;

public class Lab502 {

    public static void main(String[] args) {

        int dialogResult = JOptionPane.showConfirmDialog(
                null,
                "Do you want to check your score?",
                "Check score",
                JOptionPane.YES_NO_OPTION
        );

        if (dialogResult != JOptionPane.YES_OPTION) {
            JOptionPane.showMessageDialog(null, "END PROGRAM!!", "Message", JOptionPane.INFORMATION_MESSAGE);
            System.exit(0);
        }

        int midtermScore = input_score("Enter midterm-score", 45);
        int finalScore = input_score("Enter final-score", 55);

        int totalScore = cal_score(midtermScore, finalScore);
        String grade = find_grad(totalScore);

        String resultMessage = "Your score is " + totalScore + "\n"
                + "You get grade " + grade;

        JOptionPane.showMessageDialog(null, resultMessage, "Result", JOptionPane.INFORMATION_MESSAGE);

        JOptionPane.showConfirmDialog(
                null,
                "Do you want to check your score?",
                "Check score",
                JOptionPane.YES_NO_OPTION
        );
    }

    static int input_score(String msg,int limitScore){
        int score = Integer.parseInt(JOptionPane.showInputDialog(msg));
        while(score < 0 || score > limitScore){
            score = Integer.parseInt(JOptionPane.showInputDialog(null,"Score must be in range between 0 and " + limitScore + "\n" + msg));
        }
        return score;
    }

    public static int cal_score(int midtermScore, int finalScore) {
        return (midtermScore + finalScore);
    }

    public static String find_grad(int totalScore) {
        if (totalScore >= 80) {
            return "A";
        } else if (totalScore >= 70) {
            return "B";
        } else if (totalScore >= 60) {
            return "C";
        } else if (totalScore >= 50) {
            return "D";
        } else {
            return "F";
        }
    }
}