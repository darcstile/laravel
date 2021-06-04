<?php

namespace App\Http\Controllers\Library;

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
        $shelves = Shelf::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('create',compact('item', 'shelves','categories','tags'));
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
       $tag_data = $request->input('tag_id');
       $tag = Tag::where('name', $tag_data)->first();
       if (!$tag) {
           $tag_data = [
               'name' => $tag_data,
               ];
           $tag_save = new Tag($tag_data);
           $tag_save->save();
           $item->tags()->attach($tag_save);
       } else {
           $item->tags()->attach($tag['id']);
       }
       $category =  $request->input('category_id');
       if ($category != null) {
           $item->categories()->attach($category);
       }
       if($request->hasFile('image')) {
           $file_path = $request->file('image')->store('public') ;
           $picture = $item->picture()->create([
               'name' => $file_path,
               ]);
           $picture->books()->save($item);
       }
       if ($item) {
           return redirect()
               ->route('books.edit', [$item->id], 301)
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
        return view('edit',compact('item', 'shelves','categories','tags'));
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
        $data = $request->only('name','author','shelf_id');
        $result = $item->update($data);
        $category =  $request->only('category_id');
        $item->categories()->detach();
        $item->categories()->attach($category);
        $tag_data = $request->input('tag_id');
        $tag = Tag::where('name', $tag_data)->first();
        if (!$tag) {
            $tag_data = [
                'name' => $tag_data,
            ];
            $tag_save = new Tag($tag_data);
            $tag_save->save();
            $item->tags()->detach();
            $item->tags()->attach($tag_save);
        } else {
            $item->tags()->detach();
            $item->tags()->attach($tag['id']);
        }
        if($request->hasFile('image')) {
            if ($item->picture != null) {
            $url = $item->picture()->sole('name')->name;
            Storage::delete($url);
            }
            $file_path = $request->file('image')->store('public') ;
            $picture = $item->picture()->create([
                'name' => $file_path,
            ]);
            $picture->books()->save($item);
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
        if ($item->picture != null) {
        $url = $item->picture()->sole('name')->name;
        Storage::delete($url);
        }
        $result = $item->delete();
        if ($result){
            return redirect()
                ->route('books.index')
                ->with(['success'=> "Запись id[$id] удалена!"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
