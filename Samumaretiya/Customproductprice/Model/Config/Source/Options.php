<?php 
namespace Samumaretiya\Customproductprice\Model\Config\Source; 
 
use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory; 
use Magento\Framework\DB\Ddl\Table; 
 
class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource 
{ 
    public function getAllOptions() 
    { 
        $this->_options = [
            ['label'=>'General', 'value'=>'1'],
            ['label'=>'Wholesale', 'value'=>'2'],
            ['label'=>'Retailer', 'value'=>'3']
        ]; 
        return $this->_options;
    }
 
   
    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }
}