<?php

namespace App\Http\Controllers\Controle;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brediweb\ImagemUpload\ImagemUpload;
use Illuminate\Support\Facades\Log;
use Throwable;

class AboutController extends Controller
{
    
    public function __construct()
    {
        $this->sobre = [
            'input_file' => 'sobre',
            'destino'    => 'sobres/',
            'resolucao'  => [
                'p' => ['h' => 200, 'w' => 48],
                'g' => ['h' => 460, 'w' => 1917]
            ],
        ];
    }
    public function index()
    {
        $data = ['sobres'];

        $sobres = About::all();
        // dd($sobres);
        return view('controle.home.sobre.index', compact($data));
    }

    public function form($id = null)
    {

        $data = ['sobre', 'id'];

        // $sobre = sobre::all();

        $sobre = About::where('id', $id)->first();

        return view('controle.home.sobre.form', compact($data));
    }

    public function create(Request $request)
    {
        $input = $request->except('_token');


        if (isset($input['sobre'])) {
            $sobre = ImagemUpload::salva($this->sobre);
            $input['sobre'] = $sobre;
        } else {
            $input['sobre'] = null;
        }

        try {
            About::create($input);
            return redirect()
                ->route('controle.home.sobre.index')
                ->with('error', false)
                ->with('msg', 'sobre salvo com sucesso');
        } catch (Throwable $th) {
            // return back()->withErrors('Não foi possível cadastrar o item');
            Log::info($th);
            return redirect()
                ->route('controle.home.sobre.index')
                ->withErrors('Não foi possível cadastrar o sobre.');
        }
    }

    public function update($id = null, Request $request)
    {

        $input = $request->except('_token');

        if (isset($input['sobre'])) {
            $sobre = ImagemUpload::salva($this->sobre);
            $input['sobre'] = $sobre;
        } else {
            $input['sobre'] = null;
        }

        try {
            About::where('id', $id)->update($input);

            return redirect()
                ->route('controle.home.sobre.index')
                ->with('error', false)
                ->with('msg', 'sobre atualizado com sucesso!');
        } catch (Throwable $th) {
            Log::info($th);
            return redirect()
                ->route('controle.home.sobre.index')
                ->withErrors('Não foi possível cadastrar o sobre');
        }
    }


    public function delete($id = null)
    {
        try {
            About::where('id', $id)->delete();

            return redirect()
                ->route('controle.home.sobre.index')
                ->with('error', false)
                ->with('msg', 'sobre excluído com sucesso!');
        } catch (Throwable $th) {
            Log::info($th);
            return redirect()
                ->route('controle.home.sobre.index')
                ->withErrors('Não foi possível excluir o item');
        }
    }
}
