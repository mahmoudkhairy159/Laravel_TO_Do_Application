<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
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
            $data['image'] = $this->uploadImageAndResizeS3(request()->file('image'), 'users');
        }
        $data["password"] = Hash::make($data['password']);
        $user=$this->model->create($data);
        $user->addRole('user');
        return $user;
    }

    public function update(array $data, int $id)
    {
        $user = $this->model->find($id);
        if (request()->hasFile('image')) {
            if ($user->image) {
                $this->deleteFile($user->image);
            }
            $data['image'] = $this->uploadImageAndResizeS3(request()->file('image'), 'users');
        }
        if ($data['password']) {
            $data["password"] = Hash::make($data['password']);
        } else {
            unset($data["password"]);
        }
        if(!$user->hasRole('user')) {
            $user->addRole('user');
        }
        return $user->update($data);
    }

    public function delete(int $id)
    {
        $user = $this->model->find($id);
        if ($user->image) {
            $this->deleteFile($user->image);
        }
        $data['blocked']=1;
        return $user->update($data);
    }
}
