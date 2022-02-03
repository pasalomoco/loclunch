<?php

include_once(CFDB7."admin/adminAmbassador.php");
include_once(CFDB7."forms/ambassadorForm.php");
include_once(CFDB7."dataBase/functionsDataBase.php");

foreach (glob(EVENT_MANAGER."/functions/*.php") as $filename)
{
    include_once $filename;
}

foreach (glob(ULTIMATE_MEMBER."/functions/*.php") as $filename)
{
    include_once $filename;
}

foreach (glob(FUNCTIONALITY."*.php") as $filename)
{
    include_once $filename;
}

foreach (glob(DATABASE."*.php") as $filename)
{
    include_once $filename;
}

foreach (glob(ADMIN_FUNCTIONS."*.php") as $filename)
{
    include_once $filename;
}

foreach (glob(AMBASSADOR_FORM."*.php") as $filename)
{
    include_once $filename;
}

foreach (glob(ULTIMATE_MEMBER_AND_EVENT_MANAGER."*.php") as $filename)
{
    include_once $filename;
}


// include_once(TEST."test.php");

?>