<?php return array (
  'app' => 
  array (
    'name' => 'Laravel',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'asset_url' => NULL,
    'timezone' => 'UTC',
    'locale' => NULL,
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:iFoJkLdvYT4FD+PwFEx1IRncs08dW/XDMiLTiuZdX3g=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
      26 => 'Yajra\\Datatables\\DatatablesServiceProvider',
      27 => 'Yajra\\DataTables\\ButtonsServiceProvider',
      28 => 'Meneses\\LaravelMpdf\\LaravelMpdfServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Up' => 'App\\Http\\Controllers\\Upload',
      'Datatables' => 'Yajra\\Datatables\\Facades\\Datatables',
      'PDF' => 'Meneses\\LaravelMpdf\\Facades\\LaravelMpdf',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\xampp\\htdocs\\lawyer_app\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'laravel_cache',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'lawyer_app',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'lawyer_app',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'lawyer_app',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'lawyer_app',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'options' => 
      array (
        'cluster' => 'predis',
        'prefix' => 'laravel_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
      'starts_with' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => ':column :direction NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'datatables-buttons' => 
  array (
    'namespace' => 
    array (
      'base' => 'DataTables',
      'model' => '',
    ),
    'pdf_generator' => 'snappy',
    'snappy' => 
    array (
      'options' => 
      array (
        'no-outline' => true,
        'margin-left' => '0',
        'margin-right' => '0',
        'margin-top' => '10mm',
        'margin-bottom' => '10mm',
      ),
      'orientation' => 'landscape',
    ),
    'parameters' => 
    array (
      'dom' => 'Bfrtip',
      'order' => 
      array (
        0 => 
        array (
          0 => 0,
          1 => 'desc',
        ),
      ),
      'buttons' => 
      array (
        0 => 'create',
        1 => 'export',
        2 => 'print',
        3 => 'reset',
        4 => 'reload',
      ),
    ),
    'generator' => 
    array (
      'columns' => 'id,add your columns,created_at,updated_at',
      'buttons' => 'create,export,print,reset,reload',
      'dom' => 'Bfrtip',
    ),
  ),
  'datatables-fractal' => 
  array (
    'includes' => 'include',
    'serializer' => 'League\\Fractal\\Serializer\\DataArraySerializer',
  ),
  'datatables-html' => 
  array (
    'table' => 
    array (
      'class' => 'table',
      'id' => 'dataTableBuilder',
    ),
    'callback' => 
    array (
      0 => '$',
      1 => '$.',
      2 => 'function',
    ),
    'script' => 'datatables::script',
    'editor' => 'datatables::editor',
  ),
  'debug-server' => 
  array (
    'host' => 'tcp://127.0.0.1:9912',
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => 'C:\\xampp\\htdocs\\lawyer_app\\storage\\fonts/',
      'font_cache' => 'C:\\xampp\\htdocs\\lawyer_app\\storage\\fonts/',
      'temp_dir' => 'C:\\Users\\Elebzary\\AppData\\Local\\Temp',
      'chroot' => 'C:\\xampp\\htdocs\\lawyer_app',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => 'C:\\Users\\Elebzary\\AppData\\Local\\Temp',
      'remote_disk' => NULL,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\lawyer_app\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp\\htdocs\\lawyer_app\\storage\\app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'C:\\xampp\\htdocs\\lawyer_app\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'C:\\xampp\\htdocs\\lawyer_app\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => '587',
    'from' => 
    array (
      'address' => 'taheelpost@gmail.com',
      'name' => 'Laravel',
    ),
    'encryption' => 'tls',
    'username' => 'taheelpost@gmail.com',
    'password' => 'asd3503242',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\xampp\\htdocs\\lawyer_app\\resources\\views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'pdf' => 
  array (
    'mode' => '',
    'format' => 'A4',
    'default_font_size' => '12',
    'default_font' => 'sans-serif',
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 10,
    'margin_bottom' => 10,
    'margin_header' => 0,
    'margin_footer' => 0,
    'orientation' => 'P',
    'title' => 'Laravel mPDF',
    'author' => '',
    'watermark' => '',
    'show_watermark' => false,
    'watermark_font' => 'sans-serif',
    'display_mode' => 'fullpage',
    'watermark_text_alpha' => 0.1,
    'custom_font_dir' => '',
    'custom_font_data' => 
    array (
    ),
    'auto_language_detection' => false,
    'temp_dir' => '',
    'pdfa' => false,
    'pdfaauto' => false,
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'response' => 
  array (
    'name' => 
    array (
      'ar' => 'البريد الإلكتروني موجود من قبل',
      'en' => 'Name is Required',
    ),
    'package_ended' => 
    array (
      'ar' => 'تم انتهاء الباقة',
      'en' => 'package ended',
    ),
    'you_not_admin' => 
    array (
      'ar' => 'يجب أن تكون ادمين للاشتراك فالباقة',
      'en' => 'Name is Required',
    ),
    'updated_s' => 
    array (
      'ar' => 'تم التعديل بنجاح',
      'en' => 'data updated successfully',
    ),
    'status_updated_s' => 
    array (
      'ar' => 'تم التعديل الحالة بنجاح',
      'en' => 'status changes successfully',
    ),
    'email' => 
    array (
      'ar' => 'البريد الإلكتروني مطلوب',
      'en' => 'Email is Required',
    ),
    'phone' => 
    array (
      'ar' => 'رقم الهاتف مطلوب',
      'en' => 'Phone is Required',
    ),
    'code_found' => 
    array (
      'ar' => 'تم فتح الحصة',
      'en' => 'session opened',
    ),
    'email_exist' => 
    array (
      'ar' => 'البريد الإلكتروني موجود من قبل',
      'en' => 'Email already exists',
    ),
    'phone_exist' => 
    array (
      'ar' => 'الهاتف موجود من قبل',
      'en' => 'Phone already exists',
    ),
    'not_active' => 
    array (
      'ar' => 'عفواً,الحساب غير مفعل بعد',
      'en' => 'Sorry,the account is not active yet',
    ),
    'waiting_admin' => 
    array (
      'ar' => 'عفواً,فى انتظار موافقة الأدمن',
      'en' => 'Sorry,waiting admin to accept',
    ),
    'registered' => 
    array (
      'ar' => 'تم التسجيل بنجاح,الرجاء التفعيل',
      'en' => 'Registered Successfully,please activate',
    ),
    'register_success' => 
    array (
      'ar' => 'تم التسجيل بنجاح',
      'en' => 'Registered Successfully',
    ),
    'activated' => 
    array (
      'ar' => 'تم التفعيل بنجاح',
      'en' => 'Activated Successfully',
    ),
    'activated_waiting' => 
    array (
      'ar' => 'تم تفعيل الهاتف بنحاح فى انتظار موافقة الأدمن',
      'en' => 'Phone Activated Successfully waiting admin to accept',
    ),
    'password_changed' => 
    array (
      'ar' => 'تم إعادة تعيين كلمة المرور بنجاح',
      'en' => 'Password has been reset successfully',
    ),
    'old_password' => 
    array (
      'ar' => 'كلمة المرور القديمة غير صحيحة',
      'en' => 'Old Password incorrect',
    ),
    'invalid_code' => 
    array (
      'ar' => 'كود غير صحيح',
      'en' => 'Invalid Code',
    ),
    'logged_in' => 
    array (
      'ar' => 'كده انت ميه ميه ياعم الحج اتفضل برجلك اليمين',
      'en' => 'Logged In',
    ),
    'code_sent' => 
    array (
      'ar' => 'تم إرسال الكود',
      'en' => 'Code Sent Successfully',
    ),
    'code_expire' => 
    array (
      'ar' => 'انتهاء صلاحية الكود',
      'en' => 'Code Expire',
    ),
    'invalid_data' => 
    array (
      'ar' => ' البيانات  غير صحيحة ',
      'en' => 'Data Invalid! ',
    ),
    'not_authoize' => 
    array (
      'ar' => 'يرجى تسجيل الدخول',
      'en' => 'please login first',
    ),
    'not_found' => 
    array (
      'ar' => 'البريد الاليكترونى غير موجود بالنظام',
      'en' => 'E-mail not found',
    ),
    'permission_warrning' => 
    array (
      'ar' => 'عفوآ لا تمتلك صلاحية للدخول لهذه الصفحه',
      'en' => 'permission not allowed!',
    ),
    'test_done' => 
    array (
      'ar' => '   تم الامتحان واعتماد النتيجه من قبل لا تبك على اللبن المسكوب',
      'en' => 'you have done exame before',
    ),
    'promo_notfound' => 
    array (
      'ar' => 'كود الحصة غير صحيح يازميلى  ',
      'en' => 'your code innvalid ',
    ),
    'session_not_pay' => 
    array (
      'ar' => ' يرجى دفع قيمه الحصة  ',
      'en' => 'please pay for session first',
    ),
    'code_notequal_price' => 
    array (
      'ar' => 'تكلفه الحصة لا تساوى قيمه الكود الذي ادخلته  ',
      'en' => 'your code value does not equal session price ',
    ),
    'session_not_found' => 
    array (
      'ar' => 'الحصه غير موجوده ',
      'en' => 'Session  not found',
    ),
    'success' => 
    array (
      'ar' => '  تمت العملية بنجاح',
      'en' => 'Done Successfully',
    ),
    'login_success' => 
    array (
      'ar' => ' تم تسجيل الدخول بنجاح ',
      'en' => 'Login  Successfully',
    ),
    'login_warrning' => 
    array (
      'ar' => 'البريد الالكترونى او الرقم السري غير صحيح! ',
      'en' => 'E-mail or Password invalid!',
    ),
    'data_invalid' => 
    array (
      'ar' => 'البيانات غير صحيحة برجاء التاكد من البيانات ',
      'en' => 'Data  invalid!',
    ),
    'Error' => 
    array (
      'ar' => 'حدث خطأ ما ',
      'en' => 'Error!',
    ),
    'per_updated' => 
    array (
      'ar' => 'تم تعديل الصلاحية بنجاح  ',
      'en' => '   permission updated successfully!',
    ),
    'logout_success' => 
    array (
      'ar' => 'تم تسجيل الخروج بنجاح ',
      'en' => 'Logged out successfully ',
    ),
    'send' => 
    array (
      'ar' => 'تم الإرسال.',
      'en' => 'Send successfully.',
    ),
    'user_accept' => 
    array (
      'ar' => 'وافق المستخدم على عرضك.',
      'en' => 'User accept your offer.',
    ),
    'user_decline' => 
    array (
      'ar' => 'رفض المستخدم عرضك.',
      'en' => 'User decline your offer.',
    ),
    'new_message' => 
    array (
      'ar' => 'رسالة جديدة.',
      'en' => 'New Message.',
    ),
    'rate' => 
    array (
      'ar' => 'تم التقيم بنجاح',
      'en' => 'Rate done successfully.',
    ),
    'already_rate' => 
    array (
      'ar' => 'لا يمكن التقيم اكثر من مره.',
      'en' => 'Can not rate more than one.',
    ),
    'canceled' => 
    array (
      'ar' => 'تم الغاء الاوردر.',
      'en' => 'Order canceled.',
    ),
    'not_cancel' => 
    array (
      'ar' => 'لا يمكن الغاء الاوردر الفني فى الطريق.',
      'en' => 'Can not cancel order, worker on way.',
    ),
    'no_available_worker' => 
    array (
      'ar' => 'لا يوجد فنين فى هذا النطاق.',
      'en' => 'No available worker in same area.',
    ),
    'canot_cancel' => 
    array (
      'ar' => 'لا يمكن الغاء الاوردر    .',
      'en' => 'Can not cancel order,.',
    ),
    'worker_cancel_order' => 
    array (
      'ar' => 'تم الغاء الطلب للخدمة .',
      'en' => 'Request service cancelled.',
    ),
    'worker_not_cancel' => 
    array (
      'ar' => 'لا يمكنك الغاء الطلب .',
      'en' => 'Request service canot cancelled.',
    ),
    'order_status_changed' => 
    array (
      'ar' => 'لقد تم الغاء حالة الطلب من قبل المستخدم',
      'en' => 'Sorry,‘Order status cancelled by user.',
    ),
    'worker_not_available' => 
    array (
      'ar' => '  عذرا.. العامل الذي قمت بإختياره غير متاح حاليا',
      'en' => 'Sorry,, the worker is not available right now',
    ),
    'order_in_10' => 
    array (
      'ar' => ' يمكنك انهاء الطلب بعد مرور عشرة دقائق من وقت الطلب مع التوااجد في موقع الطلب',
      'en' => 'You can finish after ten minutes of order time and be in order location',
    ),
    'outOfArea' => 
    array (
      'ar' => '   من فضلك تأكد من تواجدك في موقع الطلب  ',
      'en' => 'Please,Check that you are at the order location',
    ),
    'no_available_in_city' => 
    array (
      'ar' => 'عفوا هذه الخدمة غير متاحة في المدينة ',
      'en' => 'Sorry ,service not available in city',
    ),
    'order_before_now' => 
    array (
      'ar' => 'عذرا توقيت الطلب قبل الوقت الحالي',
      'en' => 'Sorry ,Your order time before time now',
    ),
    'not_allow_delete_cat' => 
    array (
      'ar' => 'يوجد دعاوى مرتبطة بهذا التصنيف.. لايمكنك الحذف',
      'en' => 'Sorry ,Your order time before time now',
    ),
    'deleted_s' => 
    array (
      'ar' => 'تم الحذف بنجاح',
      'en' => 'deleted successfully',
    ),
    'send_reset' => 
    array (
      'ar' => 'تم ارسال الكود بنجاح',
      'en' => 'reset code sent',
    ),
    'code_confirmed' => 
    array (
      'ar' => 'تم تأكيد الكود بنجاح',
      'en' => 'code confirmed successfully',
    ),
    'not_reseted' => 
    array (
      'ar' => 'لم يتم التأكيد',
      'en' => 'code not confirmed ',
    ),
    'reseted' => 
    array (
      'ar' => 'تم تغيير الرقم السري بنجاح',
      'en' => 'password has been changer  successfully',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\xampp\\htdocs\\lawyer_app\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\xampp\\htdocs\\lawyer_app\\resources\\views',
    ),
    'compiled' => 'C:\\xampp\\htdocs\\lawyer_app\\storage\\framework\\views',
  ),
);
