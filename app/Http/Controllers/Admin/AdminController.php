<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use App\Http\Requests\Admin\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\Admin\UpdateAdminRequest;

class AdminController extends Controller
{

    protected $_config;
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->_config = request('_config');
        $this->adminRepository = $adminRepository;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->adminRepository->paginated();
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
    public function store(StoreAdminRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        $created =  $this->adminRepository->create($data);

        if (!$created) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        $request->session()->put('success', 'Admin Created SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Display the specified resource.
     */
    public function showProfile()
    {
        $id=auth()->id();
        $item = $this->adminRepository->find($id);
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
        $item = $this->adminRepository->find($id);
        if (!$item) {
            return abort(404);
        }
        return view($this->_config['view'], compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, string $id)
    {
        $item = $this->adminRepository->find($id);
        if (!$item) {
            return abort(404);
        }
        $data = $request->validated();

        $updated =  $this->adminRepository->update($data, $id);
        if (!$updated) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        $request->session()->put('success', 'Admin Updated SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = $this->adminRepository->find($id);
        if (!$item) {
            return abort(404);
        }
        $deleted =  $this->adminRepository->delete($id);
        if (!$deleted) {
            request()->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        request()->session()->put('success', 'Admin Deleted SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }
}
