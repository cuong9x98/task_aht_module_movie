<?php
 
namespace AHT\Movie\Plugin;


class RenameFirstName 
{    
	public function beforeSave(\Magento\Customer\Model\Customer $subject)
	{
		// $this->setFirstname('hihi');
		$subject->setFirstname('anh tuyen dep giai');
		return $this;
	}
}