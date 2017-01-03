 <?php
	class CaioFlavio_PDFCart_Block_Quote extends Mage_Core_Block_Template{
		public function getPageTitle($storeid){
			return Mage::getStoreConfig('pdfcart/general/page_title', $storeid);
		}

		public function getLogoPath($storeid){
			return $this->getSkinUrl('images/'.Mage::getStoreConfig('pdfcart/general/logo_name', $storeid));
		}

		public function getDate(){
			return Mage::getModel('core/date')->date('d/m/Y H:i:s');
		}
		
		public function getQuoteData(){
			$cart  		= Mage::getModel('checkout/cart')->getQuote();
			$cartItems  = array();
			foreach ($cart->getAllItems() as $item) {
				$cartItems[] = (object) array(
					'name' 		=> $item->getProduct()->getName(),
					'price'		=> $item->getProduct()->getPrice(),
					'qty'		=> $item->getQty(),
					'subtotal'	=> $item->getProduct()->getPrice() * $item->getQty(),
				);
			}

			return $cartItems;
		}

		public function getQuoteTotal(){
			$cart  		= Mage::getModel('checkout/cart')->getQuote();
			$total 		= 0;
			foreach ($cart->getAllItems() as $item) {
				$total +=  $item->getProduct()->getPrice() * $item->getQty();
			}

			return $total;
		}
	}