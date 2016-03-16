<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = array(
            array('id' => '1','name' => 'Hà Nội','type' => 'PROVINCE'),
            array('id' => '2','name' => 'Hà Giang','type' => 'PROVINCE'),
            array('id' => '3','name' => 'Cao Bằng','type' => 'PROVINCE'),
            array('id' => '4','name' => 'Bắc Kạn','type' => 'PROVINCE'),
            array('id' => '5','name' => 'Tuyên Quang','type' => 'PROVINCE'),
            array('id' => '6','name' => 'Lào Cai','type' => 'PROVINCE'),
            array('id' => '7','name' => 'Điện Biên','type' => 'PROVINCE'),
            array('id' => '8','name' => 'Lai Châu','type' => 'PROVINCE'),
            array('id' => '9','name' => 'Sơn La','type' => 'PROVINCE'),
            array('id' => '10','name' => 'Yên Bái','type' => 'PROVINCE'),
            array('id' => '11','name' => 'Hòa Bình','type' => 'PROVINCE'),
            array('id' => '12','name' => 'Thái Nguyên','type' => 'PROVINCE'),
            array('id' => '13','name' => 'Lạng Sơn','type' => 'PROVINCE'),
            array('id' => '14','name' => 'Quảng Ninh','type' => 'PROVINCE'),
            array('id' => '15','name' => 'Bắc Giang','type' => 'PROVINCE'),
            array('id' => '16','name' => 'Phú Thọ','type' => 'PROVINCE'),
            array('id' => '17','name' => 'Vĩnh Phúc','type' => 'PROVINCE'),
            array('id' => '18','name' => 'Bắc Ninh','type' => 'PROVINCE'),
            array('id' => '19','name' => 'Hải Dương','type' => 'PROVINCE'),
            array('id' => '20','name' => 'Hải Phòng','type' => 'PROVINCE'),
            array('id' => '21','name' => 'Hưng Yên','type' => 'PROVINCE'),
            array('id' => '22','name' => 'Thái Bình','type' => 'PROVINCE'),
            array('id' => '23','name' => 'Hà Nam','type' => 'PROVINCE'),
            array('id' => '24','name' => 'Nam Định','type' => 'PROVINCE'),
            array('id' => '25','name' => 'Ninh Bình','type' => 'PROVINCE'),
            array('id' => '26','name' => 'Thanh Hóa','type' => 'PROVINCE'),
            array('id' => '27','name' => 'Nghệ An','type' => 'PROVINCE'),
            array('id' => '28','name' => 'Hà Tĩnh','type' => 'PROVINCE'),
            array('id' => '29','name' => 'Quảng Bình','type' => 'PROVINCE'),
            array('id' => '30','name' => 'Quảng Trị','type' => 'PROVINCE'),
            array('id' => '31','name' => 'Thừa Thiên Huế','type' => 'PROVINCE'),
            array('id' => '32','name' => 'Đà Nẵng','type' => 'PROVINCE'),
            array('id' => '33','name' => 'Quảng Nam','type' => 'PROVINCE'),
            array('id' => '34','name' => 'Quảng Ngãi','type' => 'PROVINCE'),
            array('id' => '35','name' => 'Bình Định','type' => 'PROVINCE'),
            array('id' => '36','name' => 'Phú Yên','type' => 'PROVINCE'),
            array('id' => '37','name' => 'Khánh Hòa','type' => 'PROVINCE'),
            array('id' => '38','name' => 'Ninh Thuận','type' => 'PROVINCE'),
            array('id' => '39','name' => 'Bình Thuận','type' => 'PROVINCE'),
            array('id' => '40','name' => 'Kon Tum','type' => 'PROVINCE'),
            array('id' => '41','name' => 'Gia Lai','type' => 'PROVINCE'),
            array('id' => '42','name' => 'Đắk Lắk','type' => 'PROVINCE'),
            array('id' => '43','name' => 'Đắk Nông','type' => 'PROVINCE'),
            array('id' => '44','name' => 'Lâm Đồng','type' => 'PROVINCE'),
            array('id' => '45','name' => 'Bình Phước','type' => 'PROVINCE'),
            array('id' => '46','name' => 'Tây Ninh','type' => 'PROVINCE'),
            array('id' => '47','name' => 'Bình Dương','type' => 'PROVINCE'),
            array('id' => '48','name' => 'Đồng Nai','type' => 'PROVINCE'),
            array('id' => '49','name' => 'Bà Rịa - Vũng Tàu','type' => 'PROVINCE'),
            array('id' => '50','name' => 'Hồ Chí Minh','type' => 'PROVINCE'),
            array('id' => '51','name' => 'Long An','type' => 'PROVINCE'),
            array('id' => '52','name' => 'Tiền Giang','type' => 'PROVINCE'),
            array('id' => '53','name' => 'Bến Tre','type' => 'PROVINCE'),
            array('id' => '54','name' => 'Trà Vinh','type' => 'PROVINCE'),
            array('id' => '55','name' => 'Vĩnh Long','type' => 'PROVINCE'),
            array('id' => '56','name' => 'Đồng Tháp','type' => 'PROVINCE'),
            array('id' => '57','name' => 'An Giang','type' => 'PROVINCE'),
            array('id' => '58','name' => 'Kiên Giang','type' => 'PROVINCE'),
            array('id' => '59','name' => 'Cần Thơ','type' => 'PROVINCE'),
            array('id' => '60','name' => 'Hậu Giang','type' => 'PROVINCE'),
            array('id' => '61','name' => 'Sóc Trăng','type' => 'PROVINCE'),
            array('id' => '62','name' => 'Bạc Liêu','type' => 'PROVINCE'),
            array('id' => '63','name' => 'Cà Mau','type' => 'PROVINCE'),
            array('id' => '64','name' => 'Trung du và miền núi phía Bắc','type' => 'AREA'),
            array('id' => '65','name' => 'Đồng bằng sông Hồng và duyên hải Đông Bắc','type' => 'AREA'),
            array('id' => '66','name' => 'Bắc Trung Bộ','type' => 'AREA'),
            array('id' => '67','name' => 'Duyên hải Nam Trung Bộ','type' => 'AREA'),
            array('id' => '68','name' => 'Tây Nguyên','type' => 'AREA'),
            array('id' => '69','name' => 'Đông Nam Bộ','type' => 'AREA'),
            array('id' => '70','name' => 'Tây Nam Bộ','type' => 'AREA')
        );
        foreach($address as $item)
        {
            if(DB::table('locations')->where('id', $item['id'])->count() == 0) {
                DB::table('locations')->insert($item);
            }
        }
    }
}
