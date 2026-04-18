# 🔧 FIX REDIRECT LOOP - Admin Login Issue

## ❌ Masalah yang Ditemukan

### Symptom:
- Admin login → redirect ke `/user/dashboard` (salah!)
- URL loop: `/` → `/user/dashboard` → `/login` → `/` (berulang)
- Redirect loop tidak berhenti

### Root Cause:
1. **Middleware CheckRole** redirect ke `/login` jika role tidak sesuai
2. Setelah login, admin diarahkan ke `/admin/dashboard`
3. Tapi entah kenapa masuk ke `/user/dashboard` dulu
4. Middleware cek role admin di `/user/dashboard` → tidak sesuai
5. Redirect ke `/login` → login lagi → loop!

---

## ✅ Perbaikan yang Dilakukan

### 1. Update CheckRole Middleware
**File:** `app/Http/Middleware/CheckRole.php`

**Perubahan:**
```php
// SEBELUM (❌ Menyebabkan loop)
if (Auth::user()->role !== $role) {
    return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
}

// SESUDAH (✅ Redirect ke dashboard yang sesuai)
if (Auth::user()->role !== $role) {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    } else {
        return redirect()->route('user.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}
```

**Alasan:** Jika user salah akses route, redirect ke dashboard mereka sendiri, bukan ke login.

### 2. Update LoginController
**File:** `app/Http/Controllers/auth/LoginController.php`

**Perubahan:**
```php
// Tambahkan session regenerate
$request->session()->regenerate();

// Gunakan redirect()->intended() untuk handle redirect yang tertunda
return redirect()->intended(route('admin.dashboard'));
```

### 3. Tambah Debug Route
**File:** `routes/web.php`

```php
Route::get('/debug-auth', function () {
    if (Auth::check()) {
        return response()->json([
            'authenticated' => true,
            'user' => Auth::user()->only(['id', 'username', 'role']),
            'role' => Auth::user()->role,
        ]);
    }
    return response()->json(['authenticated' => false]);
})->middleware('auth');
```

### 4. Clear All Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 🧪 Testing Steps

### Step 1: Clear Browser Data
**PENTING!** Clear browser cache dan cookies:
```
Chrome/Edge: Ctrl + Shift + Delete
Firefox: Ctrl + Shift + Del
```
Pilih:
- ✅ Cookies and site data
- ✅ Cached images and files

### Step 2: Test Debug Route
1. Login dengan akun admin
2. Akses: `http://127.0.0.1:8000/debug-auth`
3. Verify response:
```json
{
  "authenticated": true,
  "user": {
    "id": 1,
    "username": "admin",
    "role": "admin"
  },
  "role": "admin"
}
```

### Step 3: Test Admin Login Flow
```
1. Akses: http://127.0.0.1:8000/
   Expected: Redirect ke /login ✅

2. Login dengan:
   Username: admin
   Password: admin123
   
3. Klik Login
   Expected: Redirect ke /admin/dashboard ✅
   
4. Verify URL: http://127.0.0.1:8000/admin/dashboard
   Expected: Dashboard admin muncul ✅
```

### Step 4: Test User Login Flow
```
1. Logout dari admin
2. Login dengan:
   Username: user1
   Password: user123
   
3. Klik Login
   Expected: Redirect ke /user/dashboard ✅
   
4. Verify URL: http://127.0.0.1:8000/user/dashboard
   Expected: Dashboard user muncul ✅
```

### Step 5: Test Wrong Access
```
1. Login sebagai user
2. Coba akses: http://127.0.0.1:8000/admin/dashboard
   Expected: Redirect ke /user/dashboard dengan error message ✅
   
3. Login sebagai admin
4. Coba akses: http://127.0.0.1:8000/user/dashboard
   Expected: Redirect ke /admin/dashboard dengan error message ✅
```

---

## 🔍 Debugging Checklist

### Jika masih ada redirect loop:

#### 1. Check User Role di Database
```sql
SELECT id, username, role FROM users;
```
Pastikan:
- Admin memiliki `role = 'admin'`
- User memiliki `role = 'user'`

#### 2. Check Session
Akses debug route: `http://127.0.0.1:8000/debug-auth`
Pastikan role terdeteksi dengan benar.

#### 3. Check Browser Console
Buka Developer Tools (F12) → Network tab
Lihat redirect chain:
- Jika ada loop, akan terlihat request berulang
- Check response headers untuk melihat redirect location

#### 4. Check Laravel Log
```bash
tail -f storage/logs/laravel.log
```
Lihat error atau warning yang muncul saat login.

#### 5. Clear Everything
```bash
# Clear Laravel cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Clear browser cache
Ctrl + Shift + Delete (pilih cookies & cache)

# Restart servers
# Stop: Ctrl + C
php artisan serve
npm run dev
```

---

## 🎯 Expected Behavior

### Admin Login
```
POST /login (credentials: admin)
  ↓
Auth::login($user) [role = 'admin']
  ↓
redirect()->intended(route('admin.dashboard'))
  ↓
Middleware: auth ✅
  ↓
Middleware: role:admin ✅
  ↓
AdminDashboardController@index
  ↓
View: admin/dashboard.blade.php ✅
```

### User Login
```
POST /login (credentials: user)
  ↓
Auth::login($user) [role = 'user']
  ↓
redirect()->intended(route('user.dashboard'))
  ↓
Middleware: auth ✅
  ↓
Middleware: role:user ✅
  ↓
UserDashboardController@index
  ↓
View: user/dashboard.blade.php ✅
```

### Wrong Access (Admin → User Route)
```
GET /user/dashboard [logged in as admin]
  ↓
Middleware: auth ✅
  ↓
Middleware: role:user ❌ (role is 'admin')
  ↓
redirect()->route('admin.dashboard') with error
  ↓
AdminDashboardController@index ✅
```

---

## 🔐 Security Notes

### Session Regeneration
```php
$request->session()->regenerate();
```
**Purpose:** Mencegah session fixation attacks

### Intended Redirect
```php
redirect()->intended(route('admin.dashboard'))
```
**Purpose:** Jika user mencoba akses protected route, setelah login akan diarahkan ke route yang dimaksud.

---

## 📋 Verification Checklist

### Files Modified
- [x] `app/Http/Middleware/CheckRole.php` - Fixed redirect logic
- [x] `app/Http/Controllers/auth/LoginController.php` - Added session regenerate
- [x] `routes/web.php` - Added debug route

### Cache Cleared
- [x] Application cache
- [x] Configuration cache
- [x] Route cache
- [x] View cache
- [x] Browser cache (manual)

### Testing
- [ ] Admin can login
- [ ] Admin redirects to `/admin/dashboard`
- [ ] User can login
- [ ] User redirects to `/user/dashboard`
- [ ] Wrong access redirects correctly
- [ ] No redirect loop
- [ ] Debug route shows correct role

---

## 🚨 Common Issues

### Issue 1: Still redirecting to wrong dashboard
**Cause:** Browser cache
**Solution:** Hard refresh (Ctrl + Shift + R) or clear browser cache

### Issue 2: Role is null or undefined
**Cause:** User data tidak lengkap di database
**Solution:** 
```sql
UPDATE users SET role = 'admin' WHERE username = 'admin';
UPDATE users SET role = 'user' WHERE username = 'user1';
```

### Issue 3: Session not persisting
**Cause:** Session driver issue
**Solution:** Check `.env`:
```env
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### Issue 4: Middleware not working
**Cause:** Middleware not registered
**Solution:** Check `bootstrap/app.php`:
```php
$middleware->alias([
    'role' => \App\Http\Middleware\CheckRole::class,
]);
```

---

## 🎊 Final Steps

### 1. Clear Everything
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 2. Clear Browser
```
Ctrl + Shift + Delete
✅ Cookies
✅ Cache
```

### 3. Restart Servers
```bash
# Stop existing (Ctrl + C)
php artisan serve
npm run dev
```

### 4. Test Login
```
1. Go to: http://127.0.0.1:8000/
2. Login as admin
3. Verify redirect to /admin/dashboard
4. Success! ✅
```

---

## 📝 Debug Route Usage

### Check Authentication Status
```bash
# After login, access:
http://127.0.0.1:8000/debug-auth

# Expected response:
{
  "authenticated": true,
  "user": {
    "id": 1,
    "username": "admin",
    "role": "admin"
  },
  "role": "admin"
}
```

### Remove Debug Route (After Testing)
Hapus route ini dari `routes/web.php` setelah testing selesai:
```php
Route::get('/debug-auth', ...); // DELETE THIS
```

---

Silakan test dengan langkah-langkah di atas! 🚀
