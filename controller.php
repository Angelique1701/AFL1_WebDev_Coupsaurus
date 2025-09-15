<?php
//menyertakan file external 
//require_one itu dia masukin sekali meskipun diminta berkali kali
require_once 'model_Agency.php';
require_once 'model_Group.php';

//yg kiri sebagai jembatan antara controller dan model dan kita kasi nama ny sebagai AgencyModel
//yg kanan sebagai inisiasi nya
$modelAgency = new AgencyModel();
$modelGroup  = new GroupModel();

//tanda tanya itu nanya null ato ga, kl ga null yg jalan yg sebelah kiri kalo null yg jalan yg sebelah kanan
//$_get[controller] itu ambil dari url controller.php?controller=agency
//tanda tanya agency itu kalo get controllerny null itu bakal ambil data dari agency, kl ga null bakal ambil default agency
$controller = $_GET['controller'] ?? 'agency';
//$action itu ambil dari url controller.php?controller=agency&action=list
//kalo actionnya null itu bakal pake default list, kl ga null yg jalan nya yg get tapi ada tanda tanya nya
$action     = $_GET['action'] ?? 'list';


if ($controller == 'agency') {
    if ($action == 'list') {
        $agencies = $modelAgency->getAgency();
        include 'view_AgencyList.php';

    } elseif ($action == 'showAddForm') { //memenuhi get action=showAddForm
        include 'view_AgencyAdd.php'; //tampil form add agency

    } elseif ($action == 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') { // kl action add terus di submit lewat post
        $modelAgency->addAgency($_POST['company_name'], $_POST['location'], $_POST['ceo_name'], $_POST['founding_year']); //manggil function addAgency di model trus diisi data dari form
        header('Location: controller.php?controller=agency&action=list');//balik ke list agency

    } elseif ($action == 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') { // kl action update terus di submit lewat post
        $modelAgency->updateAgency($_POST['company_id'], $_POST['company_name'], $_POST['location'], $_POST['ceo_name'], $_POST['founding_year']); //manggil function updateAgency di model trus diisi data dari form
        header('Location: controller.php?controller=agency&action=list'); //balik ke list agency

    } elseif ($action == 'delete' && isset($_GET['id'])) { //buat mastiin action yg dipilih delete dan ada id di url, kl ada baru jalan
        $modelAgency->deleteAgency($_GET['id']); //manggil function deleteAgency di model trus mengdelete data berdasarkan id yg diambil
        header('Location: controller.php?controller=agency&action=list'); //balik ke list agency

    } elseif ($action == 'showUpdateForm' && isset($_GET['id'])) { //buat mastiin action yg dipilih showUpdateForm dan ada id di url, kl ada baru jalan
        $agency = $modelAgency->getAgencyById($_GET['id']); //manggil function getAgencyById di model trus ngambil data berdasarkan id yg diambil
        include 'view_AgencyUpdate.php'; //tampil form update agency

    } else {
        echo "Action agency tidak dikenali"; //buat mastiin kl action yg dipilih ga ada diatas, bakal muncul tulisan ini
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
