<?php

$pages = $_GET["page"];

switch($pages){


    // MONITORING
    case "overview":
        include "overview.php";
        break;

    case "history":
        include "history.php";
        break;

    case "report":
        include "report.php";
        break;
        
    case "setting":
        include "settings.php";
        break;

    case "detail-transactions":
        include "detail-transaction.php";
        break;
        
    case "add-to-home":
        include "add-to-home.php";
        break;
        
    case "support":
        include "contact-support.php";
        break;

    case "reset-password":
        include "views/profil/reset-password.php";
        break;

    case "setting-price":
            include "views/profil/setting-price.php";
            break;
        
    case "process":
        include "process.php";
        break;
    
    // Default Routes Page
    default:
    $title_page = "CR Billing System - App";
    include "overview.php";
    break;
}

?>