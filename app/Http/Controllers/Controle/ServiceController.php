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
            'input_file' => 'icon',
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

        return view('controle.servico.index', compact($data));
    }

    public function form($id = null)
    {

        $data = ['servico', 'id'];

        $servico = Service::where('id', $id)->first();

        return view('controle.servico.form', compact($data));
    }

    public function create(Request $request)
    {
        $input = $request->except('_token');


        if (isset($input['icon'])) {
            $servico = ImagemUpload::salva($this->servico);
            $input['icon'] = $servico;
        } else {
            $input['icon'] = null;
        }

        try {
            Service::create($input);
            return redirect()
                ->route('controle.servico.index')
                ->with('error', false)
                ->with('msg', 'servico salvo com sucesso');
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()
                ->route('controle.servico.index')
                ->withErrors('Não foi possível cadastrar o servico.');
        }
    }

    public function update($id = null, Request $request)
    {

        $input = $request->except('_token');
        $serv = Service::where('id',$id)->first();

        if (isset($input['icon'])) {
            $servico = ImagemUpload::salva($this->servico);
            $input['icon'] = $servico;
        } else {
            $input['icon'] = $serv->icon;
        }
        // dd($serv,$input);
        try {
            Service::where('id', $id)->update($input);

            return redirect()
                ->route('controle.servico.index')
                ->with('error', false)
                ->with('msg', 'servico atualizado com sucesso!');
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()
                ->route('controle.servico.index')
                ->withErrors('Não foi possível cadastrar o servico');
        }
    }


    public function delete($id = null)
    {
        try {
            Service::where('id', $id)->delete();

            return redirect()
                ->route('controle.servico.index')
                ->with('error', false)
                ->with('msg', 'servico excluído com sucesso!');
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()
                ->route('controle.servico.index')
                ->withErrors('Não foi possível excluir o item');
        }
    }
}
