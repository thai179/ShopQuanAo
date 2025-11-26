<!DOCTYPE html>
<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Hồ sơ cá nhân</title>
    <link rel="icon" href="worldwide.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#195de6",
                        "background-light": "#f6f6f8",
                        "background-dark": "#111621",
                        "primary-bg": "#F8F8F8",
                        "secondary-bg": "#FFFFFF",
                        "text-primary": "#1A1A1A",
                        "text-secondary": "#6B7280",
                        "border-color": "#E5E7EB",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "Noto Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-size: inherit;
        }
    </style>
</head>

<body class="font-display bg-background-light dark:bg-background-dark">
    <div class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <div class="flex flex-1 justify-center">
                <div class="layout-content-container flex flex-col w-full max-w-6xl flex-1 px-4 md:px-10">
                    <main class="flex flex-col gap-8 py-10">
                        <header class="flex flex-col gap-2">
                            <h1 class="text-3xl font-bold text-text-primary dark:text-white">Thông tin tài khoản</h1>
                            <p class="text-text-secondary dark:text-gray-300">Quản lý thông tin cá nhân và xem lịch sử đặt hàng của bạn.</p>
                        </header>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <aside class="md:col-span-1 flex flex-col gap-4">
                                <div class="bg-secondary-bg dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                                    <div class="flex flex-col items-center text-center">
                                        <div class="relative">
                                            <img alt="Avatar" class="w-24 h-24 rounded-full object-cover border-2 border-white dark:border-gray-700" src="../images/user.png" />
                                            <button class="absolute bottom-0 right-0 flex items-center justify-center w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full hover:bg-gray-300 dark:hover:bg-gray-600">
                                                <span class="material-symbols-outlined text-base">photo_camera</span>
                                            </button>
                                        </div>
                                        <h2 class="mt-4 text-xl font-semibold text-text-primary dark:text-white"><?= $ttKhachHang['HoTen'] ?></h2>
                                        <p class="text-sm text-text-secondary dark:text-gray-400"><?= $ttKhachHang['Email'] ?></p>
                                    </div>
                                </div>
                                <nav class="bg-secondary-bg dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                                    <ul class="space-y-1">
                                        <li><a id="profile-link" class="flex items-center gap-3 px-4 py-2 text-text-primary dark:text-white font-semibold bg-gray-100 dark:bg-gray-700 rounded-md" href="index.php?action=thongtin"><span class="material-symbols-outlined text-xl">arrow_back</span>Quay lại</a></li>
                                        <li><a class="flex items-center gap-3 px-4 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md" href="index.php?action=dangxuat"><span class="material-symbols-outlined text-xl">logout</span>Đăng xuất</a></li>
                                    </ul>
                                </nav>
                            </aside>
                            <div class="md:col-span-2 bg-secondary-bg dark:bg-gray-800 p-6 md:p-8 rounded-lg shadow-sm">
                                <div>
                                    <h3 class="text-lg font-semibold text-text-primary dark:text-white">Thông tin đơn hàng</h3>
                                    <p class="text-sm text-text-secondary dark:text-gray-400">Chi tiết đơn hàng.</p>
                                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <?php foreach ($chiTietDonHang as $item): ?>
                                        <div class="flex gap-4">
                                            <img alt="<?= $item['TenSP'] ?>" class="w-20 h-20 object-cover rounded-md border border-border-color dark:border-gray-700" src="../images/products/<?= $item['HinhAnh'] ?>" />
                                            <div class="flex flex-col justify-between">
                                                <div>
                                                    <h4 class="text-text-primary dark:text-white font-semibold"><?= $item['TenSP'] ?></h4>
                                                    <p class="text-sm text-text-secondary dark:text-gray-400">Đơn giá: <?= number_format($item['GiaBan'], 0, ',', '.') ?>₫</p>
                                                    <p class="text-sm text-text-secondary dark:text-gray-400">Số lượng: <?= $item['SoLuong'] ?></p>
                                                </div>
                                                <p class="text-sm font-semibold text-text-primary dark:text-white">Thành tiền: <?= number_format($item['ThanhTien'], 0, ',', '.') ?>₫</p>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>

</html>