<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRepository extends Repository
{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function paginated($limit = 10, $oderBy = "created_at", $sort = "desc")
    {
        return $this->model->where('blocked',0)->where('id','!=',auth()->id())
            ->where(function ($query) {
                $query->when(request()->search, function ($q, $searchKey) {

                    $q->where(function ($query) use ($searchKey) {
                        return $query->where('name', 'like', '%' . $searchKey . '%')
                            ->orWhere('email', 'like', '%' . $searchKey . '%')
                            ->orWhere('phone', 'like', '%' . $searchKey . '%');
                    });
                });
            })
            ->orderBy('created_at', $sort)
            ->paginate($limit);
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        if (request()->hasFile('image')) {
            $data['image'] = $this->uploadImageAndResizeS3(request()->file('image'), 'admins');
        }
        $data["password"] = Hash::make($data['password']);
        $admin=$this->model->create($data);
        $admin->addRole('admin');
        return $admin;
    }

    public function update(array $data, int $id)
    {
        $admin = $this->model->find($id);
        if (request()->hasFile('image')) {
            if ($admin->image) {
                $this->deleteFile($admin->image);
            }
            $data['image'] = $this->uploadImageAndResizeS3(request()->file('image'), 'admins');
        }
        if ($data['password']) {
            $data["password"] = Hash::make($data['password']);
        } else {
            unset($data["password"]);
        }
        if(!$admin->hasRole('admin')) {
            $admin->addRole('admin');
        }
        return $admin->update($data);
    }

    public function delete(int $id)
    {
        $admin = $this->model->find($id);
        if ($admin->image) {
            $this->deleteFile($admin->image);
        }
        $data['blocked']=1;
        return $admin->update($data);
    }
}
