<?php

/**
 * Script untuk update routes di view files
 * Jalankan dengan: php update-routes.php
 */

$files = [
    'resources/views/user/pengaduan/index.blade.php',
    'resources/views/user/pengaduan/show.blade.php',
];

$replacements = [
    "route('dashboard.user')" => "route('user.dashboard')",
    "route('pengaduan.create')" => "route('user.pengaduan.create')",
    "route('pengaduan.index')" => "route('user.pengaduan.index')",
    "route('pengaduan.show'" => "route('user.pengaduan.show'",
    "route('pengaduan.store')" => "route('user.pengaduan.store')",
    "route('pengaduan.destroy'" => "route('user.pengaduan.destroy'",
];

foreach ($files as $file) {
    if (!file_exists($file)) {
        echo "❌ File tidak ditemukan: $file\n";
        continue;
    }

    $content = file_get_contents($file);
    $originalContent = $content;

    foreach ($replacements as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }

    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        echo "✅ Updated: $file\n";
    } else {
        echo "⏭️  No changes needed: $file\n";
    }
}

echo "\n✨ Done! Routes updated successfully.\n";
