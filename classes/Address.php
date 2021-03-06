<?php
include_once __DIR__.'/MySQL.php';

class Address
{


// Проверка существования адреса.
static function AddressIdExist($id) {
$query = "SELECT `id` FROM `techmaptable` WHERE `id` = '$id' LIMIT 1";
$queryResult = MySQL::MySQLQuery($query);
$result = $queryResult->num_rows;
return $result;
}

// Показать список адресов.
static function GetAddressList() {
$query = "SELECT `id`,`field1` FROM `techmaptable` ORDER BY id DESC";
$queryResult = MySQL::MySQLQuery($query);
$num_rows = $queryResult->num_rows;
if ($num_rows !=0)
{
while ($row = $queryResult->fetch_assoc()) {
$AddressListArray[] = array(
'id'=>$row['id'],
'field1'=>$row['field1'],
);
}
return $AddressListArray;
}
else
return 'no_data';
}



// Получить запись из таблицы адресов с указанным id.
static function GetAddressRow($id) {
$query = "SELECT * FROM `techmaptable` WHERE `id` = '$id' LIMIT 1";
$queryResult = MySQL::MySQLQuery($query);
$num_rows = $queryResult->num_rows;
if ($num_rows !=0)
{
while ($row = $queryResult->fetch_assoc()) {
$ResultArray[] = $row;
};
$AddressListArray = $ResultArray[0];
return $AddressListArray;
}
else
return 'no_data';	
}


// Создать новый адрес ($users_id может быть пустой - доступ для администраторов)
static function CreateNewAddress($users_id='', $field1) {
if ($field1 == '') return 'no_field1';
$query = "INSERT INTO techmaptable (users_id, field1) VALUES ('$users_id', '$field1')";
$queryResult = MySQL::MySQLQuery($query);
if ($queryResult == 1) return 'address_created';
}


// Редактировать адрес ($users_id может быть пустой - доступ для администраторов)
static function EditAddress($id, $users_id='', $field1) {
if ($field1 == '') return 'no_field1';
$addressIdExist = self::AddressIdExist($id);
if ($addressIdExist != 1) return 'address_does_not_exist';
$query = "UPDATE `techmaptable` SET users_id='$users_id', field1='$field1' WHERE id='$id'";
$queryResult = MySQL::MySQLQuery($query);
if ($queryResult == 1) return 'address_updated';
}


// Удалить адрес с указанным id.
static function DeleteAddress($id) {
$addressIdExist = self::AddressIdExist($id);
if ($addressIdExist != 1) return 'address_does_not_exist';
$query = "DELETE FROM `techmaptable` WHERE id='$id'";
$queryResult = MySQL::MySQLQuery($query);
if ($queryResult == 1) return 'address_deleted';
}




}

?>