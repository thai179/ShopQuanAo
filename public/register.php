<!DOCTYPE html>

<html class="" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="icon" href="worldwide.ico" type="image/x-icon">
    <title>Tạo Tài Khoản - Cửa hàng quần áo</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#e68019",
                        "background-light": "#fcfaf8",
                        "background-dark": "#211911",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
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
</head>

<body class="bg-background-light dark:bg-background-dark font-display">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f3ede7] dark:border-b-[#2a221a] px-10 py-3">
                <div class="flex items-center gap-4 text-[#1b140e] dark:text-[#fcfaf8]">
                    <div class="size-6 text-primary">
                        <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_6_319)">
                                <path d="M8.57829 8.57829C5.52816 11.6284 3.451 15.5145 2.60947 19.7452C1.76794 23.9758 2.19984 28.361 3.85056 32.3462C5.50128 36.3314 8.29667 39.7376 11.8832 42.134C15.4698 44.5305 19.6865 45.8096 24 45.8096C28.3135 45.8096 32.5302 44.5305 36.1168 42.134C39.7033 39.7375 42.4987 36.3314 44.1494 32.3462C45.8002 28.361 46.2321 23.9758 45.3905 19.7452C44.549 15.5145 42.4718 11.6284 39.4217 8.57829L24 24L8.57829 8.57829Z" fill="currentColor"></path>
                            </g>
                            <defs>
                                <clippath id="clip0_6_319">
                                    <rect fill="white" height="48" width="48"></rect>
                                </clippath>
                            </defs>
                        </svg>
                    </div>
                    <h2 class="text-[#1b140e] dark:text-[#fcfaf8] text-lg font-bold leading-tight tracking-[-0.015em]">UNI Shop</h2>
                </div>
            </header>
            <main class="flex flex-1 justify-center py-10 sm:py-16 px-4">
                <div class="flex flex-col max-w-md w-full">
                    <h1 class="text-[#1b140e] dark:text-[#fcfaf8] tracking-tight text-3xl font-bold leading-tight text-center pb-8">Tạo Tài Khoản</h1>
                    <form class="space-y-6" action="index.php?action=dangky_process" method="post">
                        <div class="flex flex-col">
                            <label class="text-[#1b140e] dark:text-gray-300 text-base font-medium leading-normal pb-2" for="fullName">Họ và Tên</label>
                            <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#1b140e] dark:text-[#fcfaf8] focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#e7dbd0] dark:border-[#3a2f23] bg-[#fcfaf8] dark:bg-[#2a221a] focus:border-primary dark:focus:border-primary h-12 placeholder:text-[#97734e] dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" id="hoten" name="hoten" placeholder="Nhập họ và tên của bạn" type="text" value="" />
                        </div>
                        <div class="flex flex-col">
                            <label class="text-[#1b140e] dark:text-gray-300 text-base font-medium leading-normal pb-2" for="username">Tên người dùng</label>
                            <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#1b140e] dark:text-[#fcfaf8] focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#e7dbd0] dark:border-[#3a2f23] bg-[#fcfaf8] dark:bg-[#2a221a] focus:border-primary dark:focus:border-primary h-12 placeholder:text-[#97734e] dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" id="username" name="username" placeholder="Nhập username của bạn" type="text" value="" />
                        </div>
                        <div class="flex flex-col">
                            <label class="text-[#1b140e] dark:text-gray-300 text-base font-medium leading-normal pb-2" for="email">Email</label>
                            <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#1b140e] dark:text-[#fcfaf8] focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#e7dbd0] dark:border-[#3a2f23] bg-[#fcfaf8] dark:bg-[#2a221a] focus:border-primary dark:focus:border-primary h-12 placeholder:text-[#97734e] dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal" id="email" name="email" placeholder="Nhập email của bạn" type="email" value="" />
                        </div>
                        <div class="flex flex-col">
                            <label class="text-[#1b140e] dark:text-gray-300 text-base font-medium leading-normal pb-2" for="password">Mật khẩu</label>
                            <div class="relative flex w-full flex-1 items-stretch">
                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#1b140e] dark:text-[#fcfaf8] focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#e7dbd0] dark:border-[#3a2f23] bg-[#fcfaf8] dark:bg-[#2a221a] focus:border-primary dark:focus:border-primary h-12 placeholder:text-[#97734e] dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal pr-10" id="password" name="password" placeholder="Nhập mật khẩu của bạn" type="password" value="" />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="material-symbols-outlined text-[#97734e] dark:text-gray-500 text-xl cursor-pointer">visibility</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-[#1b140e] dark:text-gray-300 text-base font-medium leading-normal pb-2" for="confirmPassword">Xác nhận Mật khẩu</label>
                            <div class="relative flex w-full flex-1 items-stretch">
                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#1b140e] dark:text-[#fcfaf8] focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-[#e7dbd0] dark:border-[#3a2f23] bg-[#fcfaf8] dark:bg-[#2a221a] focus:border-primary dark:focus:border-primary h-12 placeholder:text-[#97734e] dark:placeholder:text-gray-500 p-3 text-base font-normal leading-normal pr-10" id="confirmPassword" name="confirmPassword" placeholder="Xác nhận lại mật khẩu" type="password" value="" />
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="material-symbols-outlined text-[#97734e] dark:text-gray-500 text-xl cursor-pointer">visibility</span>
                                </div>
                            </div>
                        </div>
                        <button class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-primary text-[#1b140e] text-base font-bold leading-normal tracking-[0.015em] hover:bg-opacity-90 transition-colors duration-200" type="submit">
                            <span class="truncate">Đăng ký</span>
                        </button>
                    </form>
                    <p class="text-center text-sm text-[#97734e] dark:text-gray-400 mt-8">
                        Đã có tài khoản?
                        <a class="font-semibold text-primary hover:text-opacity-80 transition-colors duration-200" href="index.php?action=dangnhap">Đăng nhập</a>
                    </p>
                </div>
            </main>
        </div>
    </div>
</body>

</html>