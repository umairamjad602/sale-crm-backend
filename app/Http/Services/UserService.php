<?php

namespace App\Http\Services;

use Exception;
use DateTime;
use App\Models\User;

class UserService
{
    private $model_;

    public function __construct(
        User $model,
    ) {
        $this->model_ = $model;
    }

    public function setEmailVerificationToken($token, $user)
    {
        $user->email_verification_token_created_at = new DateTime();
        $user->email_verification_token = $token;
        $user->save();
    }


    public function userHasSpecialConditions(int $userId)
    {
        return false;
    }



    public function getUserIdsByCompanyId(int $companyId)
    {
        return $this->model_->select(['id'])->where('company_id', $companyId)->get();
    }


    public function getUsersByRole(int $roleId)
    {
        return $this->model_->where('role_id', $roleId)->get();
    }

    public function getSiblingsByUserId(int $userId)
    {
        $user = $this->model_->where('id', $userId)->first();
        if (!$user) {
            return [];
        }
        return $this->getUsersByRole($user->role_id);
    }



    public function getUserDefaultOutletId(User $user)
    {
        if ($user->default_outlet !== null)
            return $user->default_outlet;
        $firstOutlet = $user->company->outlets->first();
        return ($firstOutlet) ? $firstOutlet->id : null;
    }


}
