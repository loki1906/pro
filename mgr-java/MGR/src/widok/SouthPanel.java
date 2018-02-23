package widok;

import java.awt.Color;
import java.awt.Component;
import java.awt.Dimension;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;

import javax.swing.BorderFactory;
import javax.swing.ImageIcon;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;

public class SouthPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = -4974108861586044138L;

	private JScrollPane scrollL, scrollR;
	private JTextArea txtL, txtR;
	private JLabel nazwaLbl, iloscLbl, czasZakonczenia, loadLbl;
	
	public SouthPanel(){
		setPreferredSize(new Dimension(WIDTH, 585));

	    setBackground(new Color(210, 210, 250));
		
		GridBagLayout bl = new GridBagLayout();
		setLayout(bl);
		GridBagConstraints c = new GridBagConstraints();
		
		nazwaLbl = new JLabel("Plik: ");
		nazwaLbl.setFont(nazwaLbl.getFont().deriveFont(15f));
		nazwaLbl.setHorizontalAlignment(JLabel.CENTER);
		
		iloscLbl = new JLabel("Wyniki badañ:");
		iloscLbl.setFont(iloscLbl.getFont().deriveFont(15f));
		iloscLbl.setHorizontalAlignment(JLabel.CENTER);
		
		txtL = new JTextArea(30,44);
		txtL.setEditable(false);
		txtL.setLineWrap(true);
		txtL.setWrapStyleWord(true);
		
		txtR = new JTextArea(30,40);
		txtR.setEditable(false);
		txtR.setLineWrap(true);
		txtR.setWrapStyleWord(true);
		
		scrollL = new JScrollPane(txtL, JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED, JScrollPane.HORIZONTAL_SCROLLBAR_AS_NEEDED);
		scrollR = new JScrollPane(txtR, JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED, JScrollPane.HORIZONTAL_SCROLLBAR_AS_NEEDED);
		
		scrollL.setBorder(BorderFactory.createMatteBorder(1, 1, 1, 1, Color.black));
		scrollR.setBorder(BorderFactory.createMatteBorder(1, 1, 1, 1, Color.black));
		
		c.fill = GridBagConstraints.HORIZONTAL;
		c.gridx = 0;
		c.gridy = 0;
		add(nazwaLbl, c);

		c.fill = GridBagConstraints.HORIZONTAL;
		c.gridx = 1;
		c.gridy = 0;
		add(iloscLbl, c);
		
		
		c.fill = GridBagConstraints.HORIZONTAL;
		c.gridx = 0;
		c.gridy = 2;
		add(scrollL,c);

		c.fill = GridBagConstraints.HORIZONTAL;
		c.gridx = 1;
		c.gridy = 2;
		add(scrollR,c);
		
	}

	public JScrollPane getScrollL() {
		return scrollL;
	}

	public void setScrollL(JScrollPane scrollL) {
		this.scrollL = scrollL;
	}

	public JScrollPane getScrollR() {
		return scrollR;
	}

	public void setScrollR(JScrollPane scrollR) {
		this.scrollR = scrollR;
	}

	public JTextArea getTxtL() {
		return txtL;
	}

	public void setTxtL(JTextArea txtL) {
		this.txtL = txtL;
	}

	public JTextArea getTxtR() {
		return txtR;
	}

	public void setTxtR(JTextArea txtR) {
		this.txtR = txtR;
	}
	
	public JLabel getNazwaLbl() {
		return nazwaLbl;
	}

	public void setNazwaLbl(JLabel nazwaLbl) {
		this.nazwaLbl = nazwaLbl;
	}

	public JLabel getIloscLbl() {
		return iloscLbl;
	}

	public void setIloscLbl(JLabel iloscLbl) {
		this.iloscLbl = iloscLbl;
	}

	public JLabel getLoadLbl() {
		return loadLbl;
	}
	
}
