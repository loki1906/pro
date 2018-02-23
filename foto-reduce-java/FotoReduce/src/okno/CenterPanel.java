package okno;

import java.awt.Dimension;
import java.awt.Font;
import java.awt.Graphics2D;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.util.Arrays;
import java.util.List;

import javax.imageio.ImageIO;
import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JFileChooser;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.filechooser.FileNameExtensionFilter;

public class CenterPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = 3846742731214924566L;

	final int wysokosc = 300;
	public final String f1 = "C:\\Users\\Chomicek\\Desktop\\foto1.jpg";
	public final String f2 = "C:\\Users\\Chomicek\\Desktop\\foto2.jpg";
	public final String f3 = "C:\\Users\\Chomicek\\Desktop\\foto3.jpg";
	private List<String> lista = Arrays.asList(f1,f2,f3);
	private JButton otworzPlik;
	private JTextArea infoArea;
	private JScrollPane infoScroll;
	private ParametrySingleton params;
	
	public CenterPanel() {

		params = ParametrySingleton.getInstance();
		setBorder(BorderFactory.createLoweredBevelBorder());
//		wygenerujCos();

		otworzPlik = new JButton("Otwórz pliki");
		otworzPlik.setEnabled(true);
		otworzPlik.setFont(new Font("Times new Roman", Font.BOLD, 20));
		otworzPlik.setPreferredSize(new Dimension(150, 40));
		otworzPlik.setBorder(BorderFactory.createEmptyBorder());
		
		infoArea = new JTextArea(25,30);
		infoArea.setEditable(false);
		infoArea.setLineWrap(true);
		infoArea.setWrapStyleWord(true);
		infoArea.setFont(new Font("Times new Roman", Font.BOLD, 16));

		add(otworzPlik);
		add(infoArea);
		//musi tu byc inicjowany suwak, bo sie nie pokazuje jak jest przed dodaniem textarea do panelu
		infoScroll = new JScrollPane(infoArea, JScrollPane.VERTICAL_SCROLLBAR_AS_NEEDED, JScrollPane.HORIZONTAL_SCROLLBAR_AS_NEEDED);
		add(infoScroll);

	}

	public double round(double value, int places) {
	    if (places < 0) throw new IllegalArgumentException();

	    long factor = (long) Math.pow(10, places);
	    value = value * factor;
	    long tmp = Math.round(value);
	    return (double) tmp / factor;
	}
	
	

	public JButton getOtworzPlik() {
		return otworzPlik;
	}

	public void setOtworzPlik(JButton otworzPlik) {
		this.otworzPlik = otworzPlik;
	}

	public List<String> getLista() {
		return lista;
	}

	public void setLista(List<String> lista) {
		this.lista = lista;
	}

	public JTextArea getInfoArea() {
		return infoArea;
	}

	public void setInfoArea(JTextArea infoArea) {
		this.infoArea = infoArea;
	}
	
//	public BufferedImage scaleImage(int WIDTH, int HEIGHT, String filename) {
//	    BufferedImage bi = null;
//	    try {
//	        ImageIcon ii = new ImageIcon(filename);//path to image
//	        bi = new BufferedImage(WIDTH, HEIGHT, BufferedImage.TYPE_INT_RGB);
//	        Graphics2D g2d = (Graphics2D) bi.createGraphics();
//	        g2d.addRenderingHints(new RenderingHints(RenderingHints.KEY_RENDERING,RenderingHints.VALUE_RENDER_QUALITY));
//	        g2d.drawImage(ii.getImage(), 0, 0, WIDTH, HEIGHT, null);
//	        g2d.dispose();
//	        paintComponent(g2d);
//	    } catch (Exception e) {
//	        e.printStackTrace();
//	        return null;
//	    }
//	    return bi;
//	}
//	
//	@Override
//	protected void paintComponent(Graphics g) {
//		super.paintComponent(g);
//		Graphics2D g2d = (Graphics2D) g;
//		for(int j = 1; j<=2; j++){
//			for(int i = 1; i<=3; i++){
//				// prostokat
//				
//				g2d.drawRect(310*i-300, 310*j-300, 300, 300);
//				if(i%2==0){
//					g2d.setColor(Color.WHITE);
//				} else {
//					g2d.setColor(Color.BLACK);
//				}
//			}
//		}
//	}
}
