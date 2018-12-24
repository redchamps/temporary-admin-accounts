<?php
/**
 * Created by PhpStorm.
 * User: rav
 * Date: 2018-12-24
 * Time: 13:48
 */
namespace RedChamps\TemporaryAdminAccounts\Controller\Adminhtml\User;

class Temporary extends \Magento\User\Controller\Adminhtml\User
{
    public function execute()
    {
        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Temporary Users'));
        $this->_view->renderLayout();
    }
}