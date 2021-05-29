<?php

namespace App\Http\Controllers\library;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\JournalControllerUpdateRequest;
use App\Models\Journal;
use App\Models\Book;
use App\Models\Reader;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $journals = Journal::all();
        return view('Journal/home',compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $journals = Journal::all();
        $readers = Reader::all();
        $books = Book::all();
        return view('Journal/create',compact('journals', 'books','readers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JournalControllerUpdateRequest $request)
    {
        $data = $request->all();
        $data['status'] = "У читателя";
        $journal = new Journal($data);
        $journal->save();
        if ($journal) {
            return redirect()
                ->route('journals.index')
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $journal = Journal::find($id);
        if (empty($journal)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"]);
        }
        $data = $request->only('status');
        $data['status'] = "В наличии    ";
        $result = $journal->update($data);
        if ($result) {
            return redirect()
                ->route('journals.index')
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
        $journal = Journal::find($id);
        $result = $journal->delete();
        if ($result){
            return redirect()
                ->route('journals.index')
                ->with(['success'=> "Запись id[$id] удалена!"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
