<?php
require_once 'model_Agency.php';
require_once 'model_Group.php';

$modelAgency = new AgencyModel();
$modelGroup  = new GroupModel();

$controller = $_GET['controller'] ?? 'agency';
$action     = $_GET['action'] ?? 'list';


if ($controller == 'agency') {
    if ($action == 'list') {
        $agencies = $modelAgency->getAgency();
        include 'view_AgencyList.php';

    } elseif ($action == 'showAddForm') {
        include 'view_AgencyAdd.php';

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

    } else {
        echo "Action agency tidak dikenali";
    }


} elseif ($controller == 'group') {
    if ($action == 'list') {
        if (isset($_GET['agency_id'])) {
            $groups = $modelGroup->getGroupsByAgencyId($_GET['agency_id']);
        } else {
            $groups = $modelGroup->getGroups();
        }
        include 'view_GroupList.php';

    } elseif ($action == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $company_id = $_POST['company_id'];
        $modelGroup->addGroup($company_id, $_POST['group_name'], $_POST['gdebut_date'], $_POST['status']);
        header('Location: controller.php?controller=group&action=list&agency_id=' . $company_id);

    } elseif ($action == 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $company_id = $_POST['company_id'];
        $modelGroup->updateGroup($_POST['group_id'], $company_id, $_POST['group_name'], $_POST['gdebut_date'], $_POST['status']);
        header('Location: controller.php?controller=group&action=list&agency_id=' . $company_id);

    } elseif ($action == 'delete' && isset($_GET['id'])) {
        $group = $modelGroup->getGroupById($_GET['id']); // ambil company_id dulu
        $modelGroup->deleteGroup($_GET['id']);
        header('Location: controller.php?controller=group&action=list&agency_id=' . $group['company_id']);

    } elseif ($action == 'showUpdateForm' && isset($_GET['id'])) {
        $group    = $modelGroup->getGroupById($_GET['id']);
        $agencies = $modelAgency->getAgency();
        include 'view_GroupUpdate.php';

    } elseif ($action == 'showAddForm' && isset($_GET['agency_id'])) {
        $agency_id = $_GET['agency_id'];
        include 'view_GroupAdd.php';

    } elseif ($action == 'listByAgency') {
        $company_id = $_GET['company_id'];
        $groups = $modelGroup->getGroupsByAgencyId($company_id);
        include 'view_GroupList.php';
    
    } else {
        echo "Action group tidak dikenali";
    }

} else {
    echo "Controller tidak dikenali";
}
?>
