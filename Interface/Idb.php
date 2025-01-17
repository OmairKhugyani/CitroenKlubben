<?php

require_once '../models/MemberOO.php';
require_once '../models/Club.php';
require_once '../models/ClubRelation.php';
require_once '../models/Responsibilities.php';
require_once '../models/MemberRoles.php';
require_once '../models/VehicleRegister.php';
require_once '../models/MagazineFees.php';
require_once '../models/Subscriptions.php';
require_once '../models/Newsletter.php';


class DBController
{
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
