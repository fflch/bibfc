<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    public function audit(){
        $this->authorize('reports');

        $audits = Audit::orderBy('created_at', 'desc')->paginate();
        return view('audit.audit', [
            'audits' => $audits
        ]);

    }
}
