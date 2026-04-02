<?php


namespace App\Services;


use App\Constants\SessionStatus;
use App\Exceptions\ResourceNotFoundException;
use App\Http\Resources\RegisterFeeResource;
use App\Interfaces\RegistrationFeeInterface;
use App\Models\Registration;

class RegistrationFeeService implements RegistrationFeeInterface
{

    public function createRegistrationFee($request)
    {
        $exist_fee = $this->getActiveRegistrationFee();
        if ($exist_fee) {
            throw new ResourceNotFoundException('An active registration fee already exists. Please update the existing fee or set it to inactive before creating a new one.');
        }
        Registration::create([
            'is_compulsory' => $request->is_compulsory,
            'amount'        => $request->amount,
            'status'        => SessionStatus::ACTIVE,
            'frequency'     => $request->frequency,
            'updated_by'    => $request->user()->name
        ]);
    }

    public function updateRegistrationFee($request, $id)
    {
        $activeRegFee = $this->getActiveRegistrationFee();
        if (SessionStatus::ACTIVE == $request->status) {
            $activeRegFee->update([
                'status' => SessionStatus::IN_ACTIVE
            ]);
        }
        $updated = Registration::findOrFail($id);
        $updated->update([
            'is_compulsory' => $request->is_compulsory,
            'amount'        => $request->amount,
            'frequency'     => $request->frequency,
            'status'        => $request->status
        ]);
    }

    public function getAllRegistrationFee($request)
    {
        $reg_fees = Registration::orderBy('updated_at', 'DESC')->get();

        return RegisterFeeResource::collection($reg_fees);
    }

    public function getCurrentRegistrationFee()
    {
        $fee = $this->getActiveRegistrationFee();
        if (!$fee) {
            throw new ResourceNotFoundException('No active registration fee found');
        }
        return $fee;
    }

    public function deleteRegistrationFee($id)
    {
        Registration::findOrFail($id)->delete();
    }

    public function setNewFee($id)
    {
        $exist = Registration::where('status', SessionStatus::ACTIVE);
        $exist->update('status', SessionStatus::IN_ACTIVE);
        Registration::findOrFail($id)->update('status', SessionStatus::ACTIVE);
    }

    private function getActiveRegistrationFee()
    {
        return Registration::where('status', SessionStatus::ACTIVE)->first();
    }
}
