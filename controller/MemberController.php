<?php
require_once '../config.php';
require '../Interface/Idb.php';
class MemberController extends DBController
{
  public $currentMember;

  public function __construct($db)
  {
    parent::__construct($db);
    $this->SetCurrentMemberID();
  }

  //* controller setting functions
  public function SetCurrentMemberID()
  {
    if (isset($_SESSION["MemberID"])) {
      $this->currentMember = $this->Member->getMemberById($_SESSION["MemberID"]);
    } else {
      $this->currentMember = null;
    }
  }

  //? CRUD funktions ////////////////////////////////////
  //* CREATE funktions //////////////////////////////////

  public function CreateMember($post)
  {
    $this->Member->localMemberID          = $this->getAllClubs()[$_POST["club"] - 1]["Abbreviation"] . strval(str_pad($this->GetClubCount($_POST["club"] - 1) + 1, 3, 0, STR_PAD_LEFT));
    $this->Member->firstName              = $_POST["firstName"];
    $this->Member->lastName               = $_POST["lastName"];
    $this->Member->address1               = null;
    $this->Member->address2               = null;
    $this->Member->postalCode             = null;
    $this->Member->city                   = null;
    $this->Member->phone                  = null;
    $this->Member->email                  = $_POST["email"];
    $this->Member->directDebitAgreement   = false;
    $this->Member->membershipPaidUntil    = $_POST["membershipPaidUntil"];
    $this->Member->youthMembership        = isset($_POST["youthMembership"]) ? true : false;
    $this->Member->youthMembershipYear    = $_POST["youthMembershipYear"];
    $this->Member->isApua                 = null;
    $this->Member->isDistrictAdmin        = isset($_POST["regionAdmin"]) ? true : false;
    $this->Member->isAdmin                = isset($_POST["Admin"]) ? true : false;
    $this->Member->allowRegion            = false;
    $this->Member->allowAll               = false;
    $this->Member->passWord               = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $this->Member->passWordChanged        = false;
  }

  //* READ funktions ////////////////////////////////////
  public function GetAllMember()
  {
    return $this->Member->getAllMembers();
  }

  public function GetClubCount($clubId)
  {
    return count($this->ClubRelation->getClubRelationsByClub($clubId));
  }

  public function GetAllClubs()
  {
    return $this->Club->getAllClubs();
  }

  /**
   * GetClubsMemberIsIn gets a list of clubs according to the member <-> relation
   * @param int $id id of member defults to current member
   * @return array[Club]
   */
  //public function GetClubsMemberIsIn(int $id = $this->currentMember->memberID) {}


  /**
   * Summary of GetMemberID
   * @param string $localId
   * @return Member object beassed on id given, null if not found
   */
  public function GetMemberID(int $id)
  {
    return $this->Member->getMemberById($id);
  }

  /**
   * Summary of GetMemberLocalID
   * @param string $localId
   * @return Member object beassed on id given, null if not found
   */
  public function GetMemberLocalID(string $localId)
  {
    return $this->Member->getMemberByLocalMemberID($localId);
  }

  /**
   * Summary of GetMemberBySession
   * @return array[]|Member empty:array if $_SESSION["MemberID"] not set
   */
  public function GetMemberBySession()
  {
    $this->SetCurrentMemberID();
    if ($this->currentMember == null) {
      return [];
    }
    return $this->currentMember;
  }

  //* UPDATE funtion ////////////////////////////////////
  /**
   * Takes $_post result from a form, takes
   * @param array $post from $_POST
   * @return mixed rerurns member objekt
   */
  public function UpdateMemberByPost(array $post)
  {
    $this->Member = $this->Member->getMemberById($this->currentMember->memberID);
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
    if (!empty($post["passWord"])) {
      $this->Member->passWord   = password_hash($post["passWord"], PASSWORD_DEFAULT);
      $this->Member->passWordChanged = true;
    }
    $this->Member->updateMember();
  }

  //* Delete funtions ////////////////////////////////////////
  /**
   * DeleteMemberByID delete Member bassed on id
   * Club and rolle relations auto delete
   * @param int $id of the to be deleted
   * @return mixed database complition string
   */
  public function DeleteMemberByID(int $id)
  {
    return $this->Member->deleteMember($id);
  }

  //? Log ind /////////////////////////////////////////////////
  public function UserLogInd(string $userid, string $password)
  {
    if (empty(trim($userid))) {
      throw new ErrorException("Bruger id forkert", 1, 1, "MemberController", 116);
    } else {
      $userid = trim($userid);
    }

    if (empty(trim($password))) {
      throw new ErrorException("kode ord forkert", 1, 1, "MemberController", 122);
    } else {
      $password = trim($password);
    }

    // if and try blocks to catch both Exception err and empty value err
    try {
      $this->Member = $this->Member->getMemberByLocalMemberID($userid);
      $DBmemberole = $this->MemberRoles->getMemberRoleByMember($this->Member->memberID);
      $DBresponsibilities = $this->Responsibilities->getResponsibilityById($DBmemberole["RoleID"]);
    } catch (Exception $ex) {
      throw new ErrorException("kunne ikke finde bruger", 1, 1, "MemberController", 133);
    }
    if (empty($this->Member->localMemberID)) {
      throw new ErrorException("kode ord forkert", 1, 1, "MemberController", 136);
    }

    if (password_verify($password, $this->Member->passWord)) {
      // if password currect starts new session with user data
      $this->SetUpSession($DBresponsibilities['Role']);
      header("location: mainMenu.php");
      exit;
    } else {
      throw new ErrorException("kode ord forkert", 1, 1, "MemberController", 145);
    }
  }

  public function SetUpSession(string $role)
  {
    session_start();
    $_SESSION["loggedin"]    = true;
    $_SESSION["MemberID"]    = $this->Member->memberID;
    $_SESSION["localID"]     = $this->Member->localMemberID;
    $_SESSION["useraName"]   = $this->Member->firstName . " " . $this->Member->lastName["LastName"];
    $_SESSION["regionAdmin"] = $this->Member->isDistrictAdmin;
    $_SESSION["admin"]       = $this->Member->isAdmin;
    $_SESSION["MemberRole"]  = $role;
  }
}
