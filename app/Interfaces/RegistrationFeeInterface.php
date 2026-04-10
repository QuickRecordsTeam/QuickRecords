<?php


namespace App\Interfaces;


interface RegistrationFeeInterface
{
    public function createRegistrationFee($request);

    public function updateRegistrationFee($request, $id);

    public function getAllRegistrationFee($request);

    public function getCurrentRegistrationFee($request);

    public function deleteRegistrationFee($id);

    public function setNewFee($id);
}
