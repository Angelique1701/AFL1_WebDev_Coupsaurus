<?php
require_once 'model_Agency.php';
require_once 'model_Group.php';

$modelAgency = new AgencyModel();
$modelGroup = new GroupModel();

$controller = $_GET['controller'] ?? 'agency';
$action     = $_GET['action'] ?? 'list';

if ($controller == 'agency') {
    if ($action == 'list') {
        $agencies = $modelAgency->getAgency();
        include 'view_AgencyList.php';
    } elseif ($action == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $modelAgency->addAgency($_POST['company_name'], $_POST['location'], $_POST['ceo_name'], $_POST['founding_year']);
        header('Location: controller.php?controller=agency&action=list');
    } elseif ($action == 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $modelAgency->updateAgency($_POST['company_id'], $_POST['company_name'], $_POST['location'], $_POST['ceo_name'], $_POST['founding_year']);
        header('Location: controller.php?controller=agency&action=list');
    } elseif ($action == 'delete' && isset($_GET['id'])) {
        $modelAgency->deleteAgency($_GET['id']);
        header('Location: controller.php?controller=agency&action=list');
    } elseif ($action == 'showUpdateForm' && isset($_GET['id'])) {
        $agency = $modelAgency->getAgencyById($_GET['id']);
        include 'view_AgencyUpdate.php';
    } elseif ($action == 'showAddForm') {
        include 'view_AgencyAdd.php';
    } else {
        echo "Action agency tidak dikenali";
    }

} elseif ($controller == 'group') {
    if ($action == 'list') {
        $groups = $modelGroup->getGroups();
        include 'view_GroupList.php';
    } elseif ($action == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $modelGroup->addGroup($_POST['company_id'], $_POST['group_name'], $_POST['gdebut_date'], $_POST['status']);
        header('Location: controller.php?controller=group&action=list');
    } elseif ($action == 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $modelGroup->updateGroup($_POST['group_id'], $_POST['company_id'], $_POST['group_name'], $_POST['gdebut_date'], $_POST['status']);
        header('Location: controller.php?controller=group&action=list');
    } elseif ($action == 'delete' && isset($_GET['id'])) {
        $modelGroup->deleteGroup($_GET['id']);
        header('Location: controller.php?controller=group&action=list');
    } elseif ($action == 'showUpdateForm' && isset($_GET['id'])) {
        $group = $modelGroup->getGroupById($_GET['id']);
        $agencies = $modelAgency->getAgency();
        include 'view_GroupUpdate.php';
    } } elseif ($controller == 'group') {
        if ($action == 'list') {
            // Cek apakah ada parameter agency_id di URL
            if (isset($_GET['agency_id'])) {
                $groups = $modelGroup->getGroupsByAgencyId($_GET['agency_id']);
            } else {
                $groups = $modelGroup->getGroups();
            }
            include 'views/group/list.php';
        }  else {
        echo "Action group tidak dikenali";
    }

} else {
    echo "Controller tidak dikenali";
}
?>
