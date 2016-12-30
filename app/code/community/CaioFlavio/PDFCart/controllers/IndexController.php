<?php 
	define('STORE_ID', Mage::App()->getStore()->getStoreId());
	define('PDF_NAME', Mage::getStoreConfig('pdfcart/general/document_name', STORE_ID));
	class CaioFlavio_PDFCart_IndexController Extends Mage_Core_Controller_Front_Action{

		protected function getTemplateHtml(){
			return (string) $this->getLayout()->createBlock('caioflavio_pdfcart/quote')->setTemplate('pdfcart/quote.phtml')->toHtml();
		}

		public function indexAction(){
			$pdfHelper 	= new CaioFlavio_PDFCart_Helper_Dompdf();
			$options 	= new CaioFlavio_PDFCart_Helper_Options();
			$options->setIsRemoteEnabled(true);
			
			$pdfHelper->loadHtml($this->getTemplateHtml());
			$pdfHelper->setPaper('A4');
			$pdfHelper->setOptions($options);
			$pdfHelper->render();
			$pdfHelper->stream(PDF_NAME, array('Attachment'=>0));			
		}
	}