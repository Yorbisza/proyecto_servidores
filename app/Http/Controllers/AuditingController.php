<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditingController extends Controller
{
    public function index()
    {
        $audits = Audit::with('user')
            ->orderByDesc('id')
            ->get();
        return view('audits.index', compact('audits'));
    }

}
