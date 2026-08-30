# Database Schema Documentation — Editing v2

> **Project:** `editing-v2`  
> **Framework:** Laravel 10.x (PHP 8.1+)  
> **Database:** MySQL (charset: `utf8mb4`)  
> **Auth Driver:** Session-based multi-guard (users, admins, mentors, editors)  
> **API Tokens:** Laravel Sanctum  

---

## 📋 Ringkasan Skema Database

| No | Nama Tabel | Primary Key | Deskripsi | Sumber |
|----|-----------|-------------|-----------|--------|
| 1 | `users` | `id` | Pengguna umum (default Laravel) | Model `User` |
| 2 | `tbl_admins` | `id_admin` | Admin sistem | Model `Admin` |
| 3 | `tbl_clients` | `id_clients` | Klien/pelanggan | Model `Client` |
| 4 | `tbl_editors` | `id_editors` | Editor essay | Model `Editor` |
| 5 | `tbl_mentors` | `id_mentors` | Mentor | Model `Mentor` |
| 6 | `tbl_categories` | `id_category` | Kategori program | Model `Category` |
| 7 | `tbl_programs` | `id_program` | Program editing | Model `Programs` |
| 8 | `tbl_universities` | `id_univ` | Daftar universitas | Model `University` |
| 9 | `tbl_status` | `id` | Status essay | Model `Status` |
| 10 | `tbl_tags` | `id_topic` | Tag topik essay | Model `Tags` |
| 11 | `tbl_token` | email | Token verifikasi email | Model `Token` |
| 12 | `tbl_position_editors` | `id_position` | Posisi/jabatan editor | Model `PositionEditor` |
| 13 | `tbl_essay_clients` | `id_essay_clients` | Essay assignment klien | Model `EssayClients` |
| 14 | `tbl_essay_editors` | `id_essay_editors` | Essay assignment editor | Model `EssayEditors` |
| 15 | `tbl_essay_feedback` | `id` | Feedback rubrik essay | Model `EssayFeedbacks` |
| 16 | `tbl_essay_prompt` | `id_essay_prompt` | Database essay prompt | Model `EssayPrompts` |
| 17 | `tbl_essay_reject` | `id` | Log penolakan essay | Model `EssayReject` |
| 18 | `tbl_essay_revise` | `id` | Log revisi essay | Model `EssayRevise` |
| 19 | `tbl_essay_status` | `id` | Histori status essay | Model `EssayStatus` |
| 20 | `tbl_essay_tags` | `id` | Pivot tag untuk essay | Model `EssayTags` |
| 21 | `tbl_managing_feedback` | `id` | Feedback managing editor | Model `ManagingFeedback` |
| 22 | `tbl_work_duration` | `id` | Durasi kerja editor | Model `WorkDuration` |
| 23 | `password_resets` | `email` | Token reset password | Migrasi Laravel standar |
| 24 | `personal_access_tokens` | `id` | Token Sanctum | Migrasi Laravel standar |
| 25 | `failed_jobs` | `id` | Queue job gagal | Migrasi Laravel standar |
| 26 | `migrations` | `id` | Migration tracker | Laravel bawaan |

---

## 🗄️ Migration Files

> Hanya ada **2 file migrasi** di `database/migrations/`. Keduanya adalah migrasi **aditif** (`add_` prefix) yang memodifikasi tabel yang sudah ada. Migrasi untuk tabel dasar tidak ada di proyek ini.

### `2023_01_04_164931_add_notes_managing_to_tbl_essay_editors.php`

Menambahkan kolom ke tabel `tbl_essay_editors` (setelah `notes_editors`):

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| `notes_managing` | text | Catatan dari managing editor |

### `2023_01_11_172147_add_essay_notes_to_tbl_essay_clients.php`

Menambahkan kolom ke tabel `tbl_essay_clients` (setelah `essay_prompt`):

| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| `essay_notes` | text | Catatan tambahan untuk essay |

---

## 🗄️ Tabel Standar Laravel

### `users` / `password_resets` / `personal_access_tokens` / `failed_jobs`

| Tabel | Kolom | Tipe | Atribut | Deskripsi |
|-------|-------|------|---------|-----------|
| `users` | `id` | bigint unsigned | AUTO_INCREMENT, PK | ID unik |
| `users` | `name` | varchar(255) | — | Nama lengkap |
| `users` | `email` | varchar(255) | UNIQUE | Email |
| `users` | `email_verified_at` | timestamp | nullable | Verifikasi email |
| `users` | `password` | varchar(255) | — | Password hash |
| `users` | `remember_token` | varchar(100) | nullable | Token remember |
| `users` | `created_at`/`updated_at` | timestamp | — | Timestamps |
| `password_resets` | `email` | varchar(255) | PRIMARY KEY | Email user |
| `password_resets` | `token` | varchar(255) | — | Token reset |
| `password_resets` | `created_at` | timestamp | nullable | Waktu dibuat |
| `personal_access_tokens` | `id` | bigint unsigned | AUTO_INCREMENT, PK | ID token |
| `personal_access_tokens` | `tokenable_type` | varchar(255) | — | Polymorphic type |
| `personal_access_tokens` | `tokenable_id` | bigint unsigned | — | Polymorphic ID |
| `personal_access_tokens` | `name` | varchar(255) | — | Nama token |
| `personal_access_tokens` | `token` | varchar(255) | UNIQUE | Token hash |
| `personal_access_tokens` | `abilities` | text | nullable | JSON kemampuan |
| `personal_access_tokens` | `last_used_at`/`expires_at` | timestamp | nullable | Waktu pakai/kadaluarsa |
| `failed_jobs` | `id` | bigint unsigned | AUTO_INCREMENT, PK | ID |
| `failed_jobs` | `uuid` | varchar(255) | UNIQUE | UUID job |
| `failed_jobs` | `connection`/`queue` | text | — | Koneksi/antrian |
| `failed_jobs` | `payload` | longText | — | Payload JSON |
| `failed_jobs` | `exception` | longText | — | Exception trace |
| `failed_jobs` | `failed_at` | timestamp | DEFAULT CURRENT_TIMESTAMP | Kapan gagal |

---

## 🗄️ Tabel Aplikasi (Auth Layer)

> ⚠️ **Catatan:** Tabel-tabel berikut **tidak memiliki file migrasi**. Skema diinfer dari Model Eloquent. Kolom `deleted_at` ada di beberapa tabel tetapi **trait `SoftDeletes` tidak dipakai** — kolom dikelola manual.

### `tbl_admins`

> Model: `App\Models\Admin` extends `Authenticatable` | Guard: `web-admin` | Timestamps: aktif | Auto-increment: aktif

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id_admin` | bigint unsigned | AUTO_INCREMENT, PK | ID unik admin |
| `full_name` | varchar(255) | — | Nama lengkap |
| `email` | varchar(255) | UNIQUE | Email admin |
| `address` | text | nullable | Alamat |
| `role` | string | — | Peran admin |
| `status` | string | — | Status akun |
| `password` | varchar(255) | — | Password yang di-hash |
| `created_at` / `updated_at` | timestamp | — | Standar Laravel timestamps |

### `tbl_clients`

> Model: `App\Models\Client` | Timestamps: **tidak aktif** | Auto-increment: **tidak aktif** (`$incrementing = false`)

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id_clients` | char/uuid | PK (non-increment) | ID unik client |
| `first_name` | varchar(255) | — | Nama depan |
| `last_name` | varchar(255) | — | Nama belakang |
| `phone` | varchar(255) | nullable | Nomor telepon |
| `email` | varchar(255) | — | Email |
| `birthdate` | date | nullable | Tanggal lahir |
| `country` | varchar(255) | nullable | Negara |
| `state` | varchar(255) | nullable | Provinsi |
| `city` | varchar(255) | nullable | Kota |
| `postal_code` | varchar(255) | nullable | Kode pos |
| `address` | text | nullable | Alamat |
| `id_mentor` | char/uuid | nullable, FK → mentors | Mentor utama |
| `id_mentor_2` | char/uuid | nullable, FK → mentors | Mentor kedua |
| `current_school` | varchar(255) | nullable | Sekolah saat ini |
| `school_name` | varchar(255) | nullable | Nama sekolah |
| `curriculum` | varchar(255) | nullable | Kurikulum |
| `year` | varchar(255) | nullable | Tahun angkatan |
| `image` | varchar(255) | nullable | Path foto profil |
| `personal_brand` | text | nullable | Brand pribadi |
| `interests` | text | nullable | Minat (JSON) |
| `personalities` | text | nullable | Kepribadian (JSON) |
| `resume` | text | nullable | Resume/CV |
| `questionnaire` | text | nullable | Jawaban kuisioner |
| `others` | text | nullable | Info lainnya |
| `role` | string | — | Peran client |
| `status` | string | — | Status akun |
| `password` | varchar(255) | — | Password hash |
| `created_at` | timestamp | — | Waktu dibuat |
| `updated_at` | timestamp | — | Waktu diupdate |
| `deleted_at` | timestamp | nullable | Waktu dihapus (manual) |

**Relasi `tbl_clients`:**
- `belongsTo(Mentor::class, 'id_mentor', 'id_mentors')` — mentor utama
- `belongsTo(Mentor::class, 'id_mentor_2', 'id_mentors')` — mentor kedua
- `hasMany(EssayClients::class, 'id_clients', 'id_clients')`
- `hasMany(EssayClients::class, 'email', 'email')` — via email

### `tbl_editors`

> Model: `App\Models\Editor` extends `Authenticatable` | Guard: `web-editor` | Timestamps: aktif | Auto-increment: **tidak aktif**

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id_editors` | char/uuid | PK (non-increment) | ID unik editor |
| `first_name` | varchar(255) | — | Nama depan |
| `last_name` | varchar(255) | — | Nama belakang |
| `phone` | varchar(255) | — | Nomor telepon |
| `email` | varchar(255) | — | Email |
| `graduated_from` | varchar(255) | — | Lulusan dari |
| `major` | varchar(255) | — | Jurusan |
| `address` | text | — | Alamat |
| `about_me` | text | — | Tentang saya |
| `position` | string | nullable, FK → `tbl_position_editors.id_position` | Posisi editor |
| `image` | varchar(255) | nullable | Path foto |
| `hours` | integer | — | Jam kerja tersedia |
| `average_rating` | decimal | — | Rating rata-rata |
| `status` | string | — | Status |
| `password` | varchar(255) | — | Password hash |
| `created_at` / `updated_at` | timestamp | — | Standar Laravel timestamps |

**Relasi `tbl_editors`:**
- `hasMany(EssayClients::class, 'id_editors', 'id_editors')`
- `belongsTo(PositionEditor::class, 'position', 'id_position')`
- `hasMany(EssayEditors::class, 'editors_mail', 'email')`

### `tbl_mentors`

> Model: `App\Models\Mentor` extends `Authenticatable` | Guard: `web-mentor` | Timestamps: aktif | Auto-increment: **tidak aktif**

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id_mentors` | char/uuid | PK (non-increment) | ID unik mentor |
| `first_name` | varchar(255) | — | Nama depan |
| `last_name` | varchar(255) | — | Nama belakang |
| `phone` | varchar(255) | — | Nomor telepon |
| `email` | varchar(255) | — | Email |
| `graduated_from` | varchar(255) | — | Lulusan dari |
| `address` | text | — | Alamat |
| `is_mentor` | boolean | — | Apakah aktif sebagai mentor |
| `status` | string | — | Status |
| `password` | varchar(255) | — | Password hash |
| `created_at` / `updated_at` | timestamp | — | Standar Laravel timestamps |

**Relasi `tbl_mentors`:**
- `hasMany(Client::class, 'id_mentor', 'id_mentors')` — klien utama
- `hasMany(Client::class, 'id_mentor_2', 'id_mentors')` — klien kedua
- `hasMany(EssayClients::class, 'mentors_mail', 'email')` — essay via email

---

## 🗄️ Tabel Aplikasi (Referensi)

### `tbl_categories`

> Model: `App\Models\Category` | Timestamps: aktif

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id_category` | bigint unsigned | AUTO_INCREMENT, PK | ID unik kategori |
| `category_name` | varchar(255) | — | Nama kategori |
| `created_at` / `updated_at` | timestamp | — | Standar Laravel timestamps |

**Relasi:** `hasMany(Programs::class, 'id_category', 'id_category')`

### `tbl_programs`

> Model: `App\Models\Programs` | Timestamps: aktif | Kolom `deleted_at` ada (manual)

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id_program` | bigint unsigned | AUTO_INCREMENT, PK | ID unik program |
| `program_name` | varchar(255) | — | Nama program |
| `description` | text | nullable | Deskripsi |
| `price` | decimal | — | Harga |
| `discount` | decimal | nullable | Diskon |
| `minimum_word` | integer | — | Kata minimum essay |
| `maximum_word` | integer | — | Kata maksimum essay |
| `completed_within` | integer | — | Durasi penyelesaian (hari) |
| `images` | text | nullable | Path gambar |
| `status` | string | — | Status |
| `id_category` | bigint unsigned | nullable, FK → `tbl_categories` | Kategori |
| `created_at` | timestamp | — | |
| `updated_at` | timestamp | — | |
| `deleted_at` | timestamp | nullable | |

**Relasi:**
- `hasMany(EssayClients::class, 'id_program', 'id_program')`
- `belongsTo(Category::class, 'id_category', 'id_category')`

### `tbl_universities`

> Model: `App\Models\University` | Timestamps: aktif | Kolom `deleted_at` ada (manual)

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id_univ` | bigint unsigned | AUTO_INCREMENT, PK | ID unik universitas |
| `university_name` | varchar(255) | — | Nama universitas |
| `website` | varchar(255) | nullable | Website universitas |
| `univ_email` | varchar(255) | nullable | Email resmi |
| `phone` | varchar(255) | nullable | No. telepon |
| `photo` | varchar(255) | nullable | Path foto |
| `address` | text | nullable | Alamat |
| `country` | varchar(255) | nullable | Negara |
| `status` | string | — | Status |
| `created_at` | timestamp | — | |
| `updated_at` | timestamp | — | |
| `deleted_at` | timestamp | nullable | |

**Relasi:** `hasMany(EssayClients::class, 'id_univ', 'id_univ')`

**Accessor:** `getWebsiteAttribute`, `getPhoneAttribute`, `getAddressAttribute` — mengembalikan `"-"` jika NULL.

### `tbl_status`

> Model: `App\Models\Status` | Timestamps: aktif | Auto-increment: **tidak aktif**

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id` | char/uuid | PK (non-increment) | ID status (kemungkinan enum/string) |
| `status_title` | varchar(255) | — | Judul status |
| `status_desc` | text | nullable | Deskripsi status |
| `by` | string | nullable | Dibuat oleh |
| `created_at` / `updated_at` | timestamp | — | Standar Laravel timestamps |

**Relasi:**
- `hasMany(EssayClients::class, 'status_essay_clients', 'id')`
- `hasMany(EssayEditors::class, 'status_essay_editors', 'id')`

### `tbl_tags`

> Model: `App\Models\Tags` | Timestamps: **tidak aktif**

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id_topic` | bigint unsigned | AUTO_INCREMENT, PK | ID unik tag |
| `topic_name` | varchar(255) | — | Nama topik |

### `tbl_token`

> Model: `App\Models\Token` | Timestamps: **tidak aktif**

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `email` | varchar(255) | — | Email user |
| `token` | varchar(255) | — | Token verifikasi |
| `activated_at` | timestamp | nullable | Kapan diaktifkan |

### `tbl_position_editors`

> Model: `App\Models\PositionEditor` | Timestamps: aktif | Auto-increment: **tidak aktif**

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id_position` | char | PK (non-increment) | ID posisi |
| `position_name` | varchar(255) | — | Nama posisi |
| `created_at` / `updated_at` | timestamp | — | Standar Laravel timestamps |

**Relasi:** `hasMany(Editor::class, 'id_position', 'position')`

---

## 🗄️ Tabel Aplikasi (Essay Management)

### `tbl_essay_clients`

> Model: `App\Models\EssayClients` | Timestamps: **tidak aktif** | Auto-increment: aktif

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id_essay_clients` | bigint unsigned | AUTO_INCREMENT, PK | ID unik essay assignment |
| `id_transaction` | string | — | ID transaksi |
| `id_program` | bigint unsigned | nullable, FK → `tbl_programs.id_program` | Program |
| `id_univ` | bigint unsigned | nullable, FK → `tbl_universities.id_univ` | Universitas |
| `id_editors` | char/uuid | nullable, FK → `tbl_editors.id_editors` | Editor yang ditugaskan |
| `essay_title` | varchar(255) | — | Judul essay |
| `essay_prompt` | text | — | Prompt essay |
| `essay_notes` | text | nullable | Catatan essay (ditambahkan migrasi) |
| `id_clients` | char/uuid | nullable, FK → `tbl_clients.id_clients` | ID client |
| `email` | varchar(255) | — | Email client (juga FK ke clients) |
| `mentors_mail` | varchar(255) | nullable, FK → `tbl_mentors.email` | Email mentor |
| `essay_deadline` | date | nullable | Deadline essay |
| `application_deadline` | date | nullable | Deadline aplikasi |
| `number_of_words` | integer | — | Jumlah kata |
| `attached_of_clients` | text | nullable | File yang dilampirkan client |
| `notes_clients` | text | nullable | Catatan dari client |
| `essay_rating` | decimal | nullable | Rating essay |
| `status_essay_clients` | string | — | Status essay (FK ke `tbl_status.id`) |
| `status_read` | string | nullable | Status baca (admin) |
| `status_read_editor` | string | nullable | Status baca (editor) |
| `uploaded_at` | timestamp | nullable | Kapan di-upload |
| `completed_at` | timestamp | nullable | Kapan selesai |

**Relasi `tbl_essay_clients`:**
- `belongsTo(Editor::class, 'id_editors', 'id_editors')`
- `belongsTo(Mentor::class, 'mentors_mail', 'email')`
- `belongsTo(University::class, 'id_univ', 'id_univ')`
- `belongsTo(Programs::class, 'id_program', 'id_program')`
- `belongsTo(Client::class, 'id_clients')` — via id_clients
- `belongsTo(Client::class, 'email', 'email')` — via email
- `belongsTo(Status::class, 'status_essay_clients', 'id')`
- `belongsTo(EssayEditors::class, 'id_essay_clients', 'id_essay_clients')`
- `belongsTo(EssayFeedbacks::class, 'id_essay_clients', 'id_essay_clients')`
- `belongsTo(EssayTags::class, 'id_essay_clients', 'id_essay_clients')`

**Accessor:** `getEssayNotesAttribute()` — mengembalikan `"There's no essay notes"` jika NULL.

### `tbl_essay_editors`

> Model: `App\Models\EssayEditors` | Timestamps: **tidak aktif** | Auto-increment: **tidak aktif**

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id_essay_editors` | char/uuid | PK (non-increment) | ID unik essay-editor |
| `id_essay_clients` | bigint unsigned | nullable, FK → `tbl_essay_clients.id_essay_clients` | Essay yang dikerjakan |
| `editors_mail` | varchar(255) | nullable, FK → `tbl_editors.email` | Email editor |
| `attached_of_editors` | text | nullable | File yang dilampirkan editor |
| `managing_file` | text | nullable | File managing editor |
| `work_duration` | text | nullable | Durasi kerja |
| `notes_editors` | text | nullable | Catatan editor |
| `notes_managing` | text | nullable | Catatan managing (ditambahkan migrasi) |
| `status_essay_editors` | string | — | Status (FK → `tbl_status.id`) |
| `read` | string | nullable | Status baca |
| `uploaded_at` | timestamp | nullable | Kapan di-upload |

**Relasi `tbl_essay_editors`:**
- `belongsTo(Status::class, 'status_essay_editors', 'id')`
- `belongsTo(EssayClients::class, 'id_essay_clients', 'id_essay_clients')`
- `hasMany(WorkDuration::class, 'id_essay_editors', 'id_essay_editors')`
- `belongsTo(Editor::class, 'editors_mail', 'email')`

### `tbl_essay_feedback`

> Model: `App\Models\EssayFeedbacks` | Timestamps: **tidak aktif** | Auto-increment: **tidak aktif** | PK: `id`

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id` | char/uuid | PK (non-increment) | ID unik feedback |
| `id_essay_clients` | bigint unsigned | nullable, FK → `tbl_essay_clients.id_essay_clients` | Essay yang diberi feedback |
| `option1` | text | nullable | Rubrik 1 |
| `option2` | text | nullable | Rubrik 2 |
| `option3` | text | nullable | Rubrik 3 |
| `option4` | text | nullable | Rubrik 4 |
| `option5` | text | nullable | Rubrik 5 |
| `option6` | text | nullable | Rubrik 6 |
| `add_comments` | text | nullable | Komentar tambahan |
| `created_at` | timestamp | — | |

**Relasi:** `belongsTo(EssayClients::class, 'id_essay_clients', 'id_essay_clients')`

### `tbl_essay_prompt`

> Model: `App\Models\EssayPrompts` | Timestamps: aktif | Kolom `deleted_at` ada (manual)

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id_essay_prompt` | bigint unsigned | AUTO_INCREMENT, PK | ID unik prompt |
| `id_univ` | bigint unsigned | nullable, FK → `tbl_universities.id_univ` | Universitas |
| `title` | varchar(255) | — | Judul prompt |
| `description` | text | nullable | Deskripsi |
| `notes` | text | nullable | Catatan |
| `status` | string | — | Status |
| `created_at` | timestamp | — | |
| `updated_at` | timestamp | — | |
| `deleted_at` | timestamp | nullable | |

**Relasi:** `belongsTo(University::class, 'id_univ', 'id_univ')`

> ⚠️ `id_univ` ada di relasi tetapi **tidak ada di `$fillable`**.

### `tbl_essay_reject`

> Model: `App\Models\EssayReject` | Timestamps: **tidak aktif** | Auto-increment: **tidak aktif** | PK: `id`

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id` | char/uuid | PK (non-increment) | ID unik |
| `id_essay_clients` | bigint unsigned | nullable, FK → `tbl_essay_clients.id_essay_clients` | Essay yang ditolak |
| `editors_mail` | varchar(255) | — | Email editor |
| `notes` | text | — | Catatan penolakan |
| `created_at` | timestamp | — | |

**Relasi:** `belongsTo(EssayClients::class, 'id_essay_clients', 'id_essay_clients')`

### `tbl_essay_revise`

> Model: `App\Models\EssayRevise` | Timestamps: **tidak aktif** | Auto-increment: **tidak aktif** | PK: `id`

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id` | char/uuid | PK (non-increment) | ID unik |
| `id_essay_clients` | bigint unsigned | nullable, FK → `tbl_essay_clients.id_essay_clients` | Essay yang direvisi |
| `editors_mail` | varchar(255) | — | Email editor |
| `admin_mail` | varchar(255) | — | Email admin |
| `role` | string | — | Peran yang merevisi |
| `notes` | text | — | Catatan revisi |
| `file` | text | nullable | Path file revisi |
| `created_at` | timestamp | — | |

**Relasi:**
- `belongsTo(EssayClients::class, 'id_essay_clients', 'id_essay_clients')`
- `belongsTo(Editor::class, 'admin_mail', 'email')` — managing editor
- `belongsTo(Editor::class, 'editors_mail', 'email')` — editor

### `tbl_essay_status`

> Model: `App\Models\EssayStatus` | Timestamps: **tidak aktif** | Auto-increment: **tidak aktif** | PK: `id`

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id` | char/uuid | PK (non-increment) | ID unik |
| `id_essay_clients` | bigint unsigned | nullable, FK → `tbl_essay_clients.id_essay_clients` | Essay |
| `status` | string | — | Status (FK → `tbl_status.id`) |
| `created_at` | timestamp | — | |

**Relasi:**
- `belongsTo(EssayClients::class, 'id_essay_clients', 'id_essay_clients')`
- `belongsTo(Status::class, 'status', 'id')`
- `belongsTo(Status::class, 'status', 'id')` — `check_status()` duplikat

### `tbl_essay_tags`

> Model: `App\Models\EssayTags` | Timestamps: **tidak aktif** | Auto-increment: **tidak aktif** | PK: `id`

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id` | char/uuid | PK (non-increment) | ID unik |
| `id_essay_clients` | bigint unsigned | nullable, FK → `tbl_essay_clients.id_essay_clients` | Essay |
| `id_topic` | bigint unsigned | FK → `tbl_tags.id_topic` | Topik/tag |

**Relasi:** `belongsTo(Tags::class, 'id_topic', 'id_topic')`

### `tbl_managing_feedback`

> Model: `App\Models\ManagingFeedback` | Timestamps: aktif | Auto-increment: aktif

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id` | bigint unsigned | AUTO_INCREMENT, PK | ID unik |
| `id_essay_editor` | string | — | ID essay editor |
| `feedback` | text | — | Feedback dari managing editor |
| `id_editor` | string | — | ID editor |
| `created_at` | timestamp | — | |

> ⚠️ **Inkonsistensi:** Relasi `essay_editor()` memakai FK `id_essay_editors` yang **tidak ada di `$fillable`**, sedangkan kolom yang ada di fillable adalah `id_essay_editor` (singular). Begitu juga untuk `editor()` yang memakai FK `id_editors` tidak ada di fillable, sedangkan kolom fillable adalah `id_editor` (singular).

**Relasi:**
- `belongsTo(EssayEditors::class, 'id_essay_editors', 'id_essay_editor')` — *mungkin typo*
- `belongsTo(Editor::class, 'id_editors', 'id_editor')` — *mungkin typo*

### `tbl_work_duration`

> Model: `App\Models\WorkDuration` | Timestamps: **tidak aktif** | Auto-increment: **tidak aktif** | PK: `id`

| Kolom | Tipe | Atribut | Deskripsi |
|-------|------|---------|-----------|
| `id` | char/uuid | PK (non-increment) | ID unik |
| `id_essay_editors` | char/uuid | FK → `tbl_essay_editors.id_essay_editors` | Essay editor |
| `status` | string | — | Status durasi kerja |
| `duration` | string | — | Durasi kerja |
| `date` | date | — | Tanggal |

**Relasi:**
- `belongsTo(EssayClients::class, 'id_essay_editors', 'id_essay_editors')` — *mungkin seharusya `belongsTo(EssayEditors::class, ...)`*

> ⚠️ Relasi `work_duration()` di `EssayEditors` merujuk ke `WorkDuration` via `id_essay_editors`, tetapi model `WorkDuration` sendiri merujuk ke `EssayClients` (bukan `EssayEditors`). Ini merupakan potensi inkonsistensi.

---

## 🔗 Hubungan Antar-Tabel (ERD)

```
tbl_clients (id_clients)◄───┐
  ├─FK→ tbl_mentors(id_mentors)  [id_mentor, id_mentor_2]
  └─► tbl_essay_clients(id_essay_clients)
        ├─FK→ tbl_programs(id_program)        [id_program]
        ├─FK→ tbl_universities(id_univ)        [id_univ]
        ├─FK→ tbl_editors(id_editors)          [id_editors]
        ├─FK→ tbl_mentors(email)               [mentors_mail]
        ├─FK→ tbl_status(id)                   [status_essay_clients]
        │
        ├──► tbl_essay_editors(id_essay_editors)
        │      ├─FK→ tbl_essay_clients(id_essay_clients)
        │      ├─FK→ tbl_editors(email)         [editors_mail]
        │      ├─FK→ tbl_status(id)            [status_essay_editors]
        │      └──► tbl_work_duration(id)
        │             FK→ tbl_essay_editors(id_essay_editors)
        │
        ├──► tbl_essay_feedback(id)
        │      FK→ tbl_essay_clients(id_essay_clients)
        │
        ├──► tbl_essay_reject(id)
        │      FK→ tbl_essay_clients(id_essay_clients)
        │      ├─FK→ tbl_editors(email)       [editors_mail]
        │      └─FK→ tbl_editors(email)        [admin_mail]
        │
        ├──► tbl_essay_revise(id)
        │      FK→ tbl_essay_clients(id_essay_clients)
        │      ├─FK→ tbl_editors(email)       [editors_mail]
        │      └─FK→ tbl_editors(email)        [admin_mail]
        │
        ├──► tbl_essay_status(id)
        │      FK→ tbl_essay_clients(id_essay_clients)
        │      ├─FK→ tbl_status(id)           [status]
        │      └──FK→ tbl_status(id)          [check_status()]
        │
        └──► tbl_essay_tags(id)
               FK→ tbl_essay_clients(id_essay_clients)
               FK→ tbl_tags(id_topic)

tbl_categories(id_category)◄─── tbl_programs(id_program)
tbl_position_editors(id_position)◄─── tbl_editors(id_editors)
tbl_managing_feedback(id)
  ├─FK→ tbl_essay_editors  [id_essay_editor]
  └─FK→ tbl_editors        [id_editor]
```

### Multi-Guard Auth

| Guard | Provider | Model | Table |
|-------|----------|--------|-------|
| `web` | `users` | `User` | `users` |
| `web-admin` | `admins` | `Admin` | `tbl_admins` |
| `web-mentor` | `mentors` | `Mentor` | `tbl_mentors` |
| `web-editor` | `editors` | `Editor` | `tbl_editors` |

---

## 📊 Konsep Bisnis

### 1. Multi-Guard Authentication
- Proyek menggunakan **4 guard otentikasi**: `users`, `admins`, `mentors`, `editors`.
- Setiap guard memiliki model dan tabel database sendiri.
- Otentikasi menggunakan **session-based** (bukan JWT/Passport).
- Model `User` menggunakan `Laravel\Sanctum\HasApiTokens` untuk API token.

### 2. Essay Management Workflow
1. **Client** meng-upload essay → `tbl_essay_clients`
2. **Admin** menugaskan **editor** → mengisi `id_editors` di `tbl_essay_clients`
3. **Editor** mengerjakan essay → mencatat di `tbl_essay_editors`
4. **Editor** memberi feedback → `tbl_essay_feedback`
5. Essay dapat **ditolak** (`tbl_essay_reject`) atau **direvisi** (`tbl_essay_revise`)
6. Histori status → `tbl_essay_status`
7. **Managing editor** feedback → `tbl_managing_feedback`

### 3. Tag & Topik
- `tbl_tags` menyimpan topik essay (mis. "College Essay", "Supplement").
- `tbl_essay_tags` adalah tabel pivot yang menghubungkan essay dengan tag.

### 4. Work Duration Tracking
- `tbl_work_duration` mencatat durasi kerja editor per essay assignment.

### 5. Program & Universitas
- `tbl_programs` menyimpan program editing dengan harga, kata minimum/maksimum, deadline.
- `tbl_universities` menyimpan database universitas dengan website, email, dsb.
- Kedua tabel memiliki kolom `deleted_at` (soft delete manual).

---

## ⚠️ Catatan Teknis & Ketergantungan

1. **Hanya 2 file migrasi** — Migrasi untuk semua tabel dasar tidak ada di proyek ini. Kemungkinan tabel dibuat di proyek induk (CRM).

2. **`SoftDeletes` trait tidak dipakai** — Kolom `deleted_at` ada di `tbl_clients`, `tbl_universities`, `tbl_programs`, `tbl_essay_prompt`, tetapi tidak ada model yang menggunakan trait `SoftDeletes`.

3. **Auto-increment tidak aktif pada sebagian besar tabel** — `tbl_clients`, `tbl_editors`, `tbl_mentors`, `tbl_status`, `tbl_position_editors`, `tbl_essay_editors`, `tbl_essay_feedback`, `tbl_essay_reject`, `tbl_essay_revise`, `tbl_essay_status`, `tbl_essay_tags` semua memiliki `$incrementing = false` (UUID/string PK).

4. **`id_univ` tidak di `$fillable` di `EssayPrompts`** — Kolom ada di relasi dan migrasi, tetapi tidak dapat diisi massal via Eloquent.

5. **`WorkDuration` merujuk ke `EssayClients`** — Kemungkinan **bug**, seharusnya merujuk ke `EssayEditors` (FK `id_essay_editors`).

6. **`ManagingFeedback` FK typo** — Relasi memakai `id_essay_editors`/`id_editors` (plural) yang tidak ada di `$fillable`, sedangkan kolom fillable adalah `id_essay_editor`/`id_editor` (singular).

7. **`EssayStatus::check_status()`** — Duplikat persis dengan `status()`, keduanya `belongsTo(Status::class, 'status', 'id')`.

8. **`tbl_essay_clients` memiliki 2 relasi belongsTo ke `tbl_clients`** — Satu via `id_clients`, satu lagi via `email`.

9. **Seeders kosong** — `DatabaseSeeder` tidak memanggil seeders apapun.

10. **Database default:** `laravel` (MySQL, `utf8mb4`, charset default Laravel).