<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

class AuditController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-audit')->only(['index', 'show']);
    }

    public function index()
    {
        $audits = Audit::orderBy('created_at', 'desc')->paginate(5);
        $userEmail = Auth::user()->email; // Obtener el correo del usuario autenticado
        return view('audits.index', compact('audits', 'userEmail'));
    }

    public function destroy($id)
    {
        $audit = Audit::findOrFail($id);
        $audit->delete();

        return redirect()->route('audits.index')->with('success', 'Registro de auditoría eliminado correctamente.');
    }

    public function show($id)
    {
        $audit = Audit::findOrFail($id);
        $user = User::findOrFail($audit->user_id);

        $relatedData = null;
        if ($audit->action === 'creación' && $audit->table_name === 'clientes') {
            $relatedData = Cliente::findOrFail($audit->new_data['id']);
        }

        return view('audits.show', compact('audit', 'user', 'relatedData'));
    }
}
