<?php
function iz_debug($data)
{
    echo '<meta charset="utf-8"><pre>';
    var_dump($data);
    die;
}

function getLastQuery()
{
    $queries = DB::getQueryLog();
    $last_query = end($queries);
    echo '<meta charset="utf-8"><pre>' . print_r($last_query, 1);
    die;
}

function getQueryLogs()
{
    DB::enableQueryLog();
    echo '<meta charset="utf-8"><pre>' . print_r(DB::getQueryLog()) . '</pre>';
    die;
}

function db($data)
{
    echo '<meta charset="utf-8"><pre>' . print_r($data, 1);
    exit();
}

function adminActiveItemSidebar($slug = null, $class = 'active')
{
    if (!empty($slug) && is_array($slug)) {
        foreach ($slug as $value) {
            if (request()->is(ADMIN_PREFIX . '/' . $value)) {
                return $class;
            }
        }
    } else {
        if (request()->is(ADMIN_PREFIX . '/' . $slug) || (empty($slug) && request()->is(ADMIN_PREFIX))) {
            return $class;
        }
    }
    return '';
}

function formHasError($key)
{
    $errors = Session::get('errors');
    return (count($errors) && $errors->has($key)) ? ' has-error' : '';
}


function formAlertError($key, $class = 'parsley-required')
{
    $errors = Session::get('errors');
    return empty($errors) ? null : $errors->first($key, '<ul class="parsley-errors-list filled" id="parsley-id-' . rand(1000, 2000) . '"><li class="' . $class . '">:message</li></ul>');
}

function checkTabProfile()
{
    $errors = Session::get('errors');
    $tabChangPassword = Session::get('tabChangPassword');
    $failValidate = (count($errors) && ($errors->has('old_password') || $errors->has('new_password') || $errors->has('password_confirmation'))) ? true : false;
    return ($tabChangPassword || $failValidate) ? true :false;
}
/**
 * Display label status
 *
 * @param string $text
 * @param string $type
 *
 * @return string
 */
function getLabelStatus($text, $type = 'default')
{
    return '<span class="label label-' . $type . '">' . $text . '</span>';
}


function theExcerpt($text, $strLen = 255, $more = '...')
{
    $text = strip_tags($text);
    $sanitized = htmlentities($text, ENT_COMPAT, 'UTF-8');
    return str_limit($sanitized, $strLen, $more);
}

function displayDatetime($date, $format = 'd-m-Y H:i:s')
{
    return date($format, strtotime($date));
}

function displayDate($date, $format = 'd-m-Y')
{
    return date($format, strtotime($date));
}


function numberFormat($number, $decimals = 0, $dec_point = ',', $thousands_sep = '.')
{
    return number_format($number, $decimals, $dec_point, $thousands_sep);
}

if (!function_exists('getallheaders')) {
    function getallheaders()
    {
        if (empty($_SERVER) || !is_array($_SERVER)) {
            return array();
        }

        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

if (!function_exists('getAllHeadersTest')) {
    function getAllHeadersTest()
    {
        $requests = request()->header();
        $headers = array();
        if (!empty($requests)) {
            $headers = array_map(function ($item) {
                return isset($item[0]) ? $item[0] : '';
            }, $requests);
        }
        return $headers;
    }
}

function autoAddBaseURL($link = null)
{
    if (empty($link)) {
        return null;
    }
    if (!filter_var($link, FILTER_VALIDATE_URL)) {
        $link = url($link);
    }
    return $link;
}

function checkFilterUrl($list, $pagination = false)
{
    $url = array();
    if ($pagination) {
        foreach ($list as $item) {
            if (Input::get($item)) $url[$item] = Input::get($item);
        }
        return $url;
    } else {
        $url = '';
        foreach ($list as $item) {
            if (Input::get($item)) $url = $url . ',' . $item . '=' . Input::get($item);
        }
        return ltrim($url, ',');
    }
}

function getLang($key, $default = null, $replace = [], $locale = null)
{
    $default = $default === null ? $key : $default;
    return Lang::has($key) ? Lang::get($key, $replace, $locale) : $default;
}

function timeAgo($created_at)
{
    return \Carbon\Carbon::createFromTimeStamp(strtotime($created_at))->diffForHumans();
}

function checkRole($role)
{
    return IZeeRole::checkRole($role);
}

function hasRole($role)
{
    IZeeRole::hasRole($role);
}

function checkRouteAccess($route)
{
    return IZeeRole::checkRouteAccess($route);
}

function hashRouteAccess($route)
{
    IZeeRole::hashRouteAccess($route);
}

function adminSidebarItem($item)
{
    $sidebar = '';
    if (empty($item['subs'])) {
        if (!checkRouteAccess($item['route'])) {
            return $sidebar;
        }
        $params = empty($item['params']) ? [] : $item['params'];
        $label = '';
        if (!empty($item['label'])) {
            $label = '<div class="label label-' . $item['label']['type'] . ' pull-right">' . $item['label']['value'] . '</div>';
        }
        $sidebar .= '<li class="' . adminActiveItemSidebar($item['active']) . '"><a href="' . route($item['route'], $params) . '" title="' . $item['title'] . '"><em class="' . $item['icon'] . '"></em>' . $label . '<span>' . $item['title'] . '</span></a></li>';
    } else {
        $tmp = '';
        foreach ($item['subs'] as $val) {
            if (!checkRouteAccess($val['route'])) {
//                            $sidebar .= $val['route'];
                continue;
            }
            $params = empty($val['params']) ? [] : $val['params'];
            $label = '';
            if (!empty($val['label'])) {
                $label = '<div class="label label-' . $val['label']['type'] . ' pull-right">' . $val['label']['value'] . '</div>';
            }
            $tmp .= '<li class="' . adminActiveItemSidebar($val['active']) . '"><a href="' . route($val['route'], $params) . '" title="' . $val['title'] . '">' . $label . '<span>' . $val['title'] . '</span></a></li>';
        }
        if (!empty($tmp)) {
            $label = '';
            if (!empty($item['label'])) {
                $label = '<div class="label label-' . $item['label']['type'] . ' pull-right">' . $item['label']['value'] . '</div>';
            }
            $id = str_slug($item['title']) . rand(1, 1000);
            $sidebar .= '<li class="' . adminActiveItemSidebar($item['active']) . '"><a href="#' . $id . '" title="' . $item['title'] . '" data-toggle="collapse"><em class="' . $item['icon'] . '"></em>' . $label . '<span>' . $item['title'] . '</span></a>';
            $sidebar .= '<ul id="' . $id . '" class="nav sidebar-subnav collapse ' . adminActiveItemSidebar($item['active'], 'in') . '">';
            $sidebar .= ' <li class="sidebar-subnav-header">' . $item['title'] . '</li>';
            $sidebar .= $tmp;
            $sidebar .= '</ul></li>';
        }
    }
    return $sidebar;
}

function displayName($user)
{
    if (is_array($user)) {
        return $user['last_name'] . ' ' . $user['first_name'];
    } elseif (is_object($user)) {
        return $user->last_name . ' ' . $user->first_name;
    }
    return '';
}

function getPerPage()
{
    $perPage = request()->input('per_page', NUM_PER_PAGE);
    return $perPage <= NUM_PER_PAGE ? NUM_PER_PAGE : ($perPage >= 150 ? 150 : $perPage);
}

function getSortBy($allow = array())
{
    $request = request()->only(['sort', 'order_by']);
    if (!in_array($request['sort'], $allow)) {
        return array();
    }
    $orderBy = strtolower($request['order_by']) == 'asc' ? 'asc' : 'desc';
    return ['type' => ORDER_BY, 'column' => $request['sort'], 'value' => $orderBy];
}

function btnShow($route, $parameters = array())
{
    return '<a data-toggle="tooltip" title="' . trans('form.btn.show') . '" class="btn btn-xs btn-info btn-action" href="' . route($route, $parameters) . '"><i class="fa fa-eye"></i></a>';
}

function btnEdit($route, $parameters = array())
{
    return '<a data-toggle="tooltip" title="' . trans('form.btn.edit') . '" class="btn btn-xs btn-primary btn-action" href="' . route($route, $parameters) . '"><i class="fa fa-pencil-square-o"></i></a>';
}

function btnDelete($route, $parameters = array())
{
    return '<span data-toggle="tooltip" title="' . trans('form.btn.delete') . '">
                <a data-toggle="modal" class="btn btn-xs btn-danger btn-action" data-href="' . route($route, $parameters) . '" href="#" data-target="#confirm-delete">
                <i class="fa fa-trash"></i>
                </a>
            </span>';
}

function showPaginationFilter($route, $perPage = NUM_PER_PAGE, $parameters = array())
{
    $parameters['page'] = 1;
    $filter = [15, 20, 25, 50, 100, 150,];
    $html = '<div class="btn-group">';
    $html .= '<button data-toggle="dropdown" class="btn btn-default">' . trans('pagination.display', ['record' => $perPage]) . ' <b class="caret"></b></button>';
    $html .= '<ul role="menu" class="dropdown-menu animated fadeInDown">';
    foreach ($filter as $item) {
        $parameters['per_page'] = $item;
        $html .= '<li><a href="' . route($route, $parameters) . '">' . trans('pagination.display', ['record' => $item]) . '</a></li>';
    }
    $html .= '</ul></div>';
    return $html;
}

function showSortBy($title, $route, $column, $parameters = array())
{
    $parameters['sort'] = $column;
    if (request()->input('sort') == $column) {
        $orderBy = strtolower(request()->input('order_by'));
        if ($orderBy == 'asc') {
            $parameters['order_by'] = 'desc';
            return '<a class="active th-link" href="' . route($route, $parameters) . '">' . $title . ' <i class="fa fa-sort-asc"></i></a>';
        } else {
            $parameters['order_by'] = 'asc';
            return '<a class="active th-link" href="' . route($route, $parameters) . '">' . $title . ' <i class="fa fa-sort-desc"></i></a>';
        }
    } else {
        $parameters['order_by'] = 'desc';
        return '<a class="th-link" href="' . route($route, $parameters) . '">' . $title . ' <i class="fa fa-sort"></i></a>';
    }
}

function izWriteLog(Exception $e)
{
    Log::error('#####Exception:', [
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
    ]);
}

/**
 * Replace variable template email
 * @param $keys
 * @param $content
 * @return mixed
 */
function replaceTemplateMail($keys, $content)
{
    if (empty($keys)) {
        return $content;
    }
    foreach ($keys as $key) {
        $content = str_replace('{' . $key . '}', sprintf('{{$%s}}', $key), $content);
    }
    return $content;
}

/**
 * Replace variable subject mail
 * @param $key
 * @param array $value
 * @return mixed
 */
function replaceSubjectMail($key, array $value)
{
    $template = config('email-template.' . $key);
    if (empty($template) || empty($template['keys'])) {
        return $template['subject'];
    }
    $keys = array_keys($template['keys']);
    $subject = $template['subject'];
    foreach ($keys as $key) {
        $subject = str_replace('{' . $key . '}', !empty($value[$key]) ? $value[$key] : '', $subject);
    }
    return $subject;
}

/**
 * Get code tracking email
 * @param array $params
 * @param $routeName
 * @return string
 */
function getTemplateTrackingEmail(array $params, $routeName)
{
    if (empty($params) || empty($routeName)) {
        return '';
    }
    return route($routeName, $params);
}

function randomContentEmail()
{
    $content = array(
        'Yêu người, người thường yêu lại, kính người, người thường kính lại',
        'Người khéo dùng oai không giận bậy. Ngưới khéo dùng ơn không cho bậy',
        'Lời hứa càng dễ dàng bao nhiêu thì càng dễ quên bấy nhiêu',
        'Khi bạn ở ngoài sáng, tất cả mọi thứ đều theo bạn, nhưng khi bạn bước vào bóng tối, ngay cả cái bóng của bạn cũng không đi theo bạn nữa',
        'Thế giới đã phải chịu tổn thất rất lớn. Không phải vì sự tàn ác của những người xấu, mà là vì sự im lặng của những người tốt',
        'Tốt nhất là hãy trở nên hiểu biết nhờ bất hạnh của kẻ khác hơn là của bạn.',
        'Người bất mãn ở một nơi khó thấy hài lòng ở nơi khác',
        'Tất cả chúng ta đều có cuộc đời riêng để theo đuổi, giấc mơ riêng để dệt nên, và tất cả chúng ta đều có sức mạnh để biến mơ ước trở thành hiện thực, miễn là chúng ta giữ vững niềm tin.',
        'Hãy tha thứ cho những khuyết điểm và sai lầm của mình và tiến bước.',
        'Hãy có trách nhiệm với cuộc đời mình. Hãy biết rằng chính bạn là người sẽ đưa bạn tới nơi bạn muốn đến chứ không phải ai khác',
        'Nụ cười sẽ cho bạn một sắc thái tích cực khiến người khác thấy thoải mái khi ở bên cạnh bạn.',
        'Bạn có trách nhiệm biến giấc mơ của mình thành hiện thực.',
        'Cuộc sống không có giới hạn, chỉ trừ những giới hạn do chính bạn tạo ra.',
        'Nhiều người không tập trung được lòng can đảm để sống với giấc mơ vì họ sợ chết.',
        'Trong mọi hiện tượng, sự bắt đầu luôn luôn là thời điểm đáng chú ý nhất',
        'Một ngày không có tiếng cười là một ngày lãng phí.',
        'Chữ người, nghĩa hẹp là gia đình, anh em, họ hàng, bầu bạn. Nghĩa rộng là đồng bào cả nước. Rộng nữa là cả loài người.',
        'Ai cũng có lòng tự trọng, tự tin. Không có lòng tự trọng, tự tin là người vô dụng.',
        'Phê bình là không phải để mỉa mai, nói xấu. Phê bình là để giúp nhau tiến bộ.',
        'Ai cũng nên được tôn trọng như một cá nhân, nhưng không phải là thần tượng hóa.',
        'Con người chỉ là sản phẩm của cách mình suy nghĩ. Anh nghĩ gì, anh sẽ trở thành cái đó.',
        'Hãy sống như ngày mai anh chết. Hãy học như anh sẽ sống mãi mãi.',
        'Con người trở nên vĩ đại theo đúng mức độ mình làm vì lợi ích của đồng loại.',
        'Lịch sử của thế giới chính là tiến trình của ý thức tự do.',
        'Con người tiến đến chân lý không thể vươn tới qua hàng loạt sai lầm.',
        'Con người có thể thay đổi cuộc đời mình bằng cách thay đổi thái độ của mình.',
        'Cuộc đời có đáng sống không? Tất cả phụ thuộc vào người sống nó.',
        'Hãy sống khát khao, hãy sống dại khờ.',
        'Cuộc sống không dài lâu, và không nên tiêu tốn nó quá nhiều ngồi không mà suy tính nên sống thế nào.',
        'Cuộc sống rất thú vị, và thú vị nhất khi nó được sống vì người khác.',
    );
    $key = array_rand($content);
    return $content[$key];
}


/**
 * HELPER FOR UPLOAD FILE
 */

function getPathUploadFile($path)
{
    if (!File::isDirectory(public_path($path))) {
        File::makeDirectory(public_path($path), 0777, true);
    }
    $path .= date('Y');
    if (!File::isDirectory(public_path($path))) {
        File::makeDirectory(public_path($path), 0777, true);
    }
    $path .= '/' . date('m');
    if (!File::isDirectory(public_path($path))) {
        File::makeDirectory(public_path($path), 0777, true);
    }
    return $path;
}

function getRandomFileName($name, $ext)
{
    return date('YmdHi') .'-'. sha1(uniqid() . $name) . '.' . $ext;
}

function uploadFile($request, $fieldName, $path, $filename = null)
{
    if ($request->hasFile($fieldName)) {
        $file = $request->file($fieldName);
        $filename = empty($filename) ? getRandomFileName($file->getClientOriginalName(), $file->getClientOriginalExtension()) : $filename;
        $path = getPathUploadFile($path);
        $file->move(public_path($path), $filename);
        return $path . '/' . $filename;
    }
    return null;
}

function uploadArrayFile($request, $fieldName, array $fileLists, $path, $filename = array())
{
    $files = $request->file($fieldName);
    $pathRoot = $path;
    if(is_array($files)){
        $fileLists = empty($fileLists) ? array_keys($files) : $fileLists;
        foreach($fileLists as $val){
            if(empty($files[$val])){
                $data[$val] = null;
            }else{
                if(is_array($files[$val])){
                    $tmp = array();
                    foreach($files[$val] as $key => $item){
                        $filename = getRandomFileName($item->getClientOriginalName(), $item->getClientOriginalExtension());
                        $path = getPathUploadFile($pathRoot);
                        $item->move(public_path($path), $filename);
                        $tmp[$key] = $path . '/' . $filename;
                    }
                    $data[$val] = $tmp;
                }else{
                    $filename = empty($filename[$val]) ? getRandomFileName($files[$val]->getClientOriginalName(), $files[$val]->getClientOriginalExtension()) : $filename[$val];
                    $path = getPathUploadFile($pathRoot);
                    $files[$val]->move(public_path($path), $filename);
                    $data[$val] = $path . '/' . $filename;
                }
            }
        }
    }else{
        foreach($fileLists as $val){
            $data[$val] = null;
        }
    }
    return $data;
}

function removeFile($path){
    if(File::exists(public_path($path))){
        File::delete(public_path($path));
    }
}

function array_remove_keys(array &$array, array $keys){
    foreach($keys as $key){
        unset($array[$key]);
    }
}

/*-----------------------------------------------------------------------------------------------------------
 *  JSON FUNCTION
 *-----------------------------------------------------------------------------------------------------------
 */

function sanitizeSetValue($value)
{
    return !empty($value) && is_array($value) ? json_encode($value) : $value;
}

function sanitizeGetValue($value)
{
    return !empty($value) && json_decode($value, true) ? json_decode($value, true) : $value;
}

/*-----------------------------------------------------------------------------------------------------------
 *  FILE FUNCTION
 *-----------------------------------------------------------------------------------------------------------
 */
function deleteFile($file)
{
    if (File::exists($file)) {
        File::delete($file);
    }
}

function cleanNumberPhone($phone)
{
    $phone = str_replace('.', '', $phone);
    $phone = str_replace(' ', '', $phone);
    return $phone;
}

function xml2array($xmlObject, $out = array())
{
    foreach ((array)$xmlObject as $index => $node)
        $out[$index] = (is_object($node)) ? xml2array($node) : $node;

    return $out;
}


function getSmsCode($id, $prefix = '')
{
    $number = $id;
    if ($id < 1000) {
        $number = str_pad($id, strlen(1000) - 1, '0', STR_PAD_LEFT);
    }
    return $prefix . $number;
}

function hiddenLastPhone($phone, $replace = 'xxx')
{
    return preg_replace("/([0-9]{" . (strlen($phone) - 3) . "})([0-9]{3})/", "$1" . $replace, $phone);
}


function formatDataOfProducts($products)
{
    if (!count($products)) {
        return [];
    }
    $format = [];

    foreach ($products as $product) {
        if (empty($product['product_id'])) {
            continue;
        }
        $tmp = $product;
        unset($tmp['product_id']);
        $format[$product['product_id']] = $tmp;
    }
    return $format;
}

function getThumbFileUpload($file)
{
    $explode = explode('.', $file);
    $ext = end($explode);
    if (in_array($ext, ['gif', 'jpeg', 'jpg', 'png', 'bmp'])) {
        return $file;
    }
    switch ($ext) {
        case 'pdf':
            return 'assets/thumbnails/pdf-icon.png';
        case 'doc':
        case 'docx':
            return 'assets/thumbnails/word-doc-icon.png';
        case 'xls':
        case 'xlsx':
            return 'assets/thumbnails/excel-xls-icon';
        case 'zip':
            return 'assets/thumbnails/zip-icon.png';
        case 'rar':
            return 'assets/thumbnails/rar-icon.png';
        default:
            return 'assets/thumbnails/no-icon.png';
    }
}

function getDataFormSearch()
{
    $request = app('Illuminate\Http\Request');
    $data = $request->only(array('page', 'sort', 'orderBy', 'per-page', 'search', 'filter', 'filter1', 'filter2', 'filter3', 'filter4', 'advanced'));
    $data['per-page'] = (int)$data['per-page'] < NUM_PER_PAGE ? NUM_PER_PAGE : (int)$data['per-page'];
    $data['per-page'] = $data['per-page'] > 100 ? 100 : $data['per-page'];
    $data['orderBy'] = strtolower((string)$data['orderBy']) === 'asc' ? 'asc' : 'desc';
    return $data;
}

// convert number money to text money
function vndText($amount)
{
    if ($amount <= 0) {
        return $textnumber = "Tiền phải là số nguyên dương lớn hơn số 0";
    }
    $Text = array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
    $TextLuythua = array("", "nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
    $textnumber = "";
    $length = strlen($amount);

    for ($i = 0; $i < $length; $i++)
        $unread[$i] = 0;
    for ($i = 0; $i < $length; $i++) {
        $so = substr($amount, $length - $i - 1, 1);

        if (($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)) {
            for ($j = $i + 1; $j < $length; $j++) {
                $so1 = substr($amount, $length - $j - 1, 1);
                if ($so1 != 0)
                    break;
            }

            if (intval(($j - $i) / 3) > 0) {
                for ($k = $i; $k < intval(($j - $i) / 3) * 3 + $i; $k++)
                    $unread[$k] = 1;
            }
        }
    }

    for ($i = 0; $i < $length; $i++) {
        $so = substr($amount, $length - $i - 1, 1);
        if ($unread[$i] == 1)
            continue;

        if (($i % 3 == 0) && ($i > 0))
            $textnumber = $TextLuythua[$i / 3] . " " . $textnumber;

        if ($i % 3 == 2)
            $textnumber = 'trăm ' . $textnumber;

        if ($i % 3 == 1)
            $textnumber = 'mươi ' . $textnumber;


        $textnumber = $Text[$so] . " " . $textnumber;
    }

    //Phai de cac ham replace theo dung thu tu nhu the nay
    $textnumber = str_replace("không mươi", "lẻ", $textnumber);
    $textnumber = str_replace("lẻ không", "", $textnumber);
    $textnumber = str_replace("mươi không", "mươi", $textnumber);
    $textnumber = str_replace("một mươi", "mười", $textnumber);
    $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
    $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
    $textnumber = str_replace("mười năm", "mười lăm", $textnumber);
    return ucfirst($textnumber . " đồng chẵn");

}


function getCode($total, $prefix)
{
    return $prefix . date('ym') . str_pad($total + 1, MAX_COUNT_CODE, '0', STR_PAD_LEFT);
}

function getGenderLabel($gender)
{
    return $gender == GENDER_MALE ? 'Nam' : 'Nữ';
}

/***********************************************************************************************************************
 * ARRAY FUNCTION
 **********************************************************************************************************************/


/**
 * @param $array
 * @param $id
 * @return array
 */
function getItemArrayById($array, $id)
{
    if (empty($array)) {
        return [];
    }
    $find = array_where($array, function ($key, $value) use ($id) {
        return $value['id'] == $id;
    });
    return !empty($find) ? end($find) : [];
}

if(!function_exists('cache')){
    function cache($key, $default = null){
        return Cache::get($key, $default);
    }
}

function putCache($key, $value, $minutes){
    Cache::put($key, $value, $minutes);
}

function forgotCache($key){
    Cache::forget($key);
}

function getBaseMonthYearCondition()
{
    return array(
        array(
            'type' => WHERE_MONTH,
            'value' => date('m'),
            'column' => 'created_at'
        ),
        array(
            'type' => WHERE_YEAR,
            'value' => date('Y'),
            'column' => 'created_at'
        ),
    );
}

// Embed link youtube
function linkYoutubeEmbed($url) {
    $pattern =
        '%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x'
    ;
    $result = preg_match($pattern, $url, $matches);
    if ($result != false && !empty($matches[1])) {
        return 'https://www.youtube.com/embed/'.$matches[1];
    }
    return false;
}

function getRouteName(){
    return Request::route()->getName();
}

// Lấy giá trị của thông báo
function getNotification()
{
    $type = array(
        'success' => 'fa-check',
        'error' => 'fa-times',
        'warning' => 'exclamation-triangle',
        'info' => 'fa-info'
    );
    $alert = array();
    foreach ($type as $key => $item) {
        if (Session::has($key) && !is_array($messge = Session::get($key))) {
            $alert = array(
                'type' => $key,
                'icon' => $item,
                'message' => $messge
            );
            break;
        }
    }
    return $alert;
}

// Add class menu selected sidebar
function activeItemSidebar($slug = null)
{
    if (!is_null($slug) && is_array($slug)) {
        foreach ($slug as $value) {
            if (Request::is(BACKEND_PREFIX . '/' . $value)) {
                return ' active';
            }
        }
    } else {
        if (Request::is(BACKEND_PREFIX . '/' . $slug) || (is_null($slug) && Request::is(BACKEND_PREFIX . $slug))) {
            return ' active';
        }
    }
    return '';
}

if (!function_exists('checkAccess')) {
    /**
     * @param array | string $permission
     *
     * @return bool
     */
    function checkAccess($permission)
    {
        return true;
        return IZeeRole::checkRouteAccess($permission);
    }
}

/**
 * Check and Generate a URL to a named route.
 *
 * @param  string $name
 * @param  array  $parameters
 * @param  bool   $bool
 *
 * @return string|bool
 */
function checkAccessRoute($name, $parameters = array(), $bool = false)
{
    if (checkAccess($name)) {
        return route($name, $parameters);
    }
    return $bool ? false : 'javascript:void(0);';;

}

/**
 * @param       $data
 *
 * @return null|string
 */
function createSideBackend($data = array())
{
    $item = null;
    if (empty($data['sub'])) {
        $url = checkAccessRoute($data['route'], array(), true);
        if ($url !== false) {
            $item .= '<li class="' . activeItemSidebar($data['active']) . '">';
            $item .= '<a href="' . $url . '">';
            $item .= '<i class="fa ' . $data['icon'] . '"></i>';
            $item .= '<span>' . $data['title'] . '</span>';
            $item .= '</a></li>';
        }
    } elseif (is_array($data['sub'])) {
        $tmp = null;
        foreach ($data['sub'] as $val) {
            $url = checkAccessRoute($val['route'], (empty($val['parameters']) ? array() : $val['parameters']), true);
            if ($url !== false) {
                $tmp .= '<li><a href="' . $url . '">';
                $tmp .= '<i class="' . (empty($val['icon']) ? 'fa fa-circle-o' : $val['icon']) . '"></i>';
                $tmp .= $val['title'];
                $tmp .= '</a></li>';
            }
        }
        if ($tmp !== null) {
            $item .= '<li class="treeview ' . activeItemSidebar($data['active']) . '"><a href="#">';
            $item .= '<i class="fa ' . $data['icon'] . '"></i>';
            $item .= '<span>' . $data['title'] . '</span> <i class="fa fa-angle-left pull-right"></i></a>';
            $item .= '<ul class="treeview-menu">';
            $item .= $tmp;
            $item .= '</ul>';
        }
    }
    return $item;
}

global $disableId;

function checkSelected($id, $parentId, $categoryId, $categoryParentId)
{
    global $disableId;

    if(!empty($disableId) && in_array($parentId, $disableId))
    {
        $disableId[] = $id;
        return 'disabled';
    }
    if(!empty($categoryId) && $categoryId == $id)
    {
        $disableId[] = $id;
        return 'disabled';
    }
    if(!empty($categoryParentId) && $categoryParentId == $id)
    {
        $disableId[] = $id;
        return 'selected'.' disabled';
    }
    return '';
}

function recursionSelected($data, $parent=0, $txt='', $categoryId = '', $categoryParentId = '')
{
    foreach($data as $key=>$value){
        if($value->parent_id == $parent)
        {
            $id = $value->id;
            $parentId = $value->parent_id;
            echo '<option value="'.$id.'" '.checkSelected($id, $parentId, $categoryId, $categoryParentId).'>'.$txt.$value->name.'</option>';
            unset($data[$key]);
            recursionSelected($data, $id, $txt.'-----| ', $categoryId, $categoryParentId);
        }
    }
}