<?php

namespace App\Repositories;
use App\Models\User;

class DashboardRepository extends Repository
{

    protected $userModel;


    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;

    }

    public function getStatisticsCount()
    {
        return [
            'users_count' => $this->countUsers(),
        ];
    }

    protected function countUsers()
    {
        return $this->userModel->count();
    }


}
