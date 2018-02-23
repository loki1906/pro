package widok;
import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Component;
import java.awt.Dimension;
import java.awt.Graphics;
import java.awt.GridLayout;
import java.awt.Insets;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JSeparator;
import javax.swing.JTextField;
import javax.swing.border.Border;

public class Okno extends JFrame {

	/**
	 * 
	 */
	private static final long serialVersionUID = -4173620823650281343L;


	SouthPanel sp;
	NorthPanel np;
	JLabel lbl;
	
	public static void main(String[] args) {
		Okno o = new Okno();
	}
	
	public Okno(){

		super("MGR");
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setSize(1000, 700);
	    setLocationRelativeTo(null);
	    setResizable(false);
		
		BorderLayout bl = new BorderLayout();
		setLayout(bl);
		np = new NorthPanel(this);
		
		sp = new SouthPanel();

		JSeparator jsep = new JSeparator();
		
		add(np);
		add(jsep);
		add(sp);
			
		bl.addLayoutComponent(np, BorderLayout.NORTH);
		bl.addLayoutComponent(jsep, BorderLayout.CENTER);
		bl.addLayoutComponent(sp, BorderLayout.SOUTH);
		setVisible(true);
	}
	
	public SouthPanel getSp() {
		return sp;
	}

	public NorthPanel getNp() {
		return np;
	}
	
	public JLabel getLbl() {
		return lbl;
	}
}
