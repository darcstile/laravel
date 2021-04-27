<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

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
    public function testEditSuccessful(){
        $response = $this->get('books/6/edit'); // объект, который существует в базе
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
        $response = $this->patch('books/6',[
            'id' => '6',                                                             /////////////////////////////////
            'author' => 'Филип Пулман',                                              //                            //
            'name' => 'Тёмные начала',                                               //                            //
            'picture' => 'public/gET7iNo7TgQPd8Mxlm0KpwCWjc5DHhN8MOvtS240.jpg',      //  Изменение существующей    //
            'reader_id' => '7',                                                      //      в базе записи         //
            'shelf_id' => '7',                                                       //                            //
            'category_id' => '1',                                                    //                            //
            'tag_id' => '1',                                                         ////////////////////////////////
        ]);
//        dd($response->status());
        $response->assertStatus(301);                  // Если запись успешно изменена PostController вернет статус 301
    }
    public function testUpdateFailed(){
        $response = $this->patch('books/0',[
            'id' => '6',                                                             /////////////////////////////////
            'author' => 'Филип Пулман',                                              //  Изменение не существующей //
            'name' => 'Тёмные начала',                                               //       в базе записи        //
            'picture' => 'public/gET7iNo7TgQPd8Mxlm0KpwCWjc5DHhN8MOvtS240.jpg',      //  (Или любое изменение не   //
            'reader_id' => '7',                                                      //    прошедшее валидацию)    //
            'shelf_id' => '7',                                                       //                            //
            'category_id' => '1',                                                     ////////////////////////////////
        ]);
//        dd($response->status());
        $response->assertStatus(302);     // Так как записи не существует, валидатор в PostController вернет статус 302
    }

}
