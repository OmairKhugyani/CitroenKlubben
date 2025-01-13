<?php
require_once '../config.php';
require '../Interface/Idb.php';
class MemberController extends DBController
{
  private $currentMemberID;
  private $currentMember;

  public function __construct($db)
  {
    parent::__construct($db);
    $this->SetCurrentMemberID();
  }

  public function SetCurrentMemberID()
  {
    if (isset($_SESSION["MemberID"])) {
      $this->currentMemberID = $_SESSION["MemberID"];
      $this->Member = $this->Member->getMemberClassById($this->currentMemberID);
    } else {
      $this->currentMemberID = null;
    }
  }

  public function GetMemberBySession()
  {
    $this->SetCurrentMemberID();
    if (isset($this->currentMenberID)) {
      return $this->Member->getMemberClassById($this->currentMemberID);
    }
  }
  /**
   * Takes $_post result from a form, takes
   * @param array $post from $_POST
   * @return mixed rerurns member objekt
   */
  public function UpdateMemberByPost(array $post)
  {
    $this->Member->memberID    = $this->currentMemberID;
    $this->Member->firstName   = $post["firstName"];
    $this->Member->lastName    = $post["lastName"];
    $this->Member->address1    = $post["address1"];
    $this->Member->address2    = $post["address2"];
    $this->Member->postalCode  = $post["postalCode"];
    $this->Member->city        = $post["city"];
    $this->Member->phone       = $post["phone"];
    $this->Member->email       = $post["email"];
    $this->Member->isApua      = isset($post["isApua"]) ? true : false;
    $this->Member->allowRegion = isset($post["allowRegion"]) ? true : false;
    $this->Member->allowAll    = isset($post["allowAll"]) ? true : false;
    $this->Member->passWord    = password_hash($post["passWord"], PASSWORD_DEFAULT);

    return $this->Member->updateMemberByClass();
  }
}
