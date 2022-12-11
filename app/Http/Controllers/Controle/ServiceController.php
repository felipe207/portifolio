<?php

namespace App\Http\Controllers\Controle;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brediweb\ImagemUpload\ImagemUpload;
use Illuminate\Support\Facades\Log;
use Throwable;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->servico = [
            'input_file' => 'servico',
            'destino'    => 'servicos/',
            'resolucao'  => [
                'p' => ['h' => 200, 'w' => 48],
                'g' => ['h' => 460, 'w' => 1917]
            ],
        ];
    }
    public function index()
    {
        $data = ['servicos'];

        $servicos = Service::all();
        // dd($servicos);
        return view('controle.servico.index', compact($data));
    }

    public function form($id = null)
    {

        $data = ['servico', 'id'];

        // $servico = servico::all();

        $servico = Service::where('id', $id)->first();

        return view('controle.home.servico.form', compact($data));
    }

    public function create(Request $request)
    {
        $input = $request->except('_token');


        if (isset($input['servico'])) {
            $servico = ImagemUpload::salva($this->servico);
            $input['servico'] = $servico;
        } else {
            $input['servico'] = null;
        }

        try {
            Service::create($input);
            return redirect()
                ->route('controle.home.servico.index')
                ->with('error', false)
                ->with('msg', 'servico salvo com sucesso');
        } catch (Throwable $th) {
            // return back()->withErrors('Não foi possível cadastrar o item');
            Log::info($th);
            return redirect()
                ->route('controle.home.servico.index')
                ->withErrors('Não foi possível cadastrar o servico.');
        }
    }

    public function update($id = null, Request $request)
    {

        $input = $request->except('_token');

        if (isset($input['servico'])) {
            $servico = ImagemUpload::salva($this->servico);
            $input['servico'] = $servico;
        } else {
            $input['servico'] = null;
        }

        try {
            Service::where('id', $id)->update($input);

            return redirect()
                ->route('controle.home.servico.index')
                ->with('error', false)
                ->with('msg', 'servico atualizado com sucesso!');
        } catch (Throwable $th) {
            Log::info($th);
            return redirect()
                ->route('controle.home.servico.index')
                ->withErrors('Não foi possível cadastrar o servico');
        }
    }


    public function delete($id = null)
    {
        try {
            Service::where('id', $id)->delete();

            return redirect()
                ->route('controle.home.servico.index')
                ->with('error', false)
                ->with('msg', 'servico excluído com sucesso!');
        } catch (Throwable $th) {
            Log::info($th);
            return redirect()
                ->route('controle.home.servico.index')
                ->withErrors('Não foi possível excluir o item');
        }
    }
}
