<?php
include_once __DIR__.'/classes/classes.php';

$userStatus = User::GetUserStatus();

// Страница для неавторизированных пользователей.
if ($userStatus !='authorized'){ echo HTML::ShowAuthorizationPage('actions.php?action=login'); exit; }


// Страница для авторизированных пользователей.
if ($userStatus =='authorized')
{
// Получаем данные о текущей странице.
$page=Data::GET('page');
if ($page == '') $page = 'table'; // По умолчанию.

// Получаем все данные о пользователе.
$UserDataArray = User::GetAllUserDataBasedOnUserCookie();
$userRole = $UserDataArray['user_role'];

// Формируем ФИО.
$UserFIO = $UserDataArray['user_surname'].' '.$UserDataArray['user_name'].' '.$UserDataArray['user_patronymic'];
// Панель пользователя.
$userInformation="Здравствуйте, $UserFIO";
$userButtons[0]=['panel__button ','/actions.php?action=logout', 'Выход'];
$pageUserPanel=HTML::ShowUserPanelMarkup($userInformation, $userButtons);	

// Главное меню.
$pageTopMenuArray[0] =  ['page__menu_link menu-link_normal','index.php?page=table&page_number=1', 'Таблица'];
if ($userRole == 'Администратор') $pageTopMenuArray[1] =  ['page__menu_link menu-link_normal','index.php?page=admin&section=address', 'Администрирование'];	



// Изменение стиля ссылок меню.
if ($page == 'table') $pageTopMenuArray[0][0] = 'menu-link_active';
if ($page == 'admin') $pageTopMenuArray[1][0] = 'menu-link_active';
$pageTopMenu=HTML::ShowMenu($pageTopMenuArray);

// Подключение страниц.
if ($page == 'table') $pageСontent = HTML::GetHTMLCode(__DIR__.'/pages/table.php');
if ($page == 'admin') $pageСontent = HTML::GetHTMLCode(__DIR__.'/pages/admin.php');

// Рендеринг страницы.
echo HTML::ShowPage('Главная страница',$pageTopMenu, $pageUserPanel, $pageСontent);
}
?>