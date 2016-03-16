<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class HeritageTest extends TestCase
{
    use DatabaseTransactions;

    function __construct()
    {
        $this->baseApiURL = API_PREFIX_ADMIN . '/heritages/';
    }

    /**
     * Danh sách sản phẩm
     * @test
     * @return $this
     */
    public function testGetAll()
    {
        /*return $this->get($this->baseApiURL, $this->getHeaderAuthorization())
            ->seeStatusCode(200)
            ->seeJson(['status_code' => 200]);*/
    }

    /**
     * Thêm mới sản phẩm
     * @test
     */
    public function testCreate()
    {
        $heritage = factory('App\IZee\Heritages\Heritage')->make()->toArray();
        $this->call('post', $this->baseApiURL, $heritage, $this->getHeaderAuthorization());
    }

    /**
     * Lấy sản phẩm để cập nhật
     * @test
     */
    public function testEdit()
    {
        $product = factory('App\IZee\Products\Product')->create();
        $this->get($this->baseApiURL . $product->id . '/edit', $this->getHeaderAuthorization())
            ->seeStatusCode(200)
            ->seeJson();
    }

    /**
     * Cập nhật sản phẩm
     * @test
     */
    public function testUpdate()
    {
        $product = factory('App\IZee\Products\Product')->create();
        $this->put($this->baseApiURL . $product->id, $product->toArray(), $this->getHeaderAuthorization())
            ->seeStatusCode(200);
    }

    /**
     * Xóa sản phẩm
     * @test
     */
    public function testDestroy()
    {
        $product = factory('App\IZee\Products\Product')->create();
        $this->delete($this->baseApiURL . $product->id . '/delete', $this->getHeaderAuthorization())
            ->seeStatusCode(200);
    }
}