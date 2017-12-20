<?php
namespace Samumaretiya\Customproductprice\Observer;

class Customproductaddwprice implements \Magento\Framework\Event\ObserverInterface
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
  	 $item  	= $observer->getEvent()->getData('quote_item');
	 $product	= $observer->getEvent()->getData('product');
	 $customerSession = $this->_sessionFactory->create();
	 $item 		= ( $item->getParentItem() ? $item->getParentItem() : $item );
	 if($product->getAllowCustomPrice())
	 {
		 if($product->getAllowCustomerGroup() != "" && $product->getAllowCustomerGroup() == 1)
		 {
			 if($product->getCustomMinimumPrice() != "")
			 {
				 $custom_minimum_price = $product->getCustomMinimumPrice();
				 $item->setCustomPrice($custom_minimum_price);
				 $item->setOriginalCustomPrice($custom_minimum_price);
				 $item->getProduct()->setIsSuperMode(true);
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
		 				  $item->setCustomPrice($custom_minimum_price);
		                  $item->setOriginalCustomPrice($custom_minimum_price);
		 				  $item->getProduct()->setIsSuperMode(true);
					}
				}
			}
		 }
	 }
  }
}