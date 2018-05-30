<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ReportRepositoryInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateSeminarMail;
use App\Models\Seminar;
use App\Models\User;
use Auth;
use PDF;

class HomeController extends Controller
{
    protected $reportRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ReportRepositoryInterface $reportRepository)
    {
        $this->middleware('auth');
        $this->reportRepository = $reportRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);
        
        return redirect()->back();
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
        $html = mb_convert_encoding($this->reportRepository->getReportByReportId($id)->report, 'HTML-ENTITIES', 'UTF-8');
        $pdf = PDF::loadHTML($html);
        header('Content-Type: application/pdf; charset=utf-8');
        
        return $pdf->stream();
    }
}
