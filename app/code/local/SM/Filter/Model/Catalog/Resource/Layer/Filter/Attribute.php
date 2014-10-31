<?php

class SM_Filter_Model_Catalog_Resource_Layer_Filter_Attribute 
    extends Mage_Catalog_Model_Resource_Layer_Filter_Attribute
{

    public function applyFilterToCollection($filter, $value)
    {
        if (!is_array($value)) {
            return parent::applyFilterToCollection($filter, $value);
        }
        if (count($value) < 2) {
            return parent::applyFilterToCollection($filter, $value[0]);    
        }

        $collection = $filter->getLayer()->getProductCollection();
        $attribute = $filter->getAttributeModel();
        $connection = $this->_getReadAdapter();
        $tableAlias = $attribute->getAttributeCode() . '_idx';
        $conditions = array(
            "{$tableAlias}.entity_id = e.entity_id",
            $connection->quoteInto("{$tableAlias}.attribute_id = ?", $attribute->getAttributeId()),
            $connection->quoteInto("{$tableAlias}.store_id = ?", $collection->getStoreId()),
        );

        $conditions[] = "{$tableAlias}.value in ( ";
        foreach ($value as $v) {
            $conditions[count($conditions) - 1] .= $connection->quoteInto("?", $v) . ' ,';
        }
        $conditions[count($conditions) - 1] = rtrim($conditions[count($conditions) - 1], ',');
        $conditions[count($conditions) - 1] .= ')';

        $collection->getSelect()->join(
            array($tableAlias => $this->getMainTable()), 
            implode(' AND ', $conditions), 
            array()
        );

        $collection->getSelect()->distinct();

        return $this;
    }

    public function getCount($filter)
    {
        // clone select from collection with filters
        $select = clone $filter->getLayer()->getProductCollection()->getSelect();
        // reset columns, order and limitation conditions
        $select->reset(Zend_Db_Select::COLUMNS);
        $select->reset(Zend_Db_Select::ORDER);
        $select->reset(Zend_Db_Select::LIMIT_COUNT);
        $select->reset(Zend_Db_Select::LIMIT_OFFSET);

        $connection = $this->_getReadAdapter();
        $attribute  = $filter->getAttributeModel();
        $tableAlias = sprintf('%s_idx', $attribute->getAttributeCode());
        $conditions = array(
            "{$tableAlias}.entity_id = e.entity_id",
            $connection->quoteInto("{$tableAlias}.attribute_id = ?", $attribute->getAttributeId()),
            $connection->quoteInto("{$tableAlias}.store_id = ?", $filter->getStoreId()),
        );

        // start removing all filters for current attribute - we need correct count
        $parts = $select->getPart(Zend_Db_Select::FROM);
        $from = array();
        foreach ($parts as $key => $part) {
            if (stripos($key, $tableAlias) === false) {
                $from[$key] = $part;
            }
        }
        $select->setPart(Zend_Db_Select::FROM, $from);
        // end of removing
        $select
            ->join(
                array($tableAlias => $this->getMainTable()),
                join(' AND ', $conditions),
                array('value', 'count' => new Zend_Db_Expr("COUNT({$tableAlias}.entity_id)")))
            ->group("{$tableAlias}.value");

        return $connection->fetchPairs($select);
    }

}