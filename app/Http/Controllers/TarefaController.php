<?php

namespace App\Http\Controllers;

use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TarefaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarefas = Tarefa::where('user_id', Auth::user()->id)->paginate(5);

        return view('tarefa.index', [
            'tarefas' => $tarefas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all(
            'descricao',
            'data_limite'
        );
        $dados['user_id'] = Auth::user()->id;

        $tarefa = Tarefa::create($dados);

        $destinatario = Auth::user()->email;

        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));

        return redirect()->route('tarefa.show', [
            'tarefa' => $tarefa->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        self::travarSeNaoPertencerAoUsuario($tarefa->user_id);

        return view('tarefa.show', [
            'tarefa' => $tarefa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        self::travarSeNaoPertencerAoUsuario($tarefa->user_id);

        return view('tarefa.edit', [
            'tarefa' => $tarefa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {

        $tarefa->update($request->all());

        return redirect()->route('tarefa.show', [
            'tarefa' => $tarefa
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        self::travarSeNaoPertencerAoUsuario($tarefa->user_id);

        $tarefa->delete();

        return redirect()->route('tarefa.index');
    }

    /**
     * Trava visualização e edição de tarefas que pertencem a outro usuário.
     * (Possível transformar em middleware)
     *
     * @param int $userId
     *
     * @return void
     */
    private static function travarSeNaoPertencerAoUsuario(int $userId)
    {
        if ($userId != Auth::user()->id) {
            abort(404);
        }
    }
}
