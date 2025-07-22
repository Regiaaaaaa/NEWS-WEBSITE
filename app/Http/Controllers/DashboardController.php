<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class DashboardController extends Controller
{
    public function index()
{
    $beritas = Berita::latest()->take(5)->get(); 
    return view('dashboard', compact('beritas')); // atau 'dashboard.index' jika kamu pakai folder
}

}
