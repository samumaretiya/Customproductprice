<?php
namespace Samumaretiya\Customproductprice\Observer;

class Customproductpricecollection implements \Magento\Framework\Event\ObserverInterface
{
  protected $_sessionFactory;
  public function __construct(
		\Magento\Customer\Model\SessionFactory $sessionFactory
  )
  {
		$this->_sessionFactory = $sessionFactory;
  }
  public function execute(\Magento\Framework\Event\Observer $observer)
  {
     $productCollection = $observer->getEvent()->getCollection();
	 $customerSession = $this->_sessionFactory->create();
	 foreach($productCollection as $product)
	 {
		 if($product->getAllowCustomPrice())
		 {
			 if($product->getAllowCustomerGroup() != "" && $product->getAllowCustomerGroup() == 1)
			 {
				 if($product->getCustomMinimumPrice() != "")
				 {
					 $custom_minimum_price = $product->getCustomMinimumPrice();
					 $product->setCustomPrice($custom_minimum_price);
					 $product->setPrice($custom_minimum_price);
				 }
			 }
			 else
			 {
				if($customerSession->isLoggedIn()) {
					if($customerSession->getData('customer_group_id') == $product->getAllowCustomerGroup())
					{
						if($product->getCustomMinimumPrice() != "")
						{
							 $custom_minimum_price = $product->getCustomMinimumPrice();
							 $product->setCustomPrice($custom_minimum_price);
							 $product->setPrice($custom_minimum_price);
						}
					}
				}
			 }
		 }
	 }
     return $this;
  }
}

