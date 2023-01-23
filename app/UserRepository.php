<?php

namespace App;

use App\Models\User;

class UserRepository
{

    public function index()
    {
        return User::latest()->paginate(15);
    }

    public function store($data)
    {
        return User::create($data);
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function update($data, $id)
    {
        $user = $this->find($id);
        return $user->update($data);
    }

    public function destroy($id): int
    {
        return User::destroy($id);
    }

}
