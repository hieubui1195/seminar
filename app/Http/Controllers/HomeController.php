<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ReportRepositoryInterface;
use App\Repositories\Contracts\SeminarRepositoryInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateSeminarMail;
use App\Models\Seminar;
use App\Models\User;
use Auth;
use PDF;

class HomeController extends Controller
{
    protected $reportRepository, $seminarRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ReportRepositoryInterface $reportRepository,
        SeminarRepositoryInterface $seminarRepository)
    {
        $this->reportRepository = $reportRepository;
        $this->seminarRepository = $seminarRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newSeminars = $this->seminarRepository->newSeminar();
        $latestSeminar = $this->seminarRepository->latestSeminar();
        $newReports = $this->reportRepository->newReport();

        return view('home', compact('newSeminars', 'latestSeminar', 'newReports'));
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);
        
        return redirect()->back();
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function search()
    {
        return view('search');
    }

    public function report()
    {
        $reports = $this->reportRepository->getAllReports();

        return view('report', compact('reports'));
    }

    public function previewReport($id)
    {
        $pdf = PDF::loadHTML($this->reportRepository->getReportByReportId($id)->report);
        header('Content-Type: application/pdf; charset=utf-8');
        
        return $pdf->stream();
    }
}
