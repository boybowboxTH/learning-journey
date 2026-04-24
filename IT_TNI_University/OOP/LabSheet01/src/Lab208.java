import javax.swing.JOptionPane;

public class Lab208 {
    static void main(){
        // start
        int startHour = Integer.parseInt(JOptionPane.showInputDialog(null,"Input start time (hour)"));
        int startMinute = Integer.parseInt(JOptionPane.showInputDialog(null,"Input start time (minute)"));

        //end
        int endHour = Integer.parseInt(JOptionPane.showInputDialog(null,"Input start time (hour)"));
        int endMinute = Integer.parseInt(JOptionPane.showInputDialog(null,"Input start time (minute)"));

        int totalTimeStart = (startHour * 60) + startMinute;
        int totalTimeEnd = (endHour * 60) + endMinute;
        int diffTime = totalTimeEnd - totalTimeStart;

        int diffHour = (diffTime / 60);
        int diffMinute = (diffTime % 60);

        double payment = (diffHour * 50) + (diffMinute * 0.25);

        JOptionPane.showMessageDialog(null, "Start parking at " + startHour + ":" + startMinute +
                "\nEnd parking at " + endHour + ":" + String.format("%02d", endMinute) +
                "\nTotal time is " + diffHour + " hour " + diffMinute + " minutes" +
                "\nParking payment is " + payment + " baht.");

    }
}
