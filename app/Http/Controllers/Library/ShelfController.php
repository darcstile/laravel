<?php

namespace App\Http\Controllers\library;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookTag;
use App\Models\Category;
use App\Models\Shelf;
use App\Models\Reader;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ShelfControllerUpdateRequest;

class ShelfController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shelves = Shelf::all();
        return view('shelf/home',compact('shelves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shelves = Shelf::all();
        return view('shelf/create',compact( 'shelves'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShelfControllerUpdateRequest $request)
    {
        $data = $request->all();
        $item = new Shelf($data);
        $item->save();
        if ($item) {
            return redirect()
                ->route('shelves.edit', [$item->id], 301)
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
        $item = Shelf::findOrFail($id);

        return view('shelf/edit',compact( 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShelfControllerUpdateRequest $request, $id)
    {
        $item = Shelf::find($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"]);
        }
        $data = $request->only('name');
        $result = $item->update($data);
        if ($result) {
            return redirect()
                ->route('shelves.edit', $item->id, 301)
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
        $item = Shelf::find($id);
        $result = $item->delete();
        if ($result){
            return redirect()
                ->route('shelves.index')
                ->with(['success'=> "Запись id[$id] удалена!"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
