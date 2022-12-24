<?php

namespace App\Http\Controllers\Controle;

use App\Models\Portifolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brediweb\ImagemUpload\ImagemUpload;
use Illuminate\Support\Facades\Log;
use Throwable;

class PortifolioController extends Controller
{
    public function __construct()
    {
        $this->portifolio = [
            'input_file' => 'portifolio',
            'destino'    => 'portifolios/',
            'resolucao'  => [
                'p' => ['h' => 200, 'w' => 48],
                'g' => ['h' => 460, 'w' => 1917]
            ],
        ];
    }
    public function index()
    {
        $data = ['portifolios'];

        $portifolios = Portifolio::all();

        return view('controle.portifolio.index', compact($data));
    }

    public function form($id = null)
    {

        $data = ['portifolio', 'id'];

        $portifolio = Portifolio::where('id', $id)->first();

        return view('controle.portifolio.form', compact($data));
    }

    public function create(Request $request)
    {
        $input = $request->except('_token');


        if (isset($input['portifolio'])) {
            $portifolio = ImagemUpload::salva($this->portifolio);
            $input['portifolio'] = $portifolio;
        } else {
            $input['portifolio'] = null;
        }

        try {
            Portifolio::create($input);
            return redirect()
                ->route('controle.portifolio.index')
                ->with('error', false)
                ->with('msg', 'portifolio salvo com sucesso');
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()
                ->route('controle.portifolio.index')
                ->withErrors('Não foi possível cadastrar o portifolio.');
        }
    }

    public function update($id = null, Request $request)
    {

        $input = $request->except('_token');

        if (isset($input['portifolio'])) {
            $portifolio = ImagemUpload::salva($this->portifolio);
            $input['portifolio'] = $portifolio;
        } else {
            $input['portifolio'] = null;
        }

        try {
            Portifolio::where('id', $id)->update($input);

            return redirect()
                ->route('controle.portifolio.index')
                ->with('error', false)
                ->with('msg', 'portifolio atualizado com sucesso!');
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()
                ->route('controle.portifolio.index')
                ->withErrors('Não foi possível cadastrar o portifolio');
        }
    }


    public function delete($id = null)
    {
        try {
            Portifolio::where('id', $id)->delete();

            return redirect()
                ->route('controle.portifolio.index')
                ->with('error', false)
                ->with('msg', 'portifolio excluído com sucesso!');
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()
                ->route('controle.portifolio.index')
                ->withErrors('Não foi possível excluir o item');
        }
    }
}
