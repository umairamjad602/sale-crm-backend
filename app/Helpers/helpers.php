<?php

use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Users\Models\User;
use App\Http\Controllers\Accounts\Models\Account;
use App\Http\Controllers\AccountTimeline\Models\AccountTimeline;
use App\Http\Controllers\ActivityLog\Models\LogActivity;
use App\Http\Controllers\Employees\Models\Employee;
use App\Http\Controllers\Modules\Enums\LogTypeEnum;
use App\Http\Controllers\Options\Models\FieldOption;
use App\Http\Controllers\Users\Models\TemporaryUser;
use App\Http\Controllers\Modules\Enums\CompaniesEnum;
use App\Http\Controllers\Modules\Enums\PreferenceEnum;
use App\Http\Controllers\TradingAccounts\Models\TradingAccount;
use App\Http\Enums\UserTypeEnum;
use App\Http\Services\PreferencesService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Crypt;

use function Clue\StreamFilter\fun;

function dateFormat($value)
{
    return date('d M Y', strtotime($value));
}

// Change Password
function changeUserPassword(string $email, string $password, bool $passwordNeedsHash = false)
{
    $user = User::where('email', $email)->first();
    if ($user->setPassword($password, NULL, $passwordNeedsHash)) {
        return true;
    }
    return false;
}

// Register Email, Password
function registerUser(
    string $first_name,
    string $last_name,
    string $email,
    string $password,
    string $type,
    bool $passwordNeedsHash = true,
    int $companyId = NULL
) {
    $user = new User();
    $user->first_name = $first_name;
    $user->last_name = $last_name;
    $user->email = $email;
    $user->type = ucwords($type);
    $user->company_id = $companyId;
    $user->password = ($passwordNeedsHash) ? Hash::make($password) : $password;
    $user->save();
    return $user;
}

// Register Email, Password
function registerModel($data, $modelTypeId)
{
    $user = new User();
    $user->email = $modelTypeId == UserTypeEnum::Company ? $data['primary_email'] : $data['email'];
    $user->type_id = $modelTypeId;
    $user->status = $data['status'];
    $user->password = Hash::make($data["password"]);
    $user->save();
    return $user;
}

function addLog($type, $exceptionMessage = NULL, $oldData = NULL, $newData = NULL, $action = NULL, $module_id = NULL)
{
    $log = [];
    $log['type'] = $type;
    $log['relation_id'] = isset($oldData) ? $oldData['id'] : null;
    $log['old_data'] = json_encode($oldData);
    $log['new_data'] = json_encode($newData);
    $log['action'] = $action;
    $log['message'] = $type == LogTypeEnum::Error ? $exceptionMessage : auth()->user()->first_name . ' ' . auth()->user()->last_name . ',' . $action . ' ' . getModuleName($module_id) . ' Record';
    $log['url'] = Request::fullUrl();
    $log['method'] = Request::method();
    $log['ip'] = Request::ip();
    $log['module_id'] = $module_id;
    $log['created_by_type'] = $type == LogTypeEnum::Error ? 'System' : 'User';
    $log['created_by'] = $type == LogTypeEnum::Error ? '0' : userId();
    LogActivity::create($log);
}

function getModuleName($module_id)
{
    $module = Module::find($module_id, ['name']);
    if ($module) {
        return $module->name;
    }
    return '--';
}

function userId()
{
    global $globals;
    $userId = (auth()->user() ==  null) ? -1 : auth()->user()->id;
    $globals['user_id'] = $userId;
    return (int) $userId;
}

function companyId()
{
    global $globals;
    $companyId = (auth()->user() ==  null) ? -1 : auth()->user()->company_id;
    $globals['company_id'] = $companyId;
    return (int) $companyId;
}

function getUser()
{
    global $globals;
    $user = (auth()->user() ==  null) ? null : auth()->user();
    $globals['user'] = $user;
    return $user;
}

function fetchAdminId()
{
    return User::where('username','admin')->first()->id;
}

function getUserPreferences()
{
    $preferencesService = app()->make(PreferencesService::class);
    return $preferencesService->getPreferencesForLoggedInUser();
}

function checkMailExistenceExceptMe($email, $myEmail)
{
    // ignore my email and checking unique in other records
    return User::where('email', '!=', $myEmail)->where('email', '=', $email)->exists();
}

// Updte Email
function updateModel($myEmail, $email)
{
    return User::where('email', '=', $myEmail)->update(['email' => $email]);
}

// Delete Email
function deleteModel($myEmail)
{
    return User::where('email', '=', $myEmail)->delete();
}

function checkMailExistence($email)
{
    return User::where('email', '=', $email)->exists();
}

// Change Password
function changeModelPassword($request, $userId)
{
    $data = $request->all();
    $user = User::find($userId);
    if ($user->setPassword($data["password"])) {
        return true;
    }
    return false;
}

function generateRandomTransactionId($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getModuleIdFromEntity(Model $entity): int
{
    $entityReflection = new \ReflectionClass($entity);
    $nameSpace = $entityReflection->getNamespaceName();
    $splits = explode("\\", $nameSpace);
    array_pop($splits);
    $moduleNameSpace = implode("\\", $splits);
    if (!empty($moduleNameSpace)) {
        $module = Module::where('namespace', $moduleNameSpace)->first();
        return ($module) ? $module->id : 0;
    }
    return 0;
}

function getModelFromModuleId(int $moduleId): Model
{
    $module = Module::where('id', $moduleId)->first();
    if ($module) {
        $model = app()->make($module->namespace . "\\Models\\" . (substr($module->name, 0, -1)));
        return $model;
    }
    return null;
}

function parse_number($number, $decPoint = null)
{
    if (empty($dec_point)) {
        $locale = localeconv();
        $dec_point = $locale['decimal_point'];
    }
    return floatval(str_replace($decPoint, '.', preg_replace('/[^\d' . preg_quote($dec_point) . ']/', '', $number)));
}

function calculateVatAmount(float $amount, float $taxPercentage, bool $taxIncluded = true)
{
    if ($taxPercentage == 0 || $amount == 0)
        return $amount;

    if (!$taxIncluded) {
        $vatAmount  = ($taxPercentage * $amount) / (100 + $taxPercentage);
    } else {
        $vatAmount  = ($amount / 100) * $taxPercentage;
    }
    return $vatAmount;
}

function calculateDiscountAmount(float $amount, string $discount)
{
    $discountedAmount = 0;
    $discountType = "Percentage";
    if (strpos($discount, "%") == -1) {
        if ($discount <= 0) {
            return $amount;
        }
        $discountType = "Amount";
    } else {
        $discount = (float) Str::before($discount, "%");
    }

    if ($discountType === "Percentage") {
        $discountedAmount = ($amount / 100) * $discount;
    } else {
        $discountedAmount = $amount - $discount;
    }
    return $discountedAmount;
}

function getFieldOptionsByType(int $typeId)
{
    return FieldOption::where('type_id', $typeId)->get();
}

function getFieldOptionsByTypeIds(array $typeIds, array $columns)
{
    return FieldOption::select($columns)->whereIn('type_id', $typeIds)->get();
}

function pickFieldOptionFromList($fieldOptionList, $optionName)
{
    return $fieldOptionList->first(function ($value, $key) use ($optionName) {
        return $value->name == $optionName;
    });
}

function mime2ext($mime)
{
    $mime_map = [
        'video/3gpp2'                                                               => '3g2',
        'video/3gp'                                                                 => '3gp',
        'video/3gpp'                                                                => '3gp',
        'application/x-compressed'                                                  => '7zip',
        'audio/x-acc'                                                               => 'aac',
        'audio/ac3'                                                                 => 'ac3',
        'application/postscript'                                                    => 'ai',
        'audio/x-aiff'                                                              => 'aif',
        'audio/aiff'                                                                => 'aif',
        'audio/x-au'                                                                => 'au',
        'video/x-msvideo'                                                           => 'avi',
        'video/msvideo'                                                             => 'avi',
        'video/avi'                                                                 => 'avi',
        'application/x-troff-msvideo'                                               => 'avi',
        'application/macbinary'                                                     => 'bin',
        'application/mac-binary'                                                    => 'bin',
        'application/x-binary'                                                      => 'bin',
        'application/x-macbinary'                                                   => 'bin',
        'image/bmp'                                                                 => 'bmp',
        'image/x-bmp'                                                               => 'bmp',
        'image/x-bitmap'                                                            => 'bmp',
        'image/x-xbitmap'                                                           => 'bmp',
        'image/x-win-bitmap'                                                        => 'bmp',
        'image/x-windows-bmp'                                                       => 'bmp',
        'image/ms-bmp'                                                              => 'bmp',
        'image/x-ms-bmp'                                                            => 'bmp',
        'application/bmp'                                                           => 'bmp',
        'application/x-bmp'                                                         => 'bmp',
        'application/x-win-bitmap'                                                  => 'bmp',
        'application/cdr'                                                           => 'cdr',
        'application/coreldraw'                                                     => 'cdr',
        'application/x-cdr'                                                         => 'cdr',
        'application/x-coreldraw'                                                   => 'cdr',
        'image/cdr'                                                                 => 'cdr',
        'image/x-cdr'                                                               => 'cdr',
        'zz-application/zz-winassoc-cdr'                                            => 'cdr',
        'application/mac-compactpro'                                                => 'cpt',
        'application/pkix-crl'                                                      => 'crl',
        'application/pkcs-crl'                                                      => 'crl',
        'application/x-x509-ca-cert'                                                => 'crt',
        'application/pkix-cert'                                                     => 'crt',
        'text/css'                                                                  => 'css',
        'text/x-comma-separated-values'                                             => 'csv',
        'text/comma-separated-values'                                               => 'csv',
        'application/vnd.msexcel'                                                   => 'csv',
        'application/x-director'                                                    => 'dcr',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   => 'docx',
        'application/x-dvi'                                                         => 'dvi',
        'message/rfc822'                                                            => 'eml',
        'application/x-msdownload'                                                  => 'exe',
        'video/x-f4v'                                                               => 'f4v',
        'audio/x-flac'                                                              => 'flac',
        'video/x-flv'                                                               => 'flv',
        'image/gif'                                                                 => 'gif',
        'application/gpg-keys'                                                      => 'gpg',
        'application/x-gtar'                                                        => 'gtar',
        'application/x-gzip'                                                        => 'gzip',
        'application/mac-binhex40'                                                  => 'hqx',
        'application/mac-binhex'                                                    => 'hqx',
        'application/x-binhex40'                                                    => 'hqx',
        'application/x-mac-binhex40'                                                => 'hqx',
        'text/html'                                                                 => 'html',
        'image/x-icon'                                                              => 'ico',
        'image/x-ico'                                                               => 'ico',
        'image/vnd.microsoft.icon'                                                  => 'ico',
        'text/calendar'                                                             => 'ics',
        'application/java-archive'                                                  => 'jar',
        'application/x-java-application'                                            => 'jar',
        'application/x-jar'                                                         => 'jar',
        'image/jp2'                                                                 => 'jp2',
        'video/mj2'                                                                 => 'jp2',
        'image/jpx'                                                                 => 'jp2',
        'image/jpm'                                                                 => 'jp2',
        'image/jpeg'                                                                => 'jpeg',
        'image/pjpeg'                                                               => 'jpeg',
        'application/x-javascript'                                                  => 'js',
        'application/json'                                                          => 'json',
        'text/json'                                                                 => 'json',
        'application/vnd.google-earth.kml+xml'                                      => 'kml',
        'application/vnd.google-earth.kmz'                                          => 'kmz',
        'text/x-log'                                                                => 'log',
        'audio/x-m4a'                                                               => 'm4a',
        'audio/mp4'                                                                 => 'm4a',
        'application/vnd.mpegurl'                                                   => 'm4u',
        'audio/midi'                                                                => 'mid',
        'application/vnd.mif'                                                       => 'mif',
        'video/quicktime'                                                           => 'mov',
        'video/x-sgi-movie'                                                         => 'movie',
        'audio/mpeg'                                                                => 'mp3',
        'audio/mpg'                                                                 => 'mp3',
        'audio/mpeg3'                                                               => 'mp3',
        'audio/mp3'                                                                 => 'mp3',
        'video/mp4'                                                                 => 'mp4',
        'video/mpeg'                                                                => 'mpeg',
        'application/oda'                                                           => 'oda',
        'audio/ogg'                                                                 => 'ogg',
        'video/ogg'                                                                 => 'ogg',
        'application/ogg'                                                           => 'ogg',
        'font/otf'                                                                  => 'otf',
        'application/x-pkcs10'                                                      => 'p10',
        'application/pkcs10'                                                        => 'p10',
        'application/x-pkcs12'                                                      => 'p12',
        'application/x-pkcs7-signature'                                             => 'p7a',
        'application/pkcs7-mime'                                                    => 'p7c',
        'application/x-pkcs7-mime'                                                  => 'p7c',
        'application/x-pkcs7-certreqresp'                                           => 'p7r',
        'application/pkcs7-signature'                                               => 'p7s',
        'application/pdf'                                                           => 'pdf',
        'application/octet-stream'                                                  => 'pdf',
        'application/x-x509-user-cert'                                              => 'pem',
        'application/x-pem-file'                                                    => 'pem',
        'application/pgp'                                                           => 'pgp',
        'application/x-httpd-php'                                                   => 'php',
        'application/php'                                                           => 'php',
        'application/x-php'                                                         => 'php',
        'text/php'                                                                  => 'php',
        'text/x-php'                                                                => 'php',
        'application/x-httpd-php-source'                                            => 'php',
        'image/png'                                                                 => 'png',
        'image/x-png'                                                               => 'png',
        'application/powerpoint'                                                    => 'ppt',
        'application/vnd.ms-powerpoint'                                             => 'ppt',
        'application/vnd.ms-office'                                                 => 'ppt',
        'application/msword'                                                        => 'doc',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
        'application/x-photoshop'                                                   => 'psd',
        'image/vnd.adobe.photoshop'                                                 => 'psd',
        'audio/x-realaudio'                                                         => 'ra',
        'audio/x-pn-realaudio'                                                      => 'ram',
        'application/x-rar'                                                         => 'rar',
        'application/rar'                                                           => 'rar',
        'application/x-rar-compressed'                                              => 'rar',
        'audio/x-pn-realaudio-plugin'                                               => 'rpm',
        'application/x-pkcs7'                                                       => 'rsa',
        'text/rtf'                                                                  => 'rtf',
        'text/richtext'                                                             => 'rtx',
        'video/vnd.rn-realvideo'                                                    => 'rv',
        'application/x-stuffit'                                                     => 'sit',
        'application/smil'                                                          => 'smil',
        'text/srt'                                                                  => 'srt',
        'image/svg+xml'                                                             => 'svg',
        'application/x-shockwave-flash'                                             => 'swf',
        'application/x-tar'                                                         => 'tar',
        'application/x-gzip-compressed'                                             => 'tgz',
        'image/tiff'                                                                => 'tiff',
        'font/ttf'                                                                  => 'ttf',
        'text/plain'                                                                => 'txt',
        'text/x-vcard'                                                              => 'vcf',
        'application/videolan'                                                      => 'vlc',
        'text/vtt'                                                                  => 'vtt',
        'audio/x-wav'                                                               => 'wav',
        'audio/wave'                                                                => 'wav',
        'audio/wav'                                                                 => 'wav',
        'application/wbxml'                                                         => 'wbxml',
        'video/webm'                                                                => 'webm',
        'image/webp'                                                                => 'webp',
        'audio/x-ms-wma'                                                            => 'wma',
        'application/wmlc'                                                          => 'wmlc',
        'video/x-ms-wmv'                                                            => 'wmv',
        'video/x-ms-asf'                                                            => 'wmv',
        'font/woff'                                                                 => 'woff',
        'font/woff2'                                                                => 'woff2',
        'application/xhtml+xml'                                                     => 'xhtml',
        'application/excel'                                                         => 'xl',
        'application/msexcel'                                                       => 'xls',
        'application/x-msexcel'                                                     => 'xls',
        'application/x-ms-excel'                                                    => 'xls',
        'application/x-excel'                                                       => 'xls',
        'application/x-dos_ms_excel'                                                => 'xls',
        'application/xls'                                                           => 'xls',
        'application/x-xls'                                                         => 'xls',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'         => 'xlsx',
        'application/vnd.ms-excel'                                                  => 'xlsx',
        'application/xml'                                                           => 'xml',
        'text/xml'                                                                  => 'xml',
        'text/xsl'                                                                  => 'xsl',
        'application/xspf+xml'                                                      => 'xspf',
        'application/x-compress'                                                    => 'z',
        'application/x-zip'                                                         => 'zip',
        'application/zip'                                                           => 'zip',
        'application/x-zip-compressed'                                              => 'zip',
        'application/s-compressed'                                                  => 'zip',
        'multipart/x-zip'                                                           => 'zip',
        'text/x-scriptzsh'                                                          => 'zsh',
    ];

    return isset($mime_map[$mime]) ? $mime_map[$mime] : false;
}

function getAuthType()
{
    $type = request()->header('auth-type');
    if (is_null($type)) {
        $type = request()->get('auth_type', 'user');
        return $type;
    }
    return strtolower($type);
}

function getBrandId()
{
    $brandId = request()->header('consumer');
    if (is_null($brandId)) {
        $brandId = request()->get('brand_id', -1);
        return (int) $brandId;
    }
    return (int) $brandId;
}

function getOutletId()
{
    $outletId = request()->header('outlet-id');
    if (is_null($outletId)) {
        $outletId = request()->get('outlet_id', -1);
        return (int) $outletId;
    }
    return (int) $outletId;
}

function getClient()
{
    global $app;
    return $app['client'];
}

function getUserId()
{
    global $app;
    return $app['user_id'];
}

function getCompanyId()
{
    global $app;
    return $app['company_id'];
}

function vaidateACLProfileAttributtes($attribute, $value, $fail)
{
    $passed = false;
    if (count($value) > 0) {
        $moduleIds = [];
        foreach ($value as $moduleId => $permissions) {
            $moduleIds[] = $moduleId;
        }
        $modules = Module::whereIn('id', $moduleIds)->get();
        if ($modules->count() > 0) {
            $passed = true;
        }
    }
    if (!$passed) {
        return $fail("Attributes are not properly formed");
    }
}

function fieldOptionNameToId(string $fieldOptionName, $typeId = null)
{
    $queryBuilder = FieldOption::where('name', $fieldOptionName);
    if ($typeId) {
        $queryBuilder = $queryBuilder->where('type_id', $typeId);
    }
    $fieldOption = $queryBuilder->first();
    return ($fieldOption != null) ? $fieldOption->id : null;
}

function fieldOptionIdToName(int $fieldOptionId)
{
    $fieldOptions = Cache::get(env("CAHCE_KEY_FIELDOPTIONS"));
    return ($fieldOptions == null) ? getFieldOptionFromDatabaseById($fieldOptionId) : $fieldOptions[$fieldOptionId]['name'];
}

function getFieldOptionFromDatabaseById($fieldOptionId)
{
    $queryBuilder = FieldOption::where('id', $fieldOptionId);
    $fieldOption = $queryBuilder->first();
    return ($fieldOption != null) ? $fieldOption->name : null;
}

function accountTimeline(int $accountId, $message)
{
    $timeline = [];
    $timeline['account_id'] = $accountId;
    $timeline['message'] = $message;
    $timeline['date'] = date('Y-m-d H:i:s');
    $timeline['created_by'] = auth()->user()->id;
    AccountTimeline::create($timeline);
}

function generateAccountNumber($length = 7)
{
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function accountId()
{
    return Account::where('user_id', auth()->user()->id)->select(['id'])->first();
}

function account()
{
    return Account::where('user_id', auth()->user()->id)->first();
}

function employeeByGivenColumn(int $employeeId, string $column)
{
    return Employee::where($column, $employeeId)->first();
}

function userIdFromEmployeeId(int $employeeId)
{
    $employee = employeeByGivenColumn($employeeId, 'emp_id');
    if(empty($employee)){
        return -1;
    };
    return $employee;
}

function getEmployeeIdByUserId(int $userId)
{
    $employee_id = -1;
    $employee = employeeByGivenColumn($userId, "user_id");
    if(!empty($employee)){
        $employee_id = $employee->id;
    };
    return $employee_id;
}

function getValueFromObject($object, $key, $default = null)
{

    $arr = [];
    if ($object instanceof Model) {
        $arr = $object->toArray();
    }

    objToArray($object, $arr);
    $value = Arr::get($arr, $key);
    return  $value == null ? $default : $value;
}

function getValueFromArray($object, $key, $default = null)
{
    return (!empty($object) &&
        $object != null &&
        isset($object[$key])
    ) ? $object[$key] : $default;
}


function objToArray($obj, &$arr)
{
    if (!is_object($obj) && !is_array($obj)) {
        $arr = $obj;
        return $arr;
    }
    foreach ($obj as $key => $value) {
        if (!empty($value)) {
            $arr[$key] = array();
            objToArray($value, $arr[$key]);
        } else {
            $arr[$key] = $value;
        }
    }
    return $arr;
}

function bladeCompile($value, array $args = array())
{
    $generated = Blade::compileString($value);
    ob_start() and extract($args, EXTR_SKIP);
    try {
        eval('?>' . $generated);
    } catch (\Exception $e) {
        ob_get_clean();
        throw $e;
    }

    $content = ob_get_clean();

    return $content;
}

function convertStringToBladeString($str)
{
    return preg_replace('/\$[A-Za-z][\w$]*(\.[\w$]+)?(\[\d+])?/', '{{${0}}}', $str);
}

function getListOfVariablesFromString($str, &$matches)
{
    preg_match_all('/\$[A-Za-z][\w$]*(\.[\w$]+)?(\[\d+])?/', $str, $matches);
}

function fillArrayWithDefaultValues($listOfVariables, $default)
{
    $variableListValues = [];
    foreach ($listOfVariables as $key => $value) {
        $variableListValues[ltrim($value, '$')] = $default;
    }
    return $variableListValues;
}


function getMt5ClientIdByUserId(int $userId)
{
    $account = Account::where('user_id', $userId)->first();
    return ($account) ? $account->meta_trader_client_id : -1;
}

function getMt5ClientIdByAccountId(int $accountId)
{
    $account = Account::where('id', $accountId)->first();
    return ($account) ? $account->meta_trader_client_id : -1;
}

function saveTemporaryUser(string $password, TemporaryUser $temporaryUser, $userId)
{
    $temporaryUser->user_id = $userId;
    $temporaryUser->pass_phrase = $password;
    $temporaryUser->save();
    return $temporaryUser;
}

function getCountryFromRequest($ip = null)
{
    $defaultCountryName = "Local";
    if ($ip == null)
        $ip = request()->ip();
    if ($ip == "127.0.0.1")
        return $defaultCountryName;
    $response = file_get_contents("http://api.ipstack.com/" . $ip . "?access_key=cc22ed16161a7ffc74ad3f4b8dc74776");
    if ($response == null)
        return $defaultCountryName;
    $data = json_decode($response);
    if ($data && isset($data->country_name))
        return $data->country_name;
    return "";
}

function getFieldOptionNextId() {
    $fieldOption = FieldOption::orderBy('id', 'DESC')->limit(1)->first();
    return ($fieldOption == null)? 1: $fieldOption->id + 1;
}

function isDigibitsUser() {
    return companyId() == CompaniesEnum::Digibits;
}

function getUserPreferedCurrency() {
    return Arr::get(getUserPreferences(), PreferenceEnum::LAST_DASHBOARD_CURRENCY, 'USD');
}

function ipAddress() {
    $headers = request()->header();
    if(isset($headers['x-forwarded-for'])) {
        return Request::header('x-forwarded-for');
    }
    return Request::ip();
}

function encryptString(string $stringToEncrypt){
    return Crypt::encrypt($stringToEncrypt);
}

function decryptString(string $stringToDecrypt){
    return Crypt::decrypt($stringToDecrypt);
}

function getCountryUsingISOcode($code) {
    $countriesJson = null;
    if(Cache::has('$countriesJson')) {
        $countriesJson = Cache::get('$countriesJson');
    } else {
        $countriesJson = file_get_contents(app_path("Helpers/countries.json"));
        Cache::forever('$countriesJson', $countriesJson);
    }

    if($countriesJson != "") {
        $countries = json_decode($countriesJson);
        $countriesCollection = collect($countries);
        $country = $countriesCollection->first(function($country) use($code){ return strtoupper($country->code) == strtoupper($code);});
        return ($country != null)? $country: null;
    }
}


function isMatchTrader()
{
    return true;
    $headers = request()->header();
    return isset($headers["tradingPlatform"]) ? $headers["tradingPlatform"] == 'MatchTrader' : false;
}


function isMatchTraderByTradingAccount(TradingAccount $tradingAccount)
{
    return $tradingAccount->trading_platform == 'MatchTrader';
}

function isMatchTraderByAccount(Account $account)
{
    return isset($account->match_trader_default_trading_account_id);
}

function makeCallViaVoisio($phoneToCall, $agent) {
    $apiEndpoint = 'https://cc-ams03.voiso.com/api/v1/';
    $api_key = env("VOISO_API_KEY");
    $uri = $apiEndpoint . $api_key . '/click2call?number='.$phoneToCall.'&agent='.$agent;
    $ch = curl_init($uri);
    $response = curl_exec($ch);
    curl_close($ch);
    info("Call placed: ". $uri, (array)$response);
    return $response;
}
