package okno;

import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.FocusEvent;
import java.awt.event.FocusListener;
import java.text.NumberFormat;

import javax.swing.BorderFactory;
import javax.swing.JFormattedTextField;
import javax.swing.JLabel;
import javax.swing.JPanel;

public class NorthPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = -1719080110002829325L;
	
	private JFormattedTextField procSklaowania;
	private JLabel procSkalLbl;
	private JLabel procLbl;
	private ParametrySingleton params;
	
	public NorthPanel() {
		params = ParametrySingleton.getInstance();
		setBorder(BorderFactory.createLoweredBevelBorder());
		procSkalLbl = new JLabel("przeskaluj do  ");
		procSkalLbl.setFont(new Font("Times new Roman", Font.BOLD, 20));
		
		procLbl = new JLabel("  %  ");
		procLbl.setFont(new Font("Times new Roman", Font.BOLD, 20));
		
		procSklaowania = new JFormattedTextField(NumberFormat.getNumberInstance());
		procSklaowania.setValue(new Integer(0));
		procSklaowania.setColumns(3);
		procSklaowania.setFont(new Font("Times new Roman", Font.BOLD, 20));
		procSklaowania.setHorizontalAlignment(JFormattedTextField.CENTER);
		procSklaowania.setBorder(BorderFactory.createEmptyBorder());//BorderFactory.createMatteBorder(2, 5, 1, 1, Color.BLACK));
		
		
		
		add(procSkalLbl);
		add(procSklaowania);
		add(procLbl);
		
	}

	public JFormattedTextField getProcSklaowania() {
		return procSklaowania;
	}

	public void setProcSklaowania(JFormattedTextField procSklaowania) {
		this.procSklaowania = procSklaowania;
	}

	public JLabel getProcSkalLbl() {
		return procSkalLbl;
	}

	public void setProcSkalLbl(JLabel procSkalLbl) {
		this.procSkalLbl = procSkalLbl;
	}

	public JLabel getProcLbl() {
		return procLbl;
	}

	public void setProcLbl(JLabel procLbl) {
		this.procLbl = procLbl;
	}
}
