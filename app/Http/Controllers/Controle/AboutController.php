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
       
        return view('controle.sobre.index', compact($data));
    }

    public function form($id = null)
    {

        $data = ['sobre', 'id'];

        $sobre = About::where('id', $id)->first();

        return view('controle.sobre.form', compact($data));
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
                ->route('controle.sobre.index')
                ->with('error', false)
                ->with('msg', 'sobre salvo com sucesso');
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()
                ->route('controle.sobre.index')
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
                ->route('controle.sobre.index')
                ->with('error', false)
                ->with('msg', 'sobre atualizado com sucesso!');
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()
                ->route('controle.sobre.index')
                ->withErrors('Não foi possível cadastrar o sobre');
        }
    }


    public function delete($id = null)
    {
        try {
            About::where('id', $id)->delete();

            return redirect()
                ->route('controle.sobre.index')
                ->with('error', false)
                ->with('msg', 'sobre excluído com sucesso!');
        } catch (Throwable $th) {
            Log::error($th);
            return redirect()
                ->route('controle.sobre.index')
                ->withErrors('Não foi possível excluir o item');
        }
    }
}
