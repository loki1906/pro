package widok;

import java.awt.Color;
import java.awt.Cursor;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridLayout;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.FocusEvent;
import java.awt.event.FocusListener;
import java.io.File;
import java.io.FileNotFoundException;
import java.math.RoundingMode;
import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.IllformedLocaleException;
import java.util.List;
import java.util.Locale;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JCheckBox;
import javax.swing.JComboBox;
import javax.swing.JFileChooser;
import javax.swing.JFormattedTextField;
import javax.swing.JFormattedTextField.AbstractFormatter;
import javax.swing.JFormattedTextField.AbstractFormatterFactory;
import javax.swing.JLabel;
import javax.swing.JList;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.ListModel;
import javax.swing.event.ChangeEvent;
import javax.swing.event.ChangeListener;
import javax.swing.filechooser.FileNameExtensionFilter;
import javax.swing.text.InternationalFormatter;

import podstawa.AlgorytmFA;
import podstawa.Plik;

public class NorthPanel extends JPanel {

	/**
	 * 
	 */
	private static final long serialVersionUID = -6662200216621282223L;
	
	private Okno okno;
	private final Integer[] listaProcentow = {5,10,15};
	private JLabel ilSwLbl, czasOblLbl, wspAbsorbcji, maxAtrakcyjnosc;
	private JFormattedTextField ilSwTxt, czasOblTxt, wspAbsorbcjiTxt, maxAtrakcyjnoscTxt;
	private JCheckBox czyPiecProcGeneruj, czyPiecProcRozpraszaj; 
	private JComboBox<Integer> listaGeneruj, listaRozpraszaj;
	private JButton startBtn, oPlikBtn;
	private File file;
	private Plik p;
	private List<Integer> daneZPliku;
	
	private String doPliku = "";
	
	public NorthPanel(Okno okno){
		this.okno = okno;
		GridLayout gl = new GridLayout(3,6);
		setLayout(gl);
		
		
		// labele
		ilSwLbl = new JLabel("Iloœæ œwietlików:");
		ilSwLbl.setFont(ilSwLbl.getFont().deriveFont(15f));
		ilSwLbl.setHorizontalAlignment(JLabel.CENTER);
		ilSwLbl.setBorder(BorderFactory.createMatteBorder(0, 0, 0, 1, Color.BLACK));

		czasOblLbl = new JLabel("Czas obliczeñ [sekundy]:");
		czasOblLbl.setFont(czasOblLbl.getFont().deriveFont(15f));
		czasOblLbl.setHorizontalAlignment(JLabel.CENTER);
		czasOblLbl.setBorder(BorderFactory.createMatteBorder(0, 0, 0, 1, Color.BLACK));
		
		wspAbsorbcji = new JLabel("<html>Wspó³czynnik <br/> absorbcji:</html>");
		wspAbsorbcji.setFont(wspAbsorbcji.getFont().deriveFont(15f));
		wspAbsorbcji.setHorizontalAlignment(JLabel.CENTER);
		wspAbsorbcji.setBorder(BorderFactory.createMatteBorder(0, 0, 0, 1, Color.BLACK));
		
		maxAtrakcyjnosc = new JLabel("<html>Maksymalna <br/> atrakcyjnoœæ:</html>");
		maxAtrakcyjnosc.setFont(maxAtrakcyjnosc.getFont().deriveFont(15f));
		maxAtrakcyjnosc.setHorizontalAlignment(JLabel.CENTER);
		maxAtrakcyjnosc.setBorder(BorderFactory.createMatteBorder(0, 0, 0, 1, Color.BLACK));
		
		
		//text fieldy
		ilSwTxt = new JFormattedTextField(NumberFormat.getNumberInstance());
		ilSwTxt.setValue(new Integer(2));
		ilSwTxt.setColumns(5);
		ilSwTxt.setFont(maxAtrakcyjnosc.getFont().deriveFont(15f));
		ilSwTxt.setHorizontalAlignment(JFormattedTextField.CENTER);
		ilSwTxt.setBorder(BorderFactory.createMatteBorder(0, 0, 1, 1, Color.BLACK));

		czasOblTxt = new JFormattedTextField(NumberFormat.getNumberInstance());
		czasOblTxt.setValue(new Integer(1));
		czasOblTxt.setColumns(5);
		czasOblTxt.setFont(maxAtrakcyjnosc.getFont().deriveFont(15f));
		czasOblTxt.setHorizontalAlignment(JFormattedTextField.CENTER);
		czasOblTxt.setBorder(BorderFactory.createMatteBorder(0, 0, 1, 1, Color.BLACK));
		
		wspAbsorbcjiTxt = new JFormattedTextField(NumberFormat.getNumberInstance());
		wspAbsorbcjiTxt.setValue(new Double(1));
		wspAbsorbcjiTxt.setColumns(10);
		wspAbsorbcjiTxt.setFormatterFactory(new AbstractFormatterFactory() {

	        @Override
	        public AbstractFormatter getFormatter(JFormattedTextField tf) {
	            NumberFormat format = DecimalFormat.getInstance();
	            format.setMinimumFractionDigits(7);
	            format.setMaximumFractionDigits(7);
	            format.setRoundingMode(RoundingMode.HALF_UP);
	            InternationalFormatter formatter = new InternationalFormatter(format);
	            formatter.setAllowsInvalid(false);
	            formatter.setMinimum(0.0000);
	            formatter.setMaximum(1000.0000);
	            return formatter;
	        }
	    });
		wspAbsorbcjiTxt.setFont(maxAtrakcyjnosc.getFont().deriveFont(13f));
		wspAbsorbcjiTxt.setHorizontalAlignment(JFormattedTextField.CENTER);
		wspAbsorbcjiTxt.setBorder(BorderFactory.createMatteBorder(0, 0, 1, 1, Color.BLACK));
		
		maxAtrakcyjnoscTxt = new JFormattedTextField(NumberFormat.getNumberInstance());
		maxAtrakcyjnoscTxt.setValue(new Double(1));
		maxAtrakcyjnoscTxt.setColumns(5);
		maxAtrakcyjnoscTxt.setFont(maxAtrakcyjnosc.getFont().deriveFont(15f));
		maxAtrakcyjnoscTxt.setHorizontalAlignment(JFormattedTextField.CENTER);
		maxAtrakcyjnoscTxt.setBorder(BorderFactory.createMatteBorder(0, 0, 1, 1, Color.BLACK));
		
		oPlikBtn = new JButton("Otwórz plik");
		oPlikBtn.setEnabled(true);
		oPlikBtn.setFont(new Font("Times new Roman", Font.BOLD, 20));
		oPlikBtn.setPreferredSize(new Dimension(150, 40));
		oPlikBtn.setBorder(BorderFactory.createEmptyBorder());
		
		startBtn = new JButton("START");
		startBtn.setEnabled(true);
		startBtn.setFont(new Font("Times new Roman", Font.BOLD, 23));
		startBtn.setPreferredSize(new Dimension(120, 40));
		startBtn.setBorder(BorderFactory.createMatteBorder(1, 0, 1, 0, Color.BLACK));
		
		czyPiecProcGeneruj = new JCheckBox("generowanie 5% miast");
		czyPiecProcGeneruj.setBackground(new Color(210, 210, 250));
		
		czyPiecProcRozpraszaj = new JCheckBox("rozproszenie 5% œwietlików");
		czyPiecProcRozpraszaj.setBackground(new Color(210, 210, 250));


		listaGeneruj = new JComboBox<>(listaProcentow);
		listaGeneruj.setEnabled(false);
		listaRozpraszaj = new JComboBox<>(listaProcentow);
		listaRozpraszaj.setEnabled(false);
		
	//listenery
		
		listaGeneruj.addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent e) {
				czyPiecProcGeneruj.setText("generowanie "+ listaGeneruj.getSelectedItem() +"% miast");
			}
		});
		
		listaRozpraszaj.addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent e) {
				czyPiecProcRozpraszaj.setText("rozproszenie "+ listaRozpraszaj.getSelectedItem() +"% œwietlików");
			}
		});
		
		czyPiecProcGeneruj.addChangeListener(new ChangeListener() {
			
			@Override
			public void stateChanged(ChangeEvent e) {
				listaGeneruj.setEnabled(czyPiecProcGeneruj.isSelected());
			}
		});
		
		czyPiecProcRozpraszaj.addChangeListener(new ChangeListener() {
			
			@Override
			public void stateChanged(ChangeEvent e) {
				listaRozpraszaj.setEnabled(czyPiecProcRozpraszaj.isSelected());
			}
		});
		
		oPlikBtn.addActionListener(new ActionListener() {
			
			@Override
			public void actionPerformed(ActionEvent e) {
				okno.getSp().getTxtL().setText("");
				JFileChooser fc = new JFileChooser();
				FileNameExtensionFilter filter = new FileNameExtensionFilter("TEXT FILES", "tsp");
				fc.setAcceptAllFileFilterUsed(false);
				fc.addChoosableFileFilter(filter);
				int showOpenDialog = fc.showOpenDialog(null);
				if(showOpenDialog == JFileChooser.APPROVE_OPTION){
					file= fc.getSelectedFile();
					p = new Plik(file);
					daneZPliku = p.przeczytajPlik();
					String sb = "";
					int a =1 ;
					for(Integer i : daneZPliku){
//						sb += ;	
						if(a%9 == 0){
							sb+="y="+i.toString()+"\n";
						} else if(a%3== 0){
							sb+="y="+i.toString()+"\t";
						} else if(a%3 == 2){
							sb+="x="+i.toString()+",  ";
						} else if(a%3 == 1){
							sb+="pkt "+i.toString()+",  ";
						}
						a++;
					}
					okno.getSp().getTxtL().append(sb);
					okno.getSp().getNazwaLbl().setText("Plik: " + p.getNazwa());
					validujWszystko();
				}
				
			}
		});
		
		ilSwTxt.addFocusListener(new FocusListener() {
			
			@Override
			public void focusLost(FocusEvent e) {
				validujWszystko();
				
			}
			
			@Override
			public void focusGained(FocusEvent e) {
				
			}
		});
		
		czasOblTxt.addFocusListener(new FocusListener() {
			
			@Override
			public void focusLost(FocusEvent e) {
				validujWszystko();
				
			}
			
			@Override
			public void focusGained(FocusEvent e) {
				
			}
		});
		
		wspAbsorbcjiTxt.addFocusListener(new FocusListener() {
			
			@Override
			public void focusLost(FocusEvent e) {
				validujWszystko();
				
			}
			
			@Override
			public void focusGained(FocusEvent e) {
				
			}
		});
		
		maxAtrakcyjnoscTxt.addFocusListener(new FocusListener() {
			
			@Override
			public void focusLost(FocusEvent e) {
				validujWszystko();
				
			}
			
			@Override
			public void focusGained(FocusEvent e) {
				
			}
		});

		startBtn.addActionListener(new ActionListener() {

			@Override
			public void actionPerformed(ActionEvent e) {
				AlgorytmFA fa = null;
				String zAlgo="";
				doPliku ="";
				long sumKoszt = 0;
				long srKoszt = 0;
				int nrBadaniaBest = 0;
				long bestKoszt = Integer.MAX_VALUE;
				long najgorszyKoszt = Integer.MIN_VALUE;
				int nrBadaniaNajgorszy =0;
				for(int b = 1; b<=1; b++){
					for(int a = 1; a<=3; a++ ){
						int swietliki = ((Long)ilSwTxt.getValue()).intValue();	
						double wspolczynnikA = Double.parseDouble(wspAbsorbcjiTxt.getText().replace(",","."));
						double maxAtr = Double.parseDouble(maxAtrakcyjnoscTxt.getText().replace(",","."));
						boolean czyGeneruj = czyPiecProcGeneruj.isSelected();
						int ileGeneruj = (Integer)listaGeneruj.getSelectedItem();
						boolean czyRozpraszaj = czyPiecProcRozpraszaj.isSelected();
						int ileRozpraszaj = (Integer)listaRozpraszaj.getSelectedItem();
//						if(b==0){
//							if(a>1){
//								continue;
//							}
//						}
						if(b==1){
							swietliki = ((Long)ilSwTxt.getValue()).intValue()+a*10;							
						}
						if(b==2){
							wspolczynnikA = Double.parseDouble(wspAbsorbcjiTxt.getText().replace(",","."))*a*2;
						}
						if(b==3){					
							maxAtr = Double.parseDouble(maxAtrakcyjnoscTxt.getText().replace(",","."))-0.1*a;
						}
						if(b==4){
							czyGeneruj = true;
							if(a<4){
								ileGeneruj = (Integer)listaGeneruj.getSelectedItem()*a;
							} else{
								continue;
							}
						}
						if(b==5){
							czyRozpraszaj = true;
							if(a<4){
								ileRozpraszaj = (Integer)listaRozpraszaj.getSelectedItem()*a;								
							} else {
								continue;
							}
						}
						
						doPliku += "===============Parametry===================\r\n--nazwa zbioru : "+p.getNazwa()+"\r\n--wsp. absorb. : "+ wspolczynnikA + "\r\n--max atrakc. : " + maxAtr +
								"\r\n--czas : " + czasOblTxt.getText() + "\r\n--œwietliki : " + swietliki + "\r\n--%generuj : " + czyGeneruj+" - "+ileGeneruj + "\r\n--%rozpraszaj : " + 
								czyRozpraszaj+" - "+ileRozpraszaj + "\r\n===============Parametry===================\r\n\r\n" ;
						for(int x =0; x<3;x++){
		//				int x=0;
							long czasStartu = System.currentTimeMillis();
							fa = new AlgorytmFA(wspolczynnikA, maxAtr, Long.parseLong(czasOblTxt.getText()),
									swietliki, daneZPliku, czasStartu, czyGeneruj,ileGeneruj, czyRozpraszaj, ileRozpraszaj);
							fa.przygotojSwietliki();
							try {
								zAlgo = fa.wykonajAlgorytm();
							} catch (FileNotFoundException e2) {
								// TODO Auto-generated catch block
								e2.printStackTrace();
							}
							sumKoszt += fa.getNajlepszyKoszt();
							if(fa.getNajlepszyKoszt()<bestKoszt){
								bestKoszt = fa.getNajlepszyKoszt();
								nrBadaniaBest = x+1;
							} else if(fa.getNajlepszyKoszt()> najgorszyKoszt){
								najgorszyKoszt = fa.getNajlepszyKoszt();
								nrBadaniaNajgorszy = x+1;
							}
							int y = x+1;
							doPliku+= "--------- badanie nr"+y+"\r\n"+zAlgo+"\r\n\r\n";
						}
						srKoszt = sumKoszt/3;
						doPliku += "\r\n\r\n++++++++++ najlepszy koszt: "+ bestKoszt + " w badaniu nr" + nrBadaniaBest + "\r\n++++++++++ œrednia kosztów: "+ srKoszt + "\r\n++++++++++ najgorszy koszt: " + najgorszyKoszt + " w badaniu nr" + nrBadaniaNajgorszy + "\r\n";
						try {
							String nazwaPliku = p.getNazwa()+"_"+swietliki+"_"+czasOblTxt.getText()+"_"+wspolczynnikA+"_"+maxAtr+"_"+czyGeneruj+"-"+ileGeneruj+"_"+czyRozpraszaj+"-"+ileRozpraszaj+".txt" ;
							fa.zapiszDoPliku(doPliku, nazwaPliku);
							final Runnable SOUND = (Runnable)Toolkit.getDefaultToolkit().getDesktopProperty("win.sound.default");
							if(SOUND != null)SOUND.run();
						} catch (FileNotFoundException e1) {
							// TODO Auto-generated catch block
							e1.printStackTrace();
						}
						doPliku ="";
						bestKoszt = Integer.MAX_VALUE;
						nrBadaniaBest =0;
						srKoszt =0;
						najgorszyKoszt = Integer.MIN_VALUE;
						nrBadaniaNajgorszy =0;
					}
				}
				okno.getSp().getTxtR().setText(zAlgo);

			}

		});

		
		add(ilSwLbl);
		add(czasOblLbl);
		add(wspAbsorbcji);
		add(maxAtrakcyjnosc);
		add(oPlikBtn);
		
		add(ilSwTxt);
		add(czasOblTxt);
		add(wspAbsorbcjiTxt);
		add(maxAtrakcyjnoscTxt);
		add(startBtn);
		
		add(listaGeneruj);
		add(czyPiecProcGeneruj);
		add(listaRozpraszaj);
		add(czyPiecProcRozpraszaj);
		setBackground(new Color(210, 210, 250));
		
	}
	
	public boolean validujWszystko() {

		boolean validujIlSw = validujIlSw();
		boolean validujCzas = validujCzas();
		boolean validujFile = validujFile();
		boolean validujAbs = validujAbs();
		boolean validujAtr = validujAtr();
		boolean res = validujCzas && validujIlSw && validujFile && validujAbs && validujAtr;
		startBtn.setEnabled(true);
		return res;
	}

	private boolean validujFile() {
		if(file != null){
			return true;
		} 
		return false;
	}

	public boolean validujIlSw() {
		boolean valSw = false;
		return valSw;
	}

	public boolean validujCzas() {
		boolean valCz = false;
		try {
			if (Integer.parseInt(czasOblTxt.getText()) > 0 && Integer.parseInt(czasOblTxt.getText()) <= 1800) {
				valCz = true;
			} else {
				valCz = false;
				czasOblTxt.setValue(new Integer(1));
			}
		} catch (NumberFormatException e) {
			valCz = false;
			czasOblTxt.setValue(new Integer(1));
		}
		return valCz;
	}
	
	public boolean validujAbs() {
		boolean valAbs = false;
		try {
			if ((Double)wspAbsorbcjiTxt.getValue() > 0 && (Double)wspAbsorbcjiTxt.getValue() <= 1) {
				valAbs = true;
				wspAbsorbcjiTxt.setValue(Double.parseDouble(wspAbsorbcjiTxt.getText().replace(",",".")));
			} else {
				valAbs = false;
				wspAbsorbcjiTxt.setValue(new Double(1));
			}
		} catch (NumberFormatException e) {
			valAbs = false;
			wspAbsorbcjiTxt.setValue(new Double(1));
		}
		return valAbs;
	}
	
	public boolean validujAtr() {
		boolean valAtr = false;
		try {
			if (Double.parseDouble(maxAtrakcyjnoscTxt.getText().replace(",",".")) > 0 && Double.parseDouble(maxAtrakcyjnoscTxt.getText().replace(",",".")) <= 1) {
				maxAtrakcyjnoscTxt.setValue(Double.parseDouble(maxAtrakcyjnoscTxt.getText().replace(",",".")));
				valAtr = true;
			} else {
				valAtr = false;
				maxAtrakcyjnoscTxt.setValue(new Double(1));
			}
		} catch (NumberFormatException e) {
			valAtr = false;
			maxAtrakcyjnoscTxt.setValue(new Double(1));
		}
		return valAtr;
	}

	private void odliczDo() {
		long curTime = System.currentTimeMillis();
		

		long current = System.currentTimeMillis();
		int i = Integer.parseInt(czasOblTxt.getText());
		while (i >= 0) {
			if (System.currentTimeMillis() - current > 1000) {
				System.out.println(i--);
				current = System.currentTimeMillis();
			}
		}
		JOptionPane.showMessageDialog(null, "Error:" + curTime / 1000 + " - " + current / 1000, "Error Massage", JOptionPane.PLAIN_MESSAGE);
	}
	
	public Okno getOkno() {
		return okno;
	}

}
