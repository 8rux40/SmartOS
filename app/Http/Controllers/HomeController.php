<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $qtde_orcamentos_pendentes  = DB::table('ordens_de_servico')->select(DB::raw('count(*) as qtde'))->where('status',OrdemServico::ORCAMENTO_PENDENTE)->first()->qtde;
        $qtde_orcamentos_informados = DB::table('ordens_de_servico')->select(DB::raw('count(*) as qtde'))->where('status',OrdemServico::ORCAMENTO_INFORMADO)->first()->qtde;
        $qtde_os_abertas            = DB::table('ordens_de_servico')->select(DB::raw('count(*) as qtde'))->where('status',OrdemServico::ABERTA)->first()->qtde;
        $qtde_os_concluidas         = DB::table('ordens_de_servico')->select(DB::raw('count(*) as qtde'))->where('status',OrdemServico::CONCLUIDA)->first()->qtde;

        return view('home', compact(['qtde_orcamentos_pendentes', 'qtde_orcamentos_informados', 'qtde_os_abertas', 'qtde_os_concluidas']));
    }
}
