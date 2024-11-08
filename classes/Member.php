<?php

class Member {
    // Attributter for klassen Member
    public $memberID;
    public $localMemberID;
    public $firstName;
    public $lastName;
    public $address1;
    public $address2;
    public $postalCode;
    public $city;
    public $phone;
    public $email;
    public $enrollmentDate;
    public $agreement;
    public $membershipPaidUntil;
    public $youthMembership;
    public $cutOffYearForYouthMembership;
    public $isAqua;
    public $isDistrictAdmin;
    public $isAdmin;
    public $hasLimitedRights;
    public $hasFullRights;

    // Constructor til initialisering af attributter
    public function __construct(
        $memberID, $localMemberID, $firstName, $lastName, $address1, $address2,
        $postalCode, $city, $phone, $email, $enrollmentDate, $agreement,
        $membershipPaidUntil, $youthMembership, $cutOffYearForYouthMembership,
        $isAqua, $isDistrictAdmin, $isAdmin, $hasLimitedRights, $hasFullRights
    ) {
        $this->memberID = $memberID;
        $this->localMemberID = $localMemberID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->phone = $phone;
        $this->email = $email;
        $this->enrollmentDate = $enrollmentDate;
        $this->agreement = $agreement;
        $this->membershipPaidUntil = $membershipPaidUntil;
        $this->youthMembership = $youthMembership;
        $this->cutOffYearForYouthMembership = $cutOffYearForYouthMembership;
        $this->isAqua = $isAqua;
        $this->isDistrictAdmin = $isDistrictAdmin;
        $this->isAdmin = $isAdmin;
        $this->hasLimitedRights = $hasLimitedRights;
        $this->hasFullRights = $hasFullRights;
    }

    // Eksempel på en metode til at vise en beskrivelse af medlemmet
    public function getMemberInfo() {
        return "Medlem: $this->firstName $this->lastName, ID: $this->memberID";
    }
}
