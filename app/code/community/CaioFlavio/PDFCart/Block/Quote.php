 <?php
	class CaioFlavio_PDFCart_Block_Quote extends Mage_Core_Block_Template{
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