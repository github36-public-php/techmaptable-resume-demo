<?php
include_once __DIR__.'/../classes/classes.php';

// Скрипт доступен только администраторам.
Security::AccessAdminOnly();

// Получаем данные.
$section=Data::GET('section');

// Верхнее меню панели.
$panelTopMenuArray[0] =  ['menu-link_normal','index.php?page=admin&section=address', 'Адреса'];
$panelTopMenuArray[1] =  ['menu-link_normal','index.php?page=admin&section=users', 'Пользователи'];
// Изменение стиля ссылок меню.

// Изменение пунктов меню.
$sectionSymbolPosition = strpos($section,'_');
if ($sectionSymbolPosition == 0) $sectionSymbolPosition = strlen($section);
$sectionPartOfString = substr($section, 0, $sectionSymbolPosition);
switch ($sectionPartOfString)
{
case 'address': $panelTopMenuArray[0][0] = 'menu-link_active'; break;
case 'users': $panelTopMenuArray[1][0] = 'menu-link_active'; break;
}

// Поле поиска для пользователей
//$panelTopMenuCode = HTML::ShowMenuFindForm('users','panel__content');


$panelTopMenu=HTML::ShowMenu($panelTopMenuArray, $panelTopMenuCode);





// АДРЕСА.
// Список адресов.
if ($section == 'address') $panelСontent = HTML::ShowAddressList();
// Добавить адрес.
if ($section == 'address_add') $panelСontent = HTML::ShowAddressForm(''); // Действие определено в самой форме (передавать его не нужно).
// Редактировать адрес.
if ($section == 'address_edit') $panelСontent = HTML::ShowAddressForm(''); // Действие определено в самой форме (передавать его не нужно).
// Удалить адрес - формы нет т.к. после js подтверждения сразу выполняется удаление.



// ПОЛЬЗОВАТЕЛИ.
// Список пользователей.
if ($section == 'users') $panelСontent = HTML::ShowUserList();
// Добавить пользователя.
if ($section == 'users_add') $panelСontent = HTML::ShowUserForm(''); // Действие определено в самой форме (передавать его не нужно).
// Редактировать пользователя.
if ($section == 'users_edit') $panelСontent = HTML::ShowUserForm(''); // Действие определено в самой форме (передавать его не нужно).
// Удалить пользователя - формы нет т.к. после js подтверждения сразу выполняется удаление.



// Рендеринг панели.
echo HTML::ShowPanelMarkup('',$panelTopMenu, $panelСontent, $panelBottomMenu);
?>