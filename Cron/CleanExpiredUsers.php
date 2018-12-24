<?php
/**
 * Created by PhpStorm.
 * User: rav
 * Date: 2018-12-24
 * Time: 16:12
 */
namespace RedChamps\TemporaryAdminAccounts\Cron;

use RedChamps\TemporaryAdminAccounts\Model\ResourceModel\User\Collection;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class CleanExpiredUsers
{
    /**
     * User Collection
     *
     * @var Collection
     */
    protected $collection;

    /**
     * Time Zone Interface
     *
     * @var TimezoneInterface
     */
    protected $timezone;

    /**
     * CleanExpiredUsers constructor.
     * @param Collection $collection
     * @param TimezoneInterface $timezone
     */
    public function __construct(
     Collection $collection,
     TimezoneInterface $timezone
    )
    {
     $this->collection = $collection;
     $this->timezone = $timezone;
    }

    public function execute()
    {
        $currentDateTime = $this->timezone->date();
        $currentDate = $currentDateTime->format("Y-m-d");
        $expiredUsers = $this->collection->addFieldToFilter(
            'valid_till',
            ['lt' => $currentDate]
        );
        foreach ($expiredUsers as $expiredUser) {
            $expiredUser->delete();
        }
    }
}