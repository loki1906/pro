package okno;

import java.awt.Dimension;
import java.awt.Font;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JPanel;

public class SouthPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = 5155787710564466219L;
	private JButton startBtn;
	private ParametrySingleton params;
	
	public SouthPanel() {
		params = ParametrySingleton.getInstance();
		
		setBorder(BorderFactory.createLoweredBevelBorder());
		startBtn = new JButton("START");
		startBtn.setEnabled(true);
		startBtn.setFont(new Font("Times new Roman", Font.BOLD, 23));
		startBtn.setPreferredSize(new Dimension(120, 40));
		startBtn.setBorder(BorderFactory.createEmptyBorder());
		
		add(startBtn);
	}

	public JButton getStartBtn() {
		return startBtn;
	}

	public void setStartBtn(JButton startBtn) {
		this.startBtn = startBtn;
	}
}
