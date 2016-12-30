<?php 
	class CaioFlavio_PDFCart_IndexController Extends Mage_Core_Controller_Front_Action{

		protected function batata(){
			return (string) $this->getLayout()->createBlock('caioflavio_pdfcart/quote')->setTemplate('pdfcart/quote.phtml')->toHtml();
		}

		public function indexAction(){
			$dompdf = new CaioFlavio_PDFCart_Helper_Dompdf();
			$dompdf->loadHtml($this->batata());
			$dompdf->setPaper('A4');
			$dompdf->render();
			$dompdf->stream('my.pdf',array('Attachment'=>0));;			
		}
	}