<?php
require_once '../config.php';
require '../Interface/Idb.php';
class MemberController extends DBController
{
  private $currentMenberID;

  public function __construct($db)
  {
    parent::__construct($db);
    $this->SetCurrentMemberID();
  }

  public function SetCurrentMemberID()
  {
    if (isset($_SESSION["MemberID"])) {
      $this->currentMenberID = $_SESSION["MemberID"];
      $this->Member = $this->Member->getMemberClassById($this->currentMenberID);
    } else {
      $this->currentMenberID = null;
    }
  }

  public function GetMemberBySession()
  {
    $this->SetCurrentMemberID();
    if (isset($this->currentMenberID)) {
      return $this->Member->getMemberClassById($this->currentMenberID);
    }
  }
  public function UpdateMember(array $data)
  {
    // $this->currentMember->memberID = $data["memberID"];
    // $this->currentMember->localMemberID = $data["localMemberID"];
    $this->Member->firstName = $data["firstName"];
    $this->Member->lastName = $data["lastName"];
    $this->Member->address1 = $data["address1"];
    $this->Member->address2 = $data["address2"];
    $this->Member->postalCode = $data["postalCode"];
    $this->Member->city = $data["city"];
    $this->Member->phone = $data["phone"];
    $this->Member->email = $data["email"];
    // $this->currentMember->joinDate = $data["joinDate"];
    //$this->currentMember->directDebitAgreement = $data["directDebitAgreement"];
    //$this->currentMember->membershipPaidUntil = $data["membershipPaidUntil"];
    //$this->currentMember->youthMembership = $data["youthMembership"];
    //$this->currentMember->youthMembershipYear = $data["youthMembershipYear"];
    if (!isset($data["isApua"]) || $data["isApua"] == null || empty($data["isApua"] || $data["isApua"] === 0)) {
      $this->Member->isApua = false;
    } else {
      $this->Member->isApua = true;
    }
    //$this->currentMember->isDistrictAdmin = $data["regionAdmin"];
    //$this->currentMember->isAdmin = $data["admin"];
    if (!isset($data["allowRegion"]) || $data["allowRegion"] == null || empty($data["allowRegion"] || $data["allowRegion"] === 0)) {
      $this->Member->allowRegion = false;
    } else {
      $this->Member->allowRegion = true;
    }
    if (!isset($data["allowAll"]) || $data["allowAll"] == null || empty($data["allowAll"] || $data["allowAll"] === 0)) {
      $this->Member->allowAll = false;
    } else {
      $this->Member->allowAll = true;
    }
    $this->Member->passWord = $data["passWord"];
    //$this->currentMember->passWordChanged = $data["passWordChanged"];
    try {
      return $this->Member->updateMemberByClass();
    } catch (Exception $ex) {
      echo "<script>console.log({'$ex'})</script>";
      echo "<script>alert('kunne ikke oprette bruger')</script>";
      exit;
    }
  }
}
