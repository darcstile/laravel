<?php

namespace App\Http\Controllers\library;

use App\Models\Reader;
use App\Http\Requests\ReaderControllerUpdateRequest;


class ReaderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readers = Reader::all();
        return view('reader/home',compact('readers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $readers = Reader::all();
        return view('reader/create',compact('readers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReaderControllerUpdateRequest $request)
    {
        $data = $request->all();
        $date = date('Y-m-d ', time());
        $data += [
            'date_reg' => $date,
        ];
        $item = new Reader($data);
        $item->save();
        if ($item) {
            return redirect()
                ->route('readers.edit', [$item->id], 301)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item= Reader::findOrFail($id);
        return view('reader/edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReaderControllerUpdateRequest $request, $id)
    {
        $item = Reader::find($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"]);
        }
        $data = $request->only('FIO','date_birth','date_reg');
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('readers.edit', $item->id, 301)
                ->with(['success' => 'Успешно сохранено']);

        } else {
            return back()
                ->withErrors(['msg'=> 'Ошибка сохранения']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Reader::find($id);
        $result = $item->delete();
        if ($result){
            return redirect()
                ->route('readers.index')
                ->with(['success'=> "Запись id[$id] удалена!"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }

}
