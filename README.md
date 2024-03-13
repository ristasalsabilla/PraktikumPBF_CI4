
# Rista Salsabilla Putri (220302043)

#### Praktikum PBF - CodeIgniter4

## Welcome To CodeIgniter4
CodeIgniter adalah sebuah Application Development Framework atau toolkit untuk membangun sebuah website menggunakan bahasa PHP dengan tujuan mempercepat proses pembuatan karena terdapat banyak library yang dibutuhkan.

CodeIgniter menggunakan pattern MVC (Model-View-Controller) yaitu sebuah pola arsitektur yang digunakan dalam pengembangan perangkat lunak berorientasi objek yang memisahkan antara tampilan, data dan proses agar lebih terorganisir.
### Persyaratan Server dan Database yang Didukung
- PHP versi 7.4 atau yang lebih baru, dengan ekstensi intl, mbstring dan JSON.
- MySQL
- Oracle
- PostgreSQL
- MSSQL
- SQLite
- CUBRID
- Interbase/Firebird
- ODBC

## Instalasi
CodeIgniter memiliki dua metode instalasi yang didukung yaitu :
### Instalasi Composer
Pada metode ini pastikan Anda sudah melakukan instalasi composer versi 2.0.14 atau yang lebih baru. 

- Buka folder yang akan digunakan untuk menempatkan project. Kemudian buka terminal pada folder tersebut. 

- Masukkan perintah ini di terminal. ‘namaproject’ diisi sesuai kebutuhan.

    `` 
    composer create-project codeigniter4/appstarter namaproject 
    ``
- Untuk memperbarui semua atau beberapa dependensi ke versi terbaru yang sesuai dengan aturan versi yang ditentukan, gunakan perintah ini.

    ``
    composer update 
    ``
### Instalasi Manual
- Download starter project dari repository dan lakukan ekstrak pada folder tersebut.

### Menjalankan Aplikasi Anda
#### Konfigurasi Awal
- Buka file **app/Config/App.php**.
- Atur $baseURL : untuk menentukan URL dasar suatu aplikasi atau situs web menggunakan variabel $baseURL.
    
    ``
    app.baseURL = 'http://localhost:8080/'
    ``
- Atur $indexPage : jika tidak ingin menyertakan index.php di URL, gunakan **‘ ’** pada variabel $indexPage.
    
    ``
    app.indexPage = ''
    ``
- Ubah nama file **env** menjadi **.env**
- Buka file .env dan ubah pada bagian CI_ENVIRONMENT = production menjadi CI_ENVIRONMENT = development.
    
    ``
    CI_ENVIRONMENT = development
    ``
#### Menjalankan project
Untuk menjalankan project yang sudah Anda buat, buka terminal pada folder project dan gunakan perintah ini.

``
php spark serve
``

Pada terminal akan menampilkan localhost. Lalu klik pada bagian seperti dibawah ini.

``
http://localhost:8080
``
## Buat Aplikasi Pertama
### Halaman Statis
Hal pertama yang akan Anda lakukan adalah mengatur aturan perutean (routing) untuk menangani halaman statis.
#### Mengatur Aturan Perutean (Routing)
- Buka file **app/Config/Routes.php**.
- Masukkan perintah berikut.
    
    ```
    use App\Controllers\Pages;

    $routes->get('pages', [Pages::class, 'index']);
    $routes->get('(:segment)', [Pages::class, 'view']);
    ```
#### Buat Controller Halaman
- Buat file **Pages.php** pada **app/Controllers**.
- Masukkan perintah berikut.
    
    ```
    <?php

    namespace App\Controllers;

    class Pages extends BaseController
    {
        public function index()
        {
            return view('welcome_message');
        }

        public function view($page = 'home')
        {
            // ...
        }
    }
    ```
#### Buat tampilan
- Buat file **header.php** pada folder **app/Views/templates**.
- Masukkan perintah berikut.
    
    ```
    <!doctype html>
    <html>
    <head>
        <title>CodeIgniter Tutorial</title>
    </head>
    <body>

        <h1><?= esc($title) ?></h1>
    ```
- Buat file **footer.php** pada folder **app/Views/templates**.
- Masukkan perintah berikut.
    
    ```
    <em>&copy; 2022</em>
    </body>
    </html>
    ```
#### Menambahkan Logika ke Controller
- Buat file **home.php** dan **about.php** pada folder **app/Views/pages**.
- Masukkan perintah ini didalam **app/Controllers/Pages.php**.
    
    ```
    <?php

    namespace App\Controllers;

    use CodeIgniter\Exceptions\PageNotFoundException; // Add this line

    class Pages extends BaseController
    {
        // ...

        public function view($page = 'home')
        {
            if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                throw new PageNotFoundException($page);
            }

            $data['title'] = ucfirst($page); // Capitalize the first letter

            return view('templates/header', $data)
                . view('pages/' . $page)
                . view('templates/footer');
        }
    }
    ```
- Coba akses **localhost:8080/home** melalui browser. Maka akan diarahkan ke method **view()**, controller **Pages**.

### New Section (Bagian Berita)
#### Membuat Database
- Buat database dengan nama **ci4tutorial** dan jalankan perintah SQL dibawah ini.
    ```
    CREATE TABLE news (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        title VARCHAR(128) NOT NULL,
        slug VARCHAR(128) NOT NULL,
        body TEXT NOT NULL,
        PRIMARY KEY (id),
        UNIQUE slug (slug)
    );
    ```
- Lakukan insert data dengan perintah.
    ```
    INSERT INTO news VALUES
    (1,'Elvis sighted','elvis-sighted','Elvis was sighted at the Podunk internet cafe. It looked like he was writing a CodeIgniter app.'),
    (2,'Say it isn\'t so!','say-it-isnt-so','Scientists conclude that some programmers have a sense of humor.'),
    (3,'Caffeination, Yes!','caffeination-yes','World\'s largest coffee shop open onsite nested coffee shop for staff only.');
    ```
#### Menyambungkan ke Database
- Buka file **.env**.
- Lakukan konfigurasi dengan perintah berikut.
    ```
    database.default.hostname = localhost
    database.default.database = ci4tutorial
    database.default.username = root
    database.default.password = 
    database.default.DBDriver = MySQLi
    ```
#### Membuat NewsModel
- Buat file **NewsModel.php** pada folder **app/Models**.
- Masukkan perintah berikut.
    
    ```
    <?php

    namespace App\Models;

    use CodeIgniter\Model;

    class NewsModel extends Model
    {
        protected $table = 'news';
    }
    ```
- Tambahkan method **getNews()**.
- Masukkan perintah berikut.
    
    ```
    public function getNews($slug = false)
        {
            if ($slug === false) {
                return $this->findAll();
            }

            return $this->where(['slug' => $slug])->first();
        }
    ```
#### Menambahkan Aturan Perutean (Routing)
- Buka file **app/Config/Routes.php**.
- Tambahkan perintah berikut.
    
    ```
    <?php

    // ...

    use App\Controllers\News; // Add this line
    use App\Controllers\Pages;

    $routes->get('news', [News::class, 'index']);           // Add this line
    $routes->get('news/(:segment)', [News::class, 'show']); // Add this line

    $routes->get('pages', [Pages::class, 'index']);
    $routes->get('(:segment)', [Pages::class, 'view']);
    ```
#### Membuat Controller News
- Buat file **News.php** pada folder **app/Controllers**.
- Masukkan perintah berikut.
    
    ```
    <?php

    namespace App\Controllers;

    use App\Models\NewsModel;

    class News extends BaseController
    {
        public function index()
        {
            $model = model(NewsModel::class);

            $data['news'] = $model->getNews();
        }

        public function show($slug = null)
        {
            $model = model(NewsModel::class);

            $data['news'] = $model->getNews($slug);
        }
    }
    ```
#### Lengkapi Method index()
- Tambahkan perintah berikut pada method **index()** di class **News**.
    
    ```
    <?php

    namespace App\Controllers;

    use App\Models\NewsModel;

    class News extends BaseController
    {
        public function index()
        {
            $model = model(NewsModel::class);

            $data = [
                'news'  => $model->getNews(),
                'title' => 'News archive',
            ];

            return view('templates/header', $data)
                . view('news/index')
                . view('templates/footer');
        }

        // ...
    }
    ```
#### Buat Tampilan News
- Buat folder **news** dan file **index.php** pada folder **app/Views**.
- Masukkan perintah ini didalam file **index.php**.
    
    ```
    <h2><?= esc($title) ?></h2>

    <?php if (! empty($news) && is_array($news)): ?>

        <?php foreach ($news as $news_item): ?>

            <h3><?= esc($news_item['title']) ?></h3>

            <div class="main">
                <?= esc($news_item['body']) ?>
            </div>
            <p><a href="/news/<?= esc($news_item['slug'], 'url') ?>">View article</a></p>

        <?php endforeach ?>

    <?php else: ?>

        <h3>No News</h3>

        <p>Unable to find any news for you.</p>

    <?php endif ?>
    ```
#### Lengkapi Method show()
- Buka file **app/Controllers/News.php**.
- Masukkan perintah berikut.
    
    ```
    <?php

    namespace App\Controllers;

    use App\Models\NewsModel;
    use CodeIgniter\Exceptions\PageNotFoundException;

    class News extends BaseController
    {
        // ...

        public function show($slug = null)
        {
            $model = model(NewsModel::class);

            $data['news'] = $model->getNews($slug);

            if (empty($data['news'])) {
                throw new PageNotFoundException('Cannot find the news item: ' . $slug);
            }

            $data['title'] = $data['news']['title'];

            return view('templates/header', $data)
                . view('news/view')
                . view('templates/footer');
        }
    }
    ```
#### Buat File view
- Buat file **view.php** pada folder **app/Views/news**.
- Masukkan perintah berikut.
    
    ```
    <h2><?= esc($news['title']) ?></h2>
    <p><?= esc($news['body']) ?></p>
    ```
- Arahkan ke **localhost:8080/news** pada browser. Maka akan ditampilkan daftar item berita, yang masing-masing memiliki tautan untuk menampilkan satu artikel.

### Buat Item News
#### Aktifkan Filter CSRF
- Buka file **app/Config/Filters.php**.
- Perbarui **$methods** dengan perintah berikut.
    
    ```
    <?php

    namespace Config;

    use CodeIgniter\Config\BaseConfig;

    class Filters extends BaseConfig
    {
        // ...

        public $methods = [
            'post' => ['csrf'],
        ];

        // ...
    }
    ```
#### Menambahkan Aturan Perutean (Routing)
- Tambahkan perintah berikut kedalam **app/Config/Routes.php**.
    
    ```
    <?php

    // ...

    use App\Controllers\News;
    use App\Controllers\Pages;

    $routes->get('news', [News::class, 'index']);
    $routes->get('news/new', [News::class, 'new']); // Add this line
    $routes->post('news', [News::class, 'create']); // Add this line
    $routes->get('news/(:segment)', [News::class, 'show']);

    $routes->get('pages', [Pages::class, 'index']);
    $routes->get('(:segment)', [Pages::class, 'view']);
    ```
#### Buat create.php
- Buat file **create.php** di folder **app/Views/news** dengan perintah berikut.
    
    ```
    <h2><?= esc($title) ?></h2>

    <?= session()->getFlashdata('error') ?>
    <?= validation_list_errors() ?>

    <form action="/news" method="post">
        <?= csrf_field() ?>

        <label for="title">Title</label>
        <input type="input" name="title" value="<?= set_value('title') ?>">
        <br>

        <label for="body">Text</label>
        <textarea name="body" cols="45" rows="4"><?= set_value('body') ?></textarea>
        <br>

        <input type="submit" name="submit" value="Create news item">
    </form>
    ```
#### Menambahkan Method new() 
- Tambahkan perintah berikut di **app/Controllers/News.php**.
    
    ```
    <?php

    namespace App\Controllers;

    use App\Models\NewsModel;
    use CodeIgniter\Exceptions\PageNotFoundException;

    class News extends BaseController
    {
        // ...

        public function new()
        {
            helper('form');

            return view('templates/header', ['title' => 'Create a news item'])
                . view('news/create')
                . view('templates/footer');
        }
    }
    ```
#### Menambahkan Method create()
- Tambahkan perintah berikut di **app/Controllers/News.php**.
    
    ```
    <?php

    namespace App\Controllers;

    use App\Models\NewsModel;
    use CodeIgniter\Exceptions\PageNotFoundException;

    class News extends BaseController
    {
        // ...

        public function create()
        {
            helper('form');

            $data = $this->request->getPost(['title', 'body']);

            // Checks whether the submitted data passed the validation rules.
            if (! $this->validateData($data, [
                'title' => 'required|max_length[255]|min_length[3]',
                'body'  => 'required|max_length[5000]|min_length[10]',
            ])) {
                // The validation fails, so returns the form.
                return $this->new();
            }

            // Gets the validated data.
            $post = $this->validator->getValidated();

            $model = model(NewsModel::class);

            $model->save([
                'title' => $post['title'],
                'slug'  => url_title($post['title'], '-', true),
                'body'  => $post['body'],
            ]);

            return view('templates/header', ['title' => 'Create a news item'])
                . view('news/success')
                . view('templates/footer');
        }
    }
    ```
#### Return Halaman Sukses
- Buat file **success.php** pada folder **app/Views/news** dengan perintah berikut ini.
    
    ```
    <p>News item created successfully.</p>
    ```
#### Pembaruan NewsModel
- Buka file **app>Models>NewsModel**.
- Tambahkan perintah berikut ini.
    
    ```
    <?php

    namespace App\Models;

    use CodeIgniter\Model;

    class NewsModel extends Model
    {
        protected $table = 'news';

        protected $allowedFields = ['title', 'slug', 'body'];
    }
    ```
Arahkan ke **localhost:8080/news/new** melalui browser. Coba tambahkan beberapa berita.

## Overview CodeIgniter4
### Struktur Aplikasi
#### Direktori default
Instalasi baru memiliki lima direktori yaitu **app/, public/, writable/, tests/, vendor/, system/**. Masing-masing direktori memiliki peran yang sangat spesifik.

**App**

Direktori **app** merupakan tempat semua kode aplikasi berada.

**Public**

Direktori **public** berisi semua file yang dapat diakses oleh pengguna atau user menggunakan web server.

**Writable**

Direktori **writable** digunakan untuk menyimpan data yang mungkin memerlukan akses tulis.

**Test**

Direktori **test** berisi file yang berhubungan dengan pengujian suatu aplikasi.

**Vendor**

Direktori **vendor** berisi file yang digunakan framework.

### Models, Views dan Controllers

MVC adalah sebuah pola arsitektur dalam membuat sebuah aplikasi dengan cara memisahkan kode menjadi tiga bagian (Models, Views, Models).

**Models** bagian yang bertugas untuk menyiapkan, mengatur, memanipulasi, dan mengorganisasikan data yang ada di database. Models biasanya disimpan dalam **app/Models**.

**Views** bagian yang bertugas untuk menampilkan informasi kepada pengguna. Views biasanya disimpan dalam **app/Views**.

**Controllers** bagian yang bertugas untuk menghubungkan serta mengatur model dan view agar dapat saling terhubung. Controllers biasanya disimpan di **app/Controllers**.

#### Alur MVC

- Proses pertama adalah view akan meminta data untuk ditampilkan dalam bentuk grafis kepada pengguna.
- Permintaan tersebut diterima oleh controller dan diteruskan ke model untuk diproses.
- Model akan mencari dan mengolah data yang diminta di dalam database
- Setelah data ditemukan dan diolah, model akan mengirimkan data tersebut kepada controller untuk ditampilkan di view.
- Controller akan mengambil data hasil pengolahan model dan mengaturnya di bagian view untuk ditampilkan kepada pengguna.

## Membangun Respons
### Views
Views berupa halaman web atau fragmen halaman seperti header, footer, sidebar, dll.
#### Membuat Views
- Buat file **blog_view.php** didalam folder **app/Views** dan isi dengan perintah berikut.
    
    ```
    <html>
        <head>
            <title>My Blog</title>
        </head>
        <body>
            <h1>Welcome to my Blog!</h1>
        </body>
    </html>
    ```
#### Menampilkan Views
- Buat file **Blog.php** di folder **app/Controllers** dan isi dengan perintah berikut.
    
    ```
    <?php

    namespace App\Controllers;

    class Blog extends BaseController
    {
        public function index()
        {
            return view('blog_view');
        }
    }
    ```

## Helpers
### Date Helpers
Date Helpers berisi fungsi yang membantu dalam bekerja dengan tanggal. Date Helper ini dimuat menggunakan perintah berikut.
```
<?php

helper('date');
```
Contoh :
- Buat file **test.php** di folder **app/Views** dan tambahkan kode berikut.
    
    ```
    echo date('Y-M-d H:i:s', now('Asia/Jakarta'));
    ```
- Buat file **Test.php** di folder **app/Controllers** dan isi dengan perintah berikut.
    
    ```
    <?php

    namespace App\Controllers;

    //controllers
    class Test extends BaseController
    {
        // method
        public function index(): string
        {   
            return view('test');
        }
    }

    ```
- Lakukan perutean di **app/Config/Routes.php** dengan Menambahkan perintah berikut.
```
use App\Controllers\Test;

$routes->get('test', [Test::class, 'index']);
```
Untuk mengeceknya buka di **localhost:8080/test**.
### Number Helpers
Number Helpers berisi fungsi yang membantu bekerja dengan data numerik. Number Helpers ini dimuat menggunakan perintah berikut.
```
<?php

helper('number');
```
Contoh :
- Tambahkan kode berikut di file **app/Views/test.php**.
    
    ```
    echo number_to_size(456); // Returns 456 Bytes
    echo number_to_size(4567); // Returns 4.5 KB
    echo number_to_size(45678); // Returns 44.6 KB
    echo number_to_size(456789); // Returns 447.8 KB
    echo number_to_size(3456789); // Returns 3.3 MB
    echo number_to_size(12345678912345); // Returns 1.8 GB
    echo number_to_size(123456789123456789); // Returns 11,228.3 TB

    echo number_to_roman(23);    // Returns XXIII
    echo number_to_roman(324);   // Returns CCCXXIV
    echo number_to_roman(2534);  // Returns MMDXXXIV
    ```
Untuk mengeceknya buka di **localhost:8080/test**.
