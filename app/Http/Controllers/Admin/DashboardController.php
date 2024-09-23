<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollaborationMessage;
use App\Repositories\CollaborationMessageRepository;
use App\Repositories\ContactMessageRepository;
use App\Repositories\DashboardRepository;
use App\Repositories\JobOpeningRepository;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $_config;
    protected $DashboardRepository;

    public function __construct(DashboardRepository $DashboardRepository)
    {
        $this->_config = request('_config');
        $this->middleware('auth');
        $this->DashboardRepository = $DashboardRepository;
    }

    public function index()
    {
        $statisticsCount = $this->DashboardRepository->getStatisticsCount();
        return view($this->_config['view'], compact('statisticsCount'));
    }
}
