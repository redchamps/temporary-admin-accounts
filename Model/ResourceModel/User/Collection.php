<?php
/**
 * Created by PhpStorm.
 * User: rav
 * Date: 2018-12-24
 * Time: 14:05
 */
namespace RedChamps\TemporaryAdminAccounts\Model\ResourceModel\User;

use Magento\User\Model\ResourceModel\User\Collection as CoreCollection;

class Collection extends CoreCollection
{
    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->where("valid_till IS NOT NULL");
    }
}