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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Http\Response;


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
        $itemList = Book::all();
        $bookCategory = new BookCategory();
        $bookTag = new BookTag();
        $shelves = Shelf::all();
        $categories = Category::all();
        $tags = Tag::all();
        $readers = Reader::all();
        return view('create',compact('item', 'itemList','bookCategory','bookTag','shelves','categories','tags','readers'));
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
       $book = $item['id'];
       $item_category = new BookCategory;
       $item_category->category_id = $category;
       $item_category->book_id = $book;
       $item_category->save();
       $tag = $request->input('tag_id');
       if ($tag != null){
       $item_tag = new BookTag;
       $item_tag->tag_id = $tag;
       $item_tag->book_id = $book;
       $item_tag->save();
       }

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $file_path = $request->file('image')->store('public') ;
            $array = [
                'picture' => $file_path
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
        $itemList = Book::all();
        $shelves = Shelf::all();
        $categories = Category::all();
        $tags = Tag::all();
        $readers = Reader::all();
        return view('edit',compact('item', 'itemList','shelves','categories','tags','readers'));
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
        $BC = DB::table('book_category')->where('book_id', $id)->value('id');
        $BT = DB::table('book_tag')->where('book_id', $id)->value('id');
        $BookCategory = BookCategory::find($BC);
        $BookTag = BookTag::find($BT);
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"]);
        }
        $data = $request->only('name','author','date_take','shelf_id','reader_id');
        $result = $item
            ->fill($data)
            ->save();
        $data_category = $request->only('category_id');
        $result_category = $BookCategory
            ->fill($data_category)
            ->save();
        $data_tag = $request->only('tag_id');
        $result_tag = $BookTag
            ->fill($data_tag)
            ->save();

        if($request->hasFile('image')) {
            $file = $request->file('image');
//            $file_path = $request->file('image')->store('public') ;
            $file_path = $request->file('image')->store('public');
            $array = [
                'picture' => $file_path
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
        $book_category = DB::table('book_category')->where('book_id', $id)->value('id');
        $book_tag = DB::table('book_tag')->where('book_id', $id)->value('id');
        $item = Book::find($id);
        if ($book_category != null){
        $BookCategory = BookCategory::find($book_category)->forceDelete();
        }
        if ($book_tag != null) {
            $BookTag = BookTag::find($book_tag)->forceDelete();
        }
        if ($item != null) {
            $result = Book::find($id)->forceDelete();
        }
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
