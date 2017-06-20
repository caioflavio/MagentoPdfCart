<?php 
	class CaioFlavio_PDFCart_Helper_Data extends Mage_Core_Helper_Abstract{
		public function getQuoteLink($label='Salvar Cotação', $class = ''){
			return "<a href='" . Mage::getBaseUrl() ."pdfcart/index/index' class='". $class ."'>".$label."</a>";
		}

		public function getEmailLink($label='Enviar Cotação', $class = ''){
			return "<a href='" . Mage::getBaseUrl() ."pdfcart/index/sendEmail' class='". $class ."'>".$label."</a>";
		}
	}
