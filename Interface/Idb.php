<?php

require_once '../models/MemberOO.php';
require_once '../models/ClubOO.php';
require_once '../models/ClubRelationOO.php';
require_once '../models/ResponsibilitiesOO.php';
require_once '../models/MemberRolesOO.php';
require_once '../models/VehicleRegister.php';
require_once '../models/MagazineFees.php';
require_once '../models/Subscriptions.php';
require_once '../models/Newsletter.php';


class DBController
{
  protected $db;
  public $Member;
  public $Club;
  public $ClubRelation;
  public $Responsibilities;
  public $MemberRoles;
  public $VehicleRegister;
  public $MagazineFees;
  public $Subscriptions;
  public $Newsletter;

  public function __construct($db)
  {
    $this->db = $db;
    $this->Member = new Member($db);
    $this->Club = new Club($db);
    $this->ClubRelation = new ClubRelation($db);
    $this->Responsibilities = new Responsibilities($db);
    $this->MemberRoles = new MemberRoles($db);
    $this->VehicleRegister = new VehicleRegister($db);
    $this->MagazineFees = new MagazineFees($db);
    $this->Subscriptions = new Subscriptions($db);
    $this->Newsletter = new Newsletter($db);
  }
}
