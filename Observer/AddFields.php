<?php
/**
 * Created by PhpStorm.
 * User: rav
 * Date: 2018-12-24
 * Time: 12:41
 */
namespace RedChamps\TemporaryAdminAccounts\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\User\Block\User\Edit\Tab\Main as UserForm;
use Magento\Framework\Registry;

class AddFields implements ObserverInterface
{
    /**
     * Core Registry
     *
     * @var Registry
     */
    protected $registry;

    /**
     * AddFields constructor.
     * @param Registry $registry
     */
    public function __construct(
        Registry $registry
    )
    {
        $this->registry = $registry;
    }

    /**
     * @param Observer $observer
     * @return $this|void
     */
    public function execute(Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();
        if (!isset($block)) {
            return $this;
        }
        if ($block instanceof UserForm) {
            $form = $block->getForm();

            $fieldset = $form->addFieldset('temporary_user',
                [
                    'legend' => 'Is Temporary User?',
                    'class' => 'fieldset-wide'
                ],
                "base_fieldset"
            );

            $currentUser = $this->registry->registry('permissions_user');
            $value = "";
            if($currentUser && $currentUser->getId()) {
                $value = $this->registry->registry('permissions_user')->getValidTill();
            }

            $fieldset->addField('valid_till',
                'date',
                [
                    'name'        => 'valid_till',
                    'class'       => 'date',
                    'label'       => 'Valid Till',
                    'date_format' => 'yyyy-MM-dd',
                    'title'       => 'Valid Till',
                    'value'       => "$value"
                ]
            );
        }
    }
}