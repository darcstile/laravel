<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Book;

class BookTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('books');
        $response->assertOk();
    }
    public function testCreate(){
        $response = $this->get('books/create');
        $response->assertOk();
    }
    public function testStoreFailed(){
        $response = $this->post('books',[
            'author' => 'test',                                                      /////////////////////////////////
            'name' => 'test',                                                        //                            //
            'reader_id' => '0',                                                      //     Создание записи,       //
            'shelf_id' => '7',                                                       //    не прошедшее валидацию  //
            'category_id' => '',                                                     //                            //
            'tag_id' => '1',                                                         ////////////////////////////////
        ]);
//        dd($response->status());
        $response->assertStatus(302); // Так как категория не была указана, валидатор вернет статус 302
    }
    public function testStoreSuccessful(){
        $response = $this->post('books',[
            'author' => 'test',                                                      /////////////////////////////////
            'name' => 'test',                                                        //                            //
            'reader_id' => '0',                                                      //  Успешное создание записи  //
            'shelf_id' => '7',                                                       //                            //
            'category_id' => '1',                                                    //                            //
            'tag_id' => '1',                                                         ////////////////////////////////
        ]);
//        dd($response->status());
        $response->assertStatus(301); // Ошибок нет,  PostController вернет статус 301
    }
    public function testEditSuccessful(){
        $item= Book::all()->last()->id; // Находим последний созданный объект
        $response = $this->get('books/'.$item.'/edit'); // объект, который существует в базе
//        dd($response->getContent());
        $response->assertOk();
    }
    public function testEditFailed(){
        $response = $this->get('books/0/edit'); // объект, которого нет в базе
//        dd($response->getContent());
//        dd($response->status());
        $response->assertNotFound();
    }
    public function testUpdateSuccesfull(){
        $item= Book::all()->last()->id;
        $response = $this->patch('books/'.$item ,[                                   /////////////////////////////////
            'author' => 'test',                                                      //                            //
            'name' => 'test',                                                        //  Изменение существующей    //
            'reader_id' => '7',                                                      //      в базе записи         //
            'shelf_id' => '7',                                                       //                            //
            'category_id' => '1',                                                    //                            //
            'tag_id' => '1',                                                         ////////////////////////////////
        ]);
//        dd($response->status());
        $response->assertStatus(301);                  // Если запись успешно изменена PostController вернет статус 301
    }
    public function testUpdateFailed(){
        $response = $this->patch('books/0',[                                         /////////////////////////////////
            'author' => 'test',                                                      //  Изменение не существующей //
            'name' => 'test',                                                        //       в базе записи        //
            'reader_id' => '7',                                                      //   (Или любое изменение не  //
            'shelf_id' => '7',                                                       //     прошедшее валидацию)   //
            'category_id' => '1',                                                    ////////////////////////////////
        ]);
//        dd($response->status());
        $response->assertStatus(302);  // Так как записи не существует, валидатор PostControllerUpdateRequest вернет статус 302
    }

    public function testDestroyFailed(){
        $response = $this->delete('books/0');
//        dd($response->status());
        $response->assertStatus(500); // Ошибка сервера, так как такого объекта не существует
    }
    public function testDestroySuccessful(){
        $item= Book::all()->last()->id;
        $response = $this->delete('books/'.$item);
        $response->assertStatus(302); // PostController, после редиректа возвращает статус 302
    }
}
