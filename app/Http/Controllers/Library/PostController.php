<?php

namespace App\Http\Controllers\library;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookTag;
use App\Models\Category;
use App\Models\Shelf;
use App\Models\Reader;
use App\Models\Tag;
use App\Http\Requests\PostControllerUpdateRequest;
use Illuminate\Support\Facades\Storage;



class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('home',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $item = new Book();
        $bookCategory = new BookCategory();
        $bookTag = new BookTag();
        $shelves = Shelf::all();
        $categories = Category::all();
        $tags = Tag::all();
        $readers = Reader::all();
        return view('create',compact('item', 'bookCategory','bookTag','shelves','categories','tags','readers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostControllerUpdateRequest $request)
    {
       $data = $request->all();
       $item = new Book($data);
       $item->save();
       $category =  $request->input('category_id');
        if ($category != null) {
            $item->categories()->attach($category);
        }
       $tag = $request->input('tag_id');
       if ($tag != null) {
            $item->tags()->attach($tag);
       }

        if($request->hasFile('image')) {
            $filePath = $request->file('image')->store('public') ;
            $array = [
                'picture' => $filePath
            ];
            $result_path = $item
                ->fill($array)
                ->save();
        }

       if ($item){
           return redirect()->route('books.edit', [$item->id], 301)
               ->with(['success' => 'Успешно сохранено']);
       } else {
           return back()->withErrors(['msg' => 'Ошибка сохранения'])
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
        $item = Book::findOrFail($id);
        $shelves = Shelf::all();
        $categories = Category::all();
        $tags = Tag::all();
        $readers = Reader::all();
        return view('edit',compact('item', 'shelves','categories','tags','readers'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostControllerUpdateRequest $request, $id)
    {
        $item = Book::find($id);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"]);
        }
        $data = $request->only('name','author','date_take','shelf_id','reader_id');
        $result = $item->update($data);
        $category =  $request->only('category_id');
        $item->categories()->detach();
        $item->categories()->attach($category);
        $tag = $request->only('tag_id');
        $item->tags()->detach();
        $item->tags()->attach($tag);


        if($request->hasFile('image')) {
            $file = $request->file('image');
//            $file_path = $request->file('image')->store('public') ;
            $filePath = $request->file('image')->store('public');
            $array = [
                'picture' => $filePath
            ];
            $result_path = $item
                ->fill($array)
                ->save();
        }
        if ($result) {
            return redirect()
                ->route('books.edit', $item->id, 301)
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
        $item = Book::find($id);
        if ($item->categories() != null){
            $item->categories()->detach();
        }
        if ($item->tags() != null) {
            $item->tags()->detach();
        }
        $result = $item->delete();;

        $url = $item->picture;
        Storage::delete($url);
        if ($result){
            return redirect()
                ->route('books.index')
                ->with(['success'=> "Запись id[$id] удалена!"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
