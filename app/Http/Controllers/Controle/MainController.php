<?php

namespace App\Http\Controllers\Controle;

use App\Models\Main;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brediweb\ImagemUpload\ImagemUpload;
use Illuminate\Support\Facades\Log;
use Throwable;

class MainController extends Controller
{
    public function __construct()
    {
        $this->main = [
            'input_file' => 'main',
            'destino'    => 'mains/',
            'resolucao'  => [
                'p' => ['h' => 200, 'w' => 48],
                'g' => ['h' => 460, 'w' => 1917]
            ],
        ];
    }
    public function index()
    {
        $data = ['mains'];

        $mains = Main::all();
        // dd($mains);
        return view('controle.main.index', compact($data));
    }

    public function form($id = null)
    {

        $data = ['main', 'id'];

        // $main = main::all();

        $main = Main::where('id', $id)->first();

        return view('controle.main.form', compact($data));
    }

    public function create(Request $request)
    {
        $input = $request->except('_token');


        if (isset($input['main'])) {
            $main = ImagemUpload::salva($this->main);
            $input['main'] = $main;
        } else {
            $input['main'] = null;
        }

        try {
            Main::create($input);
            return redirect()
                ->route('controle.main.index')
                ->with('error', false)
                ->with('msg', 'main salvo com sucesso');
        } catch (Throwable $th) {
            // return back()->withErrors('Não foi possível cadastrar o item');
            Log::info($th);
            return redirect()
                ->route('controle.main.index')
                ->withErrors('Não foi possível cadastrar o main.');
        }
    }

    public function update($id = null, Request $request)
    {

        $input = $request->except('_token');

        if (isset($input['main'])) {
            $main = ImagemUpload::salva($this->main);
            $input['main'] = $main;
        } else {
            $input['main'] = null;
        }

        try {
            Main::where('id', $id)->update($input);

            return redirect()
                ->route('controle.main.index')
                ->with('error', false)
                ->with('msg', 'main atualizado com sucesso!');
        } catch (Throwable $th) {
            Log::info($th);
            return redirect()
                ->route('controle.main.index')
                ->withErrors('Não foi possível cadastrar o main');
        }
    }


    public function delete($id = null)
    {
        try {
            Main::where('id', $id)->delete();

            return redirect()
                ->route('controle.main.index')
                ->with('error', false)
                ->with('msg', 'main excluído com sucesso!');
        } catch (Throwable $th) {
            Log::info($th);
            return redirect()
                ->route('controle.main.index')
                ->withErrors('Não foi possível excluir o item');
        }
    }
}
