package okno;

import java.awt.BorderLayout;
import java.awt.Graphics2D;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.FocusEvent;
import java.awt.event.FocusListener;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;

import javax.imageio.ImageIO;
import javax.swing.JFileChooser;
import javax.swing.JFrame;
import javax.swing.event.AncestorEvent;
import javax.swing.event.AncestorListener;
import javax.swing.filechooser.FileNameExtensionFilter;

public class Okno extends JFrame {

	/**
	 * 
	 */
	private static final long serialVersionUID = 3458918663865057952L;
	
	final int wysokosc = 700;
	final int szerokosc = 400;
	NorthPanel np ;
	CenterPanel cp ;
	SouthPanel sp;
	ParametrySingleton params ;
	
	public Okno() {
		super("FotoReduce");
		
		params = ParametrySingleton.getInstance();
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setSize(szerokosc, wysokosc);
	    setLocationRelativeTo(null);
	    setResizable(false);
		
		BorderLayout bl = new BorderLayout();
		setLayout(bl);
		np = new NorthPanel();
		cp = new CenterPanel();
		sp = new SouthPanel();
		
		np.getProcSklaowania().addFocusListener(new FocusListener() {
			
			@Override
			public void focusLost(FocusEvent arg0) {
				Integer proc = null;
				try{
					proc = new Integer(np.getProcSklaowania().getText());
					params.setProcent(proc);

					if(proc<10){
						sp.getStartBtn().setVisible(false);
					} else {
						sp.getStartBtn().setVisible(true);
					}
				} catch (NumberFormatException e){
				}
			}
			
			@Override
			public void focusGained(FocusEvent arg0) {
				// TODO Auto-generated method stub
				
			}
		});
		
		cp.getOtworzPlik().addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent e) {
				cp.getInfoArea().setText("");
				JFileChooser fc = new JFileChooser();
				fc.setMultiSelectionEnabled(true);
				FileNameExtensionFilter filter = new FileNameExtensionFilter("JPEG file", "jpg", "jpeg");
				fc.setAcceptAllFileFilterUsed(false);
				fc.addChoosableFileFilter(filter);
				int showOpenDialog = fc.showOpenDialog(null);
				if(showOpenDialog == JFileChooser.APPROVE_OPTION){
					File[] files = fc.getSelectedFiles();
					params.setPliki(files);
					String str = "";
					str += params.getProcent() + " \n";
					if(files.length>0){
						File f = files[0];
						String sciezka = f.getPath().substring(0, f.getPath().lastIndexOf("\\")+1) + "Przeskalowane\\";
						params.setSciezkaPliku(sciezka);
						str += "Pliki zapisane bêd¹ w nastêpuj¹cej œcie¿ce: " + sciezka+ "... \n===\n===\n";
						
					}
					for(File f : files){
						
						try {
							BufferedImage bimg = ImageIO.read(f);
							int width          = bimg.getWidth();
							int height         = bimg.getHeight();
							double wielkosc = cp.round((f.length()/1024.0)/1000,2);
							
							str += f.getName() + "  -  " + wielkosc + " Mb  -  "+width+" x "+height+"\n";
						} catch (IOException e1) {
							// TODO Auto-generated catch block
							e1.printStackTrace();
						}
					}
					cp.getInfoArea().setText(str);
				}
				if(params.getProcent()<10){
					sp.getStartBtn().setVisible(false);
				} else {
					sp.getStartBtn().setVisible(true);
				}
			}
		});
		
		sp.getStartBtn().addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent e) {
				wygenerujPliki();
			}
		});
		
		add(np);
		add(cp);
		add(sp);
			
		bl.addLayoutComponent(np, BorderLayout.NORTH);
		bl.addLayoutComponent(cp, BorderLayout.CENTER);
		bl.addLayoutComponent(sp, BorderLayout.SOUTH);
		setVisible(true);
	}

	private void wygenerujPliki() {
		cp.getInfoArea().append("\n===\n===\n");
		for(File plik : params.getPliki()){
			String strOut = "";
			try {
				double proc = params.getProcent()/100.0;
				BufferedImage originalImage = ImageIO.read(plik);
				int type = originalImage.getType() == 0? BufferedImage.TYPE_INT_ARGB : originalImage.getType();
				int width = originalImage.getWidth();
				int height = originalImage.getHeight();
				BufferedImage resizeImageJpg = resizeImage(originalImage, type, (int)Math.round(height*proc), (int)Math.round(width*proc));
				String nazwaPliku = plik.getPath().substring(plik.getPath().lastIndexOf("\\")+1, plik.getPath().length());
				File f = new File(params.getSciezkaPliku() + nazwaPliku);
				f.getParentFile().mkdirs();
				ImageIO.write(resizeImageJpg, "jpg", f);
				strOut += nazwaPliku + " ==> OK ;) \n";
				cp.getInfoArea().append(strOut);
			} catch (IOException e) {
				System.out.println(e.getMessage());
			}
		}
	}
	
	private BufferedImage resizeImage(BufferedImage originalImage, int type, int wys, int szer ){
		BufferedImage resizedImage = new BufferedImage(szer, wys, type);
		Graphics2D g = resizedImage.createGraphics();
		g.drawImage(originalImage, 0, 0, szer, wys, null);
		g.dispose();
//		super.paintComponent(g);
		return resizedImage;
	}
	
	public NorthPanel getNp() {
		return np;
	}

	public void setNp(NorthPanel np) {
		this.np = np;
	}

	public CenterPanel getCp() {
		return cp;
	}

	public void setCp(CenterPanel cp) {
		this.cp = cp;
	}

}
