<?php
header('Content-Type: application/json');
$response['msg'] = '';
$response['error'] = null;
if(isset($_POST['last_name'])  && !empty($_POST['last_name']))
{
    $bean = BeanFactory::newBean('Contacts');
    $last_name = $_POST['last_name'];
    $bean->last_name = $last_name;

    $sql = "SELECT * FROM contacts where last_name = '{$last_name}' LIMIT 1";
    $result = $GLOBALS["db"]->query($sql);
    $product = $GLOBALS["db"]->fetchByAssoc($result);

    if($product){
        $response['msg'] = "User already exists!";
        $response['error'] = 1;
    }else{
        $bean->first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
        $bean->points = isset($_POST['points']) ? $_POST['points'] : null;
        $bean->discount_number = isset($_POST['discount_number']) ? $_POST['discount_number'] : null;

        $bean->save();
        $response['msg'] = "User created!";
    }
}else{
    $response['msg'] = 'LAST_NAME IS A MUST!';
    $response['error'] = 2;
}
echo json_encode($response);