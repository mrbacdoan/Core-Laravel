## Online Friday

- API cho app online friday
- Quản trị hệ thống doanh nghiệp, quay số

### Auto generate module
- Command run ** php artisan izee-generate {module} **

### Tạo document cho API
- Tham khảo: [http://apidocjs.com]http://apidocjs.com
- Setup: ** npm install apidoc -g **
- Generate:  ** apidoc -i app/Http/ **


### Dev Backend
- Lần đầu tiên:
	- Vào thư mục public/backend-dev/master chạy:
		- npm install
		- bower install
		- gulp --server
		- Chú ý: Máy phải cài nodejs, bower
- Các lần tiếp theo khi dev chạy:
	- gulp
	- Khi các file js,css, html thay đổi sẽ tự động build và refresh
- Code html/css,js đặt vào các thư mục tương ứng trong: public/backend-dev/master
	- Không cần phải include hoặc khai báo script (link). Gulp sẽ tự động gộp vào file app.js
* Không cần thao tác vào thư mục public/app (Dev tại backend-dev)

### Transformer API Response
- Dùng để format dữ liệu trước khi trả về cho người dùng.
- Để tạo class transformer sử dụng câu lệnh: php artisan make:transformer ClassNameTransformer
- Demo xem các file sau:
	- Class transformer: IZee\Transformers\ProductTransformer
	- Class xử lý: App\IZee\Products\Search@backendData
		- Code: return Fractal::collection($this->product->getAllWithPaginate($filters, $perPage), new ProductTransformer, 'data')->getArray();
	- Controller: App\Http\Controllers\API\Admin\ProductController@index
		- Code: return $this->respond($this->search->dataAdmin($request));
- Demo API: http://localhost/project/onlinefriday/public/api/v1/admin/products
```json
{
  "status_code": 200,
  "data": [
    {
      "title": "iPhone 6s God 64GB",
      "quantity": 10
    }
  ],
  "meta": {
    "pagination": {
      "total": 1,
      "count": 1,
      "per_page": 15,
      "current_page": 1,
      "total_pages": 1,
      "links": []
    }
  }
}
```
## Testing Laravel
- Để tạo test case mới chạy command: php artisan make:test ClassNameTest
- Demo Test API xem file: test/api/ProductTest.php
- Trong Test Case có sử dụng Factories xem demo file: app/database/factories/ModelFactory.php  (Tạo dữ liệu để không phải nhập mỗi khi Test)
- Để test xem các Test Case chạy đúng hay chưa dùng command: vendor/bin/phpunit
  - Báo OK (5 tests, 6 assertions) => Chạy ngon lành rồi
  - Báo FAILURES! Tests: 5, Assertions: 7, Failures: 1. => Xem lỗi phía trên tại dòng nào, lỗi gì rồi sửa lại cho đúng. Chạy lại command để kiểm tra
- Ghi chú: Sử dụng Testing mất thời gian lúc đầu để viết Test Case nhưng bù lại quá trình DEV và Test sẽ mất ít thời gian hơn. Mọi việc được làm tự động hơn nữa khi sửa Code Logic thì chỉ cần chạy command là biết đã Test đúng hay chưa không cần phải nhập liệu nhiều như khi test thủ công bằng Postman

## Todo
1. Testing Angular (TDD)
2. Generate module
  - Laravel: Tạo module, Migrate, FormRequest, Controller, Route, TestCase, ModelFactory
  - Angular: Tạo module, Form
v