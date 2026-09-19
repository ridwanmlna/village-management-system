**# Village Management System**

Village Management System merupakan aplikasi berbasis web yang digunakan untuk membantu pengelolaan pelayanan administrasi desa, seperti pengelolaan data warga, pelayanan surat, pengajuan layanan, antrean, pengaduan, serta rekapitulasi surat.

Aplikasi ini dikembangkan menggunakan framework Laravel dan database MySQL.

**## Fitur**

\* Login dan autentikasi pengguna

\* Dashboard

\* Manajemen data warga desa

\* Pencarian data warga berdasarkan NIK

\* Pembuatan surat administrasi desa

\* Pengelolaan pengajuan layanan

\* Pengelolaan antrean pelayanan

\* Pengelolaan pengaduan masyarakat

\* Rekapitulasi pembuatan surat

\* Cetak surat

\* Cetak ulang surat

\* Download rekapitulasi surat dalam format PDF

\* Notifikasi pengguna

**## Teknologi yang Digunakan**

\* Laravel

\* PHP

\* MySQL

\* Blade

\* JavaScript

\* AdminLTE

\* Bootstrap

**## Persyaratan**

\* Git

\* Composer

\* Web Server (Apache/XAMPP)

\* PHP ^8.1

\* MySQL

\* Node.js dan NPM

**## Langkah - Langkah Instalasi**

**### 1. Clone Repository**

\`\`\`bash

git clone [https://github.com/ridwanmlna/village-management-system.git](https://github.com/ridwanmlna/village-management-system.git)

\`\`\`

**### 2. Masuk ke Folder Project**

\`\`\`bash

cd village-management-system

\`\`\`

**### 3. Install Dependency**

\`\`\`bash

composer install

\`\`\`

**### 4. Buat File Environment**

Untuk PowerShell:

\`\`\`powershell

Copy-Item .env.example .env

\`\`\`

**### 5. Generate Application Key**

\`\`\`bash

php artisan key\:generate

\`\`\`

**### 6. Buat Database**

Buat database dengan nama:

\`\`\`text

e_desa

\`\`\`

Kemudian sesuaikan konfigurasi database pada file \`.env\`:

\`\`\`env

DB_DATABASE=e_desa

DB_USERNAME=root

DB_PASSWORD=

\`\`\`

Import database dari:

\`\`\`text

\_db/e_desa.sql

\`\`\`

**### 7. Jalankan Server**

\`\`\`bash

php artisan serve

\`\`\`

Aplikasi dapat diakses melalui:

\`\`\`text

[http://127.0.0.1:8000](http://127.0.0.1:8000)

\`\`\`

Untuk menjalankan asset frontend:

\`\`\`bash

npm run dev

\`\`\`

**## Developer**

**\*\*Ridwan Maulana\*\***

Bachelor of Information Technology

ITB STIKOM Bali