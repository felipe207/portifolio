<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->banner = [
            'input_file' => 'banner',
            'destino'    => 'banners/',
            'resolucao'  => [
                'p' => ['h' => 200, 'w' => 48],
                'g' => ['h' => 460, 'w' => 1917]
            ],
        ];
    }
    public function index()
    {
        $data = ['banners'];

        $banners = Banner::all();
        // dd($banners);
        return view('controle.home.banner.index', compact($data));
    }

    public function form($id = null)
    {

        $data = ['banner', 'id'];

        // $banner = Banner::all();

        $banner = Banner::where('id', $id)->first();

        return view('controle.home.banner.form', compact($data));
    }

    public function create(Request $request)
    {
        $input = $request->except('_token');


        if (isset($input['banner'])) {
            $banner = ImagemUpload::salva($this->banner);
            $input['banner'] = $banner;
        } else {
            $input['banner'] = null;
        }

        try {
            Banner::create($input);
            return redirect()
                ->route('controle.home.banner.index')
                ->with('error', false)
                ->with('msg', 'Banner salvo com sucesso');
        } catch (Throwable $th) {
            // return back()->withErrors('Não foi possível cadastrar o item');
            Log::info($th);
            return redirect()
                ->route('controle.home.banner.index')
                ->withErrors('Não foi possível cadastrar o banner.');
        }
    }

    public function update($id = null, Request $request)
    {

        $input = $request->except('_token');

        if (isset($input['banner'])) {
            $banner = ImagemUpload::salva($this->banner);
            $input['banner'] = $banner;
        } else {
            $input['banner'] = null;
        }

        try {
            Banner::where('id', $id)->update($input);

            return redirect()
                ->route('controle.home.banner.index')
                ->with('error', false)
                ->with('msg', 'Banner atualizado com sucesso!');
        } catch (Throwable $th) {
            Log::info($th);
            return redirect()
                ->route('controle.home.banner.index')
                ->withErrors('Não foi possível cadastrar o Banner');
        }
    }


    public function delete($id = null)
    {
        try {
            Banner::where('id', $id)->delete();

            return redirect()
                ->route('controle.home.banner.index')
                ->with('error', false)
                ->with('msg', 'Banner excluído com sucesso!');
        } catch (Throwable $th) {
            Log::info($th);
            return redirect()
                ->route('controle.home.banner.index')
                ->withErrors('Não foi possível excluir o item');
        }
    }
}
