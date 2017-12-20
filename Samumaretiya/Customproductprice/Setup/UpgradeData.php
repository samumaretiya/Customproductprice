<?php

namespace Samumaretiya\Customproductprice\Setup;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
   	private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }
	
	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
		 if ( version_compare( $context->getVersion(), '2.0.1', '<' ) )
		 {
			$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
			$eavSetup->addAttribute(
				\Magento\Catalog\Model\Product::ENTITY,
				'allow_custom_price',
				[
					'group' => 'Custom Product Price',
					'type' => 'int',
					'backend' => '',
					'frontend' => '',
					'label' => 'Allow Custom Price',
					'input' => 'boolean',
					'class' => '',
					'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
					'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
					'visible' => true,
					'required' => false,
					'user_defined' => false,
					'default' => '',
					'searchable' => false,
					'filterable' => false,
					'comparable' => false,
					'visible_on_front' => false,
					'used_in_product_listing' => true,
					'unique' => false,
					'apply_to' => ''
				]
			);
		 }
		
		 if ( version_compare( $context->getVersion(), '2.0.2', '<' ) )
		 {
			$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
			$eavSetup->addAttribute(
				\Magento\Catalog\Model\Product::ENTITY,
				'allow_customer_group',
				[
					'group' => 'Custom Product Price',
					'type' => 'int',
					'backend' => '',
					'frontend' => '',
					'label' => 'Allow Customer Group',
					'input' => 'select',
					'note' => 'Allow Customer Group',
					'class' => '',
					'source' => 'Samumaretiya\Customproductprice\Model\Config\Source\Options',
					'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
					'visible' => true,
					'required' => false,
					'user_defined' => true,
					'default' => '0',
					'searchable' => false,
					'filterable' => false,
					'comparable' => false,
					'visible_on_front' => true,
					'used_in_product_listing' => true,
					'unique' => false,
					'option' => [
						'values' => [],
					]
				]
			);
		 }
    }
}