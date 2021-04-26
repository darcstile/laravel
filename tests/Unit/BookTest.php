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
    public function testEdit(){
        $response = $this->get('books/6/edit');
//        dd($response->getContent());
        $response->assertOk();
    }
    public function testUpdate(){
        $this->post('books/6/edit',[
            'id' => '6',
            'author' => 'Филип Пулман',
            'name' => 'Тёмные начала',
            'picture' => 'public/gET7iNo7TgQPd8Mxlm0KpwCWjc5DHhN8MOvtS240.jpg',
            'reader_id' => '7',
            'shelf_id' => '7',
        ]);
//        $this->get('books/6/edit');
//        $response = $this->get('books/6/edit');
//        dd($response->status());
        return redirect()
            ->route('books.edit', 6 );
        $response = $this->action('GET', '\library\PostController@index');
        dd($response);
    }
}
