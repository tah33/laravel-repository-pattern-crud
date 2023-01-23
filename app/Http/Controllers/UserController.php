<?php

namespace App\Http\Controllers;

use App\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data       = [
                'users' => $this->userRepository->index(),
            ];
            return view('users.index', $data);
        } catch (\Exception $e) {
            return back()->with(['error', $e->getMessage()]);
        }
    }
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $request->validate([
                'name'      => 'required',
                'email'     => 'required|unique:users,email',
                'password'  => 'required|confirmed',
            ]);
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            $this->userRepository->store($data);

            return back()->with(['success' => 'User Created Successfully']);
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }
    public function edit($id,Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = [
                'users' => $this->userRepository->index(),
                'edit'  => $this->userRepository->find($id),
            ];
            return view('users.index', $data);
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $request->validate([
                'name'      => 'required',
                'email'     => 'required|unique:users,email,'.$id
            ]);
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            $this->userRepository->update($data,$id);

            return redirect()->route('users.index')->with(['success' => 'User Updated Successfully']);
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->userRepository->destroy($id);
            return redirect()->route('users.index')->with(['success' => 'User Deleted Successfully']);
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }
}
