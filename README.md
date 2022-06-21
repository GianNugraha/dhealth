## Test D'Health

Instalasi :

- Download / Clone file project dengan url yang tersedia,
- Siapkan / Buat Database (Mysql) kosong dengan nama "test_dhealth",
- setelah itu, buka terminal (gitbash/CMD/via VS code terminal) lalu arahkan ke alamat folder project tersebut,
- Kemudian jalankan perintah "php artisan migrate".
- lalu. jalankan perintah "php artisan db:seed --class=UserSeeder" ,
- jalankan perintah "php artisan db:seed --class=SignaSeeder",
- jalankan perintah "php artisan db:seed --class=ObatSeeder",
- lalu jalankan perintah "php artisan serve" untuk running aplikasi.


Feature :

- Auth :
 > Register 
 > Login : sudah tersedia juga akun {(username:user1 , password:user1), (username:user2, password:user2)}
- Obat :
 > Create Obat
 > Read Obat By User id, 
 > Read Detail Obat
- Resep (dari beberapa obat) :
 > Create Resep
 > Read By User ID, 
 > Read Detail Resep
- Read Master Obat
- Read Master Signa
- Read Daftar Seluruh Daftar Pesanan Obat & Resep by User ID


# dhealth
