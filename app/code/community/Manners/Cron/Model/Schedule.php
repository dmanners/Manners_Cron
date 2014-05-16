<?php

/**
 * Extend the magento cron schedule so that it will work with cron expression that start with @
 *
 * @category    Manners
 * @package     Manners_Cron
 * @author      David Manners <david.manners@sitewards.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Manners_Cron_Model_Schedule extends Mage_Cron_Model_Schedule
{
    /**
     * Fire an event that can be used to latch onto to update the cron expression
     *
     * @param string $requestedCronExpression
     * @return Manners_Cron_Model_Schedule $this
     */
    public function setCronExpr($requestedCronExpression)
    {
        $cronExpression = new Varien_Object();
        $cronExpression->setCronExpression($requestedCronExpression);
        Mage::dispatchEvent('set_cron_expression_before', array('cron_expression' => $cronExpression));

        return parent::setCronExpr($cronExpression->getCronExpression());
    }
}