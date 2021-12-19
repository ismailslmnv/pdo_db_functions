<?

include 'inc/header.php';

$db = new DB();
$db->setCharSet('utf8');
try {
    $res = $db->update('User')
        ->set(['full_name' => 'test2'])
        ->where(['nick_name =' => 'test'])
        ->execute()
        ->affectedRows();
    print_r($res);

    $user_data = $db->select('User')
        ->where(['nick_name =' => 'test'])
        ->get();
} catch (Exception $e) {
    echo $e->getMessage();
}
