import java.util.Scanner;

public class Test{
    public static void main(String[] args) {
        Scanner in = new Scanner(System.in);
        int t=in.nextInt();
        while(t-->0){
            int n=in.nextInt();
            String s=in.next();
            char first = s.charAt(0), last = s.charAt(n-1);
            if(first == '>' || last == '<')
                System.out.println(0);
            else{
                int fi = s.indexOf('>'), li = s.substring(1).lastIndexOf('<') + 1;
                System.out.println(li<=0? fi: Math.min(fi, n-li-1));
            }
        }

        in.close();
    }


}