<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UserTable;

$users = array();

$filter = array(
    "GROUPS_ID" => array(1) // ID группы администраторов
);

$userResult = CUser::GetList(($by="ID"), ($order="ASC"), $filter);
        
while ($user = $userResult->Fetch()) {
    $users[] = $user;
}
$this->arResult["USERS"] = $users;

$this->includeComponentTemplate();