<?php

/**
 * Extend the magento cron schedule so that it will work with cron expression that start with @
 *
 * @category    Manners
 * @package     Manners_Cron
 * @author      David Manners <david.manners@sitewards.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Manners_Cron_Model_Observer
{
    /**
     * Array of all possible cron expression that start with @
     *  @yearly (or @annually)  Run once a year at midnight in the morning of January 1                     0 0 1 1 *
     *  @monthly                Run once a month at midnight in the morning of the first day of the month   0 0 1 * *
     *  @weekly                 Run once a week at midnight in the morning of Sunday                        0 0 * * 0
     *  @daily                  Run once a day at midnight                                                  0 0 * * *
     *  @hourly                 Run once an hour at the beginning of the hour                               0 * * * *
     *
     * @var array
     */
    private $fromCronExp = array(
        '@yearly',
        '@annually',
        '@weekly',
        '@daily',
        '@hourly'
    );

    /**
     * Array of all mappings from cron expression that start with @ to their full cron expression
     *
     * @var array
     */
    private $toCronExp = array(
        '0 0 1 1 *',
        '0 0 1 1 *',
        '0 0 1 * *',
        '0 0 * * *',
        '0 * * * *'
    );

    /**
     * Get the current cron expression from the event and update using the from and to mapping information
     *
     * @param Varien_Event_Observer $observer
     */
    public function setCronExpressionBefore(Varien_Event_Observer $observer)
    {
        $cronExpression = $observer->getEvent()->getCronExpression();

        $newCronExpression = str_replace($this->fromCronExp, $this->toCronExp, $cronExpression->getCronExpression());

        $cronExpression->setCronExpression($newCronExpression);
    }
}