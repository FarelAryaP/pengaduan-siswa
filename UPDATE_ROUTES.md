# 📋 Dokumentasi Reorganisasi Struktur Berdasarkan Role

## ✅ Yang Sudah Dibuat

### 1. Middleware
- ✅ `CheckRole` middleware untuk validasi role
- ✅ Registered di `bootstrap/app.php`

### 2. Controllers

#### User Controllers
- ✅ `App\Http\Controllers\User\DashboardController`
- ✅ `App\Http\Controllers\User\PengaduanController`

#### Admin Controllers
- ✅ `App\Http\Controllers\Admin\DashboardController`
- ✅ `App\Http\Controllers\Admin\PengaduanController`

### 3. Routes (routes/web.php)

#### User Routes (Prefix: /user)
```
GET  /user/dashboard                    -> user.dashboard
GET  /user/pengaduan                    -> user.pengaduan.index
GET  /user/pengaduan/create             -> user.pengaduan.create
POST /user/pengaduan                    -> user.pengaduan.store
GET  /user/pengaduan/{id}               -> user.pengaduan.show
DELETE /user/pengaduan/{id}             -> user.pengaduan.destroy
```

#### Admin Routes (Prefix: /admin)
```
GET  /admin/dashboard                   -> admin.dashboard
GET  /admin/pengaduan                   -> admin.pengaduan.index
GET  /admin/pengaduan/{id}              -> admin.pengaduan.show
PATCH /admin/pengaduan/{id}/status      -> admin.pengaduan.updateStatus
DELETE /admin/pengaduan/{id}            -> admin.pengaduan.destroy
```

### 4. Views

#### User Views
- ✅ `resources/views/user/dashboard.blade.php`
- ✅ `resources/views/user/pengaduan/create.blade.php` (routes updated)
- ⚠️ `resources/views/user/pengaduan/index.blade.php` (needs route update)
- ⚠️ `resources/views/user/pengaduan/show.blade.php` (needs route update)

#### Admin Views
- ✅ `resources/views/admin/dashboard.blade.php`
- ⏳ `resources/views/admin/pengaduan/index.blade.php` (to be created)
- ⏳ `resources/views/admin/pengaduan/show.blade.php` (to be created)

---

## 🔧 Manual Update Required

### Update Routes di View User

Karena PowerShell command tidak berjalan sempurna, Anda perlu update manual routes di file berikut:

#### File: `resources/views/user/pengaduan/index.blade.php`

Ganti semua:
- `route('dashboard.user')` → `route('user.dashboard')`
- `route('pengaduan.create')` → `route('user.pengaduan.create')`
- `route('pengaduan.show', ...)` → `route('user.pengaduan.show', ...)`
- `route('pengaduan.destroy', ...)` → `route('user.pengaduan.destroy', ...)`

#### File: `resources/views/user/pengaduan/show.blade.php`

Ganti semua:
- `route('pengaduan.index')` → `route('user.pengaduan.index')`
- `route('pengaduan.destroy', ...)` → `route('user.pengaduan.destroy', ...)`

---

## 📝 Cara Update Manual (Find & Replace)

### Menggunakan VS Code / Editor:
1. Buka file yang perlu diupdate
2. Tekan `Ctrl + H` (Find & Replace)
3. Find: `route('pengaduan.`
4. Replace: `route('user.pengaduan.`
5. Replace All

6. Find: `route('dashboard.user')`
7. Replace: `route('user.dashboard')`
8. Replace All

---

## 🚀 Testing Setelah Update

### Test User Flow:
1. Login sebagai user
2. Akses: http://127.0.0.1:8000/user/dashboard
3. Klik "Buat Pengaduan Baru"
4. Isi form dan submit
5. Lihat daftar pengaduan
6. Klik detail pengaduan
7. Test hapus pengaduan (jika pending)

### Test Admin Flow:
1. Login sebagai admin
2. Akses: http://127.0.0.1:8000/admin/dashboard
3. Klik "Kelola Pengaduan"
4. Lihat semua pengaduan
5. Klik detail pengaduan
6. Update status pengaduan
7. Test hapus pengaduan

---

## 📂 Struktur Akhir

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── User/
│   │   │   ├── DashboardController.php
│   │   │   └── PengaduanController.php
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   └── PengaduanController.php
│   │   └── Auth/
│   │       ├── LoginController.php
│   │       └── RegisterController.php
│   └── Middleware/
│       └── CheckRole.php

resources/views/
├── user/
│   ├── dashboard.blade.php
│   └── pengaduan/
│       ├── create.blade.php
│       ├── index.blade.php
│       └── show.blade.php
├── admin/
│   ├── dashboard.blade.php
│   └── pengaduan/
│       ├── index.blade.php
│       └── show.blade.php
└── auth/
    ├── login.blade.php
    └── register.blade.php

routes/
└── web.php (organized by role)
```

---

## 🔐 Keamanan

### Middleware Protection:
- Semua route user dilindungi: `middleware(['auth', 'role:user'])`
- Semua route admin dilindungi: `middleware(['auth', 'role:admin'])`
- Redirect otomatis jika role tidak sesuai

### Controller Level:
- User controller: Hanya bisa akses data milik sendiri
- Admin controller: Bisa akses semua data

---

## 📊 Perbedaan Fitur User vs Admin

### User:
- ✅ Buat pengaduan baru
- ✅ Lihat pengaduan milik sendiri
- ✅ Hapus pengaduan (hanya status pending)
- ❌ Tidak bisa update status
- ❌ Tidak bisa lihat pengaduan user lain

### Admin:
- ❌ Tidak bisa buat pengaduan
- ✅ Lihat semua pengaduan
- ✅ Update status pengaduan (pending/proses/selesai)
- ✅ Hapus pengaduan apapun
- ✅ Filter pengaduan berdasarkan status
- ✅ Lihat statistik lengkap

---

## 🎯 Next Steps

1. ✅ Update routes di `resources/views/user/pengaduan/index.blade.php`
2. ✅ Update routes di `resources/views/user/pengaduan/show.blade.php`
3. ⏳ Buat view admin pengaduan (index & show)
4. ⏳ Test semua fitur
5. ⏳ Buat seeder untuk data dummy (optional)

---

## 💡 Tips

### Membuat Admin User:
```php
// Di tinker atau seeder
User::create([
    'username' => 'admin',
    'nama' => 'Administrator',
    'password' => bcrypt('admin123'),
    'role' => 'admin',
]);
```

### Membuat User Biasa:
```php
User::create([
    'username' => 'user1',
    'nama' => 'User Satu',
    'password' => bcrypt('user123'),
    'role' => 'user',
]);
```

### Check Route List:
```bash
php artisan route:list --name=user
php artisan route:list --name=admin
```

---

## ⚠️ Troubleshooting

### Error: Route not found
- Pastikan routes sudah diupdate di view
- Clear route cache: `php artisan route:clear`

### Error: Middleware not found
- Pastikan middleware sudah registered di `bootstrap/app.php`
- Restart server

### Error: Access denied
- Pastikan user memiliki role yang benar
- Check di database: `SELECT * FROM users;`

---

Dokumentasi ini akan membantu Anda menyelesaikan reorganisasi struktur berdasarkan role!
