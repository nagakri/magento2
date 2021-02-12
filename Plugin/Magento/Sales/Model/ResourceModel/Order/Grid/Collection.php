<?php

namespace Signifyd\Connect\Plugin\Magento\Sales\Model\ResourceModel\Order\Grid;

use Magento\Sales\Model\ResourceModel\Order\Grid\Collection as GridCollection;

class Collection
{
    public function beforeAddFieldToFilter(GridCollection $subject, $field, $condition = null)
    {
        if (in_array($field, ['signifyd_score', 'signifyd_guarantee'])) {
            $field = str_replace('signifyd_', '', $field);
            $subject->join(
                ['signifyd_connect_case' => $subject->getTable('signifyd_connect_case')],
                'main_table.increment_id = signifyd_connect_case.order_increment',
                ['score', 'guarantee']
            );
        }

        return [$field, $condition];
    }
}
