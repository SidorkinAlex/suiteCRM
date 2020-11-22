<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');


class ContactsCustomHook
{
    function addProduct($bean, $event, $arguments)
    {
        if(empty($bean->fetched_row['id']))
        {
            $sql = "SELECT * FROM aos_products LIMIT 1";
            $result = $GLOBALS["db"]->query($sql);
            $product = $GLOBALS["db"]->fetchByAssoc($result);

            $link = 'contacts_aos_products_1';
            if($bean->load_relationship($link)){
                $bean->$link->add($product);
            }
        }
    }
}

?>