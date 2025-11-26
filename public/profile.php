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
                                        <li><a id="profile-link" class="flex items-center gap-3 px-4 py-2 text-text-primary dark:text-white font-semibold bg-gray-100 dark:bg-gray-700 rounded-md" href="#"><span class="material-symbols-outlined text-xl">person</span>Hồ sơ của tôi</a></li>
                                        <li><a id="orders-link" class="flex items-center gap-3 px-4 py-2 text-text-secondary dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-text-primary dark:hover:text-white rounded-md" href="index.php?action=lichsudonhang"><span class="material-symbols-outlined text-xl">receipt_long</span>Lịch sử đơn hàng</a></li>
                                        <li><a id="password-link" class="flex items-center gap-3 px-4 py-2 text-text-secondary dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-text-primary dark:hover:text-white rounded-md" href="#"><span class="material-symbols-outlined text-xl">lock</span>Đổi mật khẩu</a></li>
                                        <li><a class="flex items-center gap-3 px-4 py-2 text-text-secondary dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-text-primary dark:hover:text-white rounded-md" href="index.php"><span class="material-symbols-outlined text-xl">home</span>Trở lại trang chủ</a></li>
                                        <li><a class="flex items-center gap-3 px-4 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md" href="index.php?action=dangxuat"><span class="material-symbols-outlined text-xl">logout</span>Đăng xuất</a></li>
                                    </ul>
                                </nav>
                            </aside>
                            <div class="md:col-span-2 bg-secondary-bg dark:bg-gray-800 p-6 md:p-8 rounded-lg shadow-sm">
                                <form id="profile-form" class="space-y-8" action="index.php?action=capnhatthongtin" method="post">
                                    <div>
                                        <h3 class="text-lg font-semibold text-text-primary dark:text-white">Thông tin cá nhân</h3>
                                        <p class="text-sm text-text-secondary dark:text-gray-400">Cập nhật thông tin của bạn.</p>
                                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-medium text-text-secondary dark:text-gray-300" for="full-name">Họ tên</label>
                                                <input class="form-input mt-1 block w-full rounded-md border-border-color dark:border-gray-600 bg-transparent dark:bg-gray-700 dark:text-white focus:border-gray-400 focus:ring-gray-400" id="full-name" name="HoTen" type="text" value="<?= $ttKhachHang['HoTen'] ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-text-secondary dark:text-gray-300" for="email">Email</label>
                                                <input class="form-input mt-1 block w-full rounded-md border-border-color dark:border-gray-600 bg-transparent dark:bg-gray-700 dark:text-white focus:border-gray-400 focus:ring-gray-400" id="email" name="Email" type="email" value="<?= $ttKhachHang['Email'] ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-text-secondary dark:text-gray-300" for="phone">Số điện thoại</label>
                                                <input class="form-input mt-1 block w-full rounded-md border-border-color dark:border-gray-600 bg-transparent dark:bg-gray-700 dark:text-white focus:border-gray-400 focus:ring-gray-400" id="phone" name="SoDT" type="tel" value="<?= $ttKhachHang['SoDT'] ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-text-secondary dark:text-gray-300" for="birthdate">Ngày sinh</label>
                                                <input class="form-input mt-1 block w-full rounded-md border-border-color dark:border-gray-600 bg-transparent dark:bg-gray-700 dark:text-white focus:border-gray-400 focus:ring-gray-400" id="birthdate" name="NgaySinh" type="date" value="<?= $ttKhachHang['NgaySinh'] ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-text-secondary dark:text-gray-300" for="address">Địa chỉ</label>
                                                <input class="form-input mt-1 block w-full rounded-md border-border-color dark:border-gray-600 bg-transparent dark:bg-gray-700 dark:text-white focus:border-gray-400 focus:ring-gray-400" id="address" name="DiaChi" type="text" value="<?= $ttKhachHang['DiaChi'] ?>" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-text-secondary dark:text-gray-300" for="gender">Giới tính</label>
                                                <select class="form-select mt-1 block w-full rounded-md border-border-color dark:border-gray-600 bg-transparent dark:bg-gray-700 dark:text-white focus:border-gray-400 focus:ring-gray-400" id="gender" name="GioiTinh">
                                                    <option value="0" <?= $ttKhachHang['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                                                    <option value="1" <?= $ttKhachHang['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                                                    <option value="2" <?= $ttKhachHang['GioiTinh'] == 'Khác' ? 'selected' : '' ?>>Khác</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="border-border-color dark:border-gray-700" />
                                    <div class="flex justify-end gap-4">
                                        <a href="index.php?action=thongtin" class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 gap-2 text-sm font-semibold leading-normal" type="button">
                                            Hủy
                                        </a>
                                        <button type="submit" class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-gray-900 dark:bg-gray-200 text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-white gap-2 text-sm font-semibold leading-normal" type="submit">
                                            Lưu thay đổi
                                        </button>
                                    </div>
                                </form>
                                <form id="password-form" class="space-y-8 hidden" action="index.php?action=doimatkhau" method="post">
                                    <div>
                                        <h3 class="text-lg font-semibold text-text-primary dark:text-white">Thông tin cá nhân</h3>
                                        <p class="text-sm text-text-secondary dark:text-gray-400">Đổi mật khẩu</p>
                                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-sm font-medium text-text-secondary dark:text-gray-300" for="full-name">Mật khẩu cũ</label>
                                                <input class="form-input mt-1 block w-full rounded-md border-border-color dark:border-gray-600 bg-transparent dark:bg-gray-700 dark:text-white focus:border-gray-400 focus:ring-gray-400" id="password-old" name="MatKhauCu" type="password" />
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-text-secondary dark:text-gray-300" for="email">Mật khẩu mới</label>
                                                <input class="form-input mt-1 block w-full rounded-md border-border-color dark:border-gray-600 bg-transparent dark:bg-gray-700 dark:text-white focus:border-gray-400 focus:ring-gray-400" id="password-new" name="MatKhauMoi" type="password" />
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="border-border-color dark:border-gray-700" />
                                    <div class="flex justify-end gap-4">
                                        <a href="index.php?action=thongtin" class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 gap-2 text-sm font-semibold leading-normal" type="button">
                                            Hủy
                                        </a>
                                        <button type="submit" class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-gray-900 dark:bg-gray-200 text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-white gap-2 text-sm font-semibold leading-normal" type="submit">
                                            Lưu thay đổi
                                        </button>
                                    </div>
                                </form>
                                <div id="order-form" class="space-y-8 hidden">
                                    <div>
                                        <h3 class="text-lg font-semibold text-text-primary dark:text-white">Thông tin đơn hàng</h3>
                                        <p class="text-sm text-text-secondary dark:text-gray-400">Lịch sử đơn hàng</p>
                                        <div class="mt-6">
                                            <table class="min-w-full divide-y divide-border-color dark:divide-gray-700">
                                                <thead>
                                                    <tr>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary dark:text-gray-300 uppercase tracking-wider">Ngày đặt</th>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary dark:text-gray-300 uppercase tracking-wider">Trạng thái</th>
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-text-secondary dark:text-gray-300 uppercase tracking-wider">Hoạt động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-border-color dark:divide-gray-700">
                                                    <?php foreach ($lichsu as $donhang) : ?>
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-text-primary dark:text-white hidden"><?= $donhang['MaDonHang'] ?></td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary dark:text-gray-300"><?= date('d/m/Y', strtotime($donhang['NgayDat'])) ?></td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary dark:text-gray-300">
                                                            <?php 
                                                                switch ($donhang['TrangThai']) {
                                                                    case '0':
                                                                        echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Đang xử lý</span>';
                                                                        break;
                                                                    case '1':
                                                                        echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Đang vận chuyển</span>';
                                                                        break;
                                                                    case '2':
                                                                        echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Đã giao hàng</span>';
                                                                        break;
                                                                    case '3':
                                                                        echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Đã hủy</span>';
                                                                        break;
                                                                    default:
                                                                        echo '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Không xác định</span>';
                                                                        break;
                                                                }
                                                            ?>
                                                            </td>
                                                            <!-- <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary dark:text-gray-300 btn"><a href="order_details.php?order_id=<?= $donhang['MaDonHang'] ?>">Xem chi tiết</a></td> -->
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary dark:text-gray-300 btn"><a href="index.php?action=chitietdonhang&id=<?= $donhang['MaDonHang'] ?>" class="text-primary hover:underline">Xem chi tiết</a></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Lấy các phần tử DOM
        const profileLink = document.getElementById('profile-link');
        const passwordLink = document.getElementById('password-link');
        const ordersLink = document.getElementById('orders-link');

        const profileForm = document.getElementById('profile-form');
        const passwordForm = document.getElementById('password-form');
        const orderForm = document.getElementById('order-form'); 

        // Hàm helper để cập nhật style cho link active/inactive
        function setActiveLink(activeLink, inactiveLinks) {
            // Style cho link đang kích hoạt (Active)
            activeLink.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-text-primary', 'dark:text-white', 'font-semibold');
            activeLink.classList.remove('text-text-secondary', 'dark:text-gray-300', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');

            // Style cho các link còn lại (Inactive)
            inactiveLinks.forEach(link => {
                link.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-text-primary', 'dark:text-white', 'font-semibold');
                link.classList.add('text-text-secondary', 'dark:text-gray-300', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
            });
        }

        profileLink.addEventListener('click', (e) => {
            e.preventDefault();

            profileForm.classList.remove('hidden');
            passwordForm.classList.add('hidden');
            orderForm.classList.add('hidden');

            // Cập nhật giao diện nút bấm
            setActiveLink(profileLink, [passwordLink, ordersLink]);
        });

        passwordLink.addEventListener('click', (e) => {
            e.preventDefault();

            profileForm.classList.add('hidden');
            passwordForm.classList.remove('hidden');
            orderForm.classList.add('hidden');

            setActiveLink(passwordLink, [profileLink, ordersLink]);
        });

        ordersLink.addEventListener('click', (e) => {
            e.preventDefault();

            profileForm.classList.add('hidden');
            passwordForm.classList.add('hidden');
            orderForm.classList.remove('hidden');

            setActiveLink(ordersLink, [profileLink, passwordLink]);
        });
    </script>
</body>

</html>