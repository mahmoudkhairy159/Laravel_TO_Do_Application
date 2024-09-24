<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Http\Requests\Website\User\StoreUserRequest;
use App\Http\Requests\Website\User\UpdateUserRequest;

class UserController extends Controller
{

    protected $_config;
    protected $UserRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->_config = request('_config');
        $this->UserRepository = $UserRepository;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->UserRepository->paginated();
        return view($this->_config['view'], compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->_config['view']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        $created =  $this->UserRepository->create($data);

        if (!$created) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        $request->session()->put('success', 'User Created SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Display the specified resource.
     */
    public function showProfile()
    {
        $id=auth()->id();
        $item = $this->UserRepository->find($id);
        if (!$item) {
            return abort(404);
        }
        return view($this->_config['view'], compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = $this->UserRepository->find($id);
        if (!$item) {
            return abort(404);
        }
        return view($this->_config['view'], compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $item = $this->UserRepository->find($id);
        if (!$item) {
            return abort(404);
        }
        $data = $request->validated();

        $updated =  $this->UserRepository->update($data, $id);
        if (!$updated) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        $request->session()->put('success', 'User Updated SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = $this->UserRepository->find($id);
        if (!$item) {
            return abort(404);
        }
        $deleted =  $this->UserRepository->delete($id);
        if (!$deleted) {
            request()->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        request()->session()->put('success', 'User Deleted SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }
}
