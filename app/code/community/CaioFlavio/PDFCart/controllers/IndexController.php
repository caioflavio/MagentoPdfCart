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
			
			$pdfHelper->loadHtml($this->getTemplateHtml(), 'UTF-8');
			$pdfHelper->setPaper('A4');
			$pdfHelper->setOptions($options);
			$pdfHelper->render();
			$pdfHelper->stream(PDF_NAME, array('Attachment'=>0));
			$pdfFile = $pdfHelper->output();
			 
			header('Content-Type: application/pdf');
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Pragma: public');
			header('Content-Length: ' . mb_strlen($pdfFile, '8bit'));	

			echo $pdfFile;				
		}

		public function sendEmailAction(){
			$pdfHelper 	= new CaioFlavio_PDFCart_Helper_Dompdf();
			if(Mage::getStoreConfig('pdfcart/email/active', Mage::app()->getStore()->getId())){
				try{
					$options 	= new Supercommerce_PDFCart_Helper_Options();
					$options->setIsRemoteEnabled(true);
				    $pdfHelper->load_html($this->getTemplateHtml());
				    $pdfHelper->setPaper('A4');
				    $pdfHelper->setOptions($options);
				    $pdfHelper->render();
				    $output = $pdfHelper->output();
				    $file 	= Mage::helper('pdfcart')->getFileInfo();

					if(file_put_contents($file->filePath, $output)){
						$customer = Mage::getSingleton('customer/session')->getCustomer();

						$templateId 	= Mage::App()->getStore()->getId();
						$customerEmail  = $customer->getEmail();
						$customerName 	= $customer->getName();
						$attachmentPath = $file->pdfDir;
						$attachmentName	= $file->pdfName;
						$vars 			= array(
							'customerName' => $customerName,
							'customerMail' => $customerEmail,
							'quoteTime'	   => $file->quoteTime,
						);
						if(Mage::helper('pdfcart')->sendPdfEmail($customerEmail, $customerName, $vars, $attachmentPath, $attachmentName, $storeId)){
							Mage::getSingleton('core/session')->addSuccess('Cotação enviada para ' . $customerEmail);
							$this->_redirect('checkout/cart');
						}else{
							Mage::getSingleton('core/session')->addError('Erro ao enviar cotação para ' . $customerEmail);
							$this->_redirect('checkout/cart');
						}
					}
				}catch (Exception $e){
					echo $e->getMessage();
				}
			}else{
				$this->_redirect('/');
			}
		}
	}