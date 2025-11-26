<!DOCTYPE html>

<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />    
    <link rel="icon" href="worldwide.ico" type="image/x-icon">
    <title>Đăng nhập - Cửa hàng quần áo</title>
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
                        "primary": "#795548",
                        "background-light": "#F5F5DC",
                        "background-dark": "#211911",
                        "text-light": "#36454F",
                        "text-dark": "#e5e3e0",
                        "text-muted-light": "#A08C7D",
                        "text-muted-dark": "#8a7e74",
                        "border-light": "#e0d9c4",
                        "border-dark": "#4d4237",
                        "surface-light": "#FFFDD0",
                        "surface-dark": "#2a2219",
                        "accent-light": "#B87333",
                        "accent-dark": "#d4af37",
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
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
</head>

<body class="font-display bg-background-light dark:bg-background-dark text-text-light dark:text-text-dark">
    <div class="relative flex min-h-screen w-full flex-col group/design-root">
        <div class="flex-grow">
            <div class="flex min-h-screen">
                <div class="hidden lg:flex lg:w-1/2">
                    <div class="w-full bg-center bg-no-repeat bg-cover" data-alt="A stylish woman in a white dress and sun hat standing on a balcony overlooking the sea." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD9xPaRrqBXoQXSbEfc8Gk9ehl99Pgr6tRUhboLqdyiSg7-Cm-rwDvFZcj0GEOqAMY4NwQhC17F8k9slkhebUl5o9aWNVKfvIzvXD3CvDdTbDeLufjEB1-QqRZABR1GYbBleJAE9oZ0k2cc08I0ZZp0S9Qv4_pfeD_2drUe3Y6te3DDEr0d9Y5R0_O5pyz1Rl6EDvzbhpIyhs8Mir2QKRmQ4qoppp5o0nFHlShBtnqBpEKO3cTqECtY_0VlpOxxBYJuu-kcSAPUOrQ');"></div>
                </div>
                <div class="flex flex-1 items-center justify-center p-6 lg:p-10">
                    <div class="w-full max-w-md">
                        <div class="mb-8 text-center">
                            <h1 class="text-3xl font-bold tracking-tight text-text-light dark:text-text-dark mt-2">Đăng nhập</h1>
                            <p class="text-base text-text-muted-light dark:text-text-muted-dark mt-2">Chào mừng bạn đã trở lại! Hãy cùng khám phá.</p>
                        </div>
                        <form class="space-y-6" action="index.php?action=dangnhap_process" method="post">
                            <div>
                                <label class="flex flex-col">
                                    <p class="text-sm font-medium leading-normal pb-2">Tên người dùng</p>
                                    <input name="username" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark focus:border-primary focus:ring-primary h-12 px-4 text-base font-normal leading-normal placeholder:text-text-muted-light dark:placeholder:text-text-muted-dark text-text-light dark:text-text-dark" placeholder="Nhập username" type="text" value="" />
                                </label>
                            </div>
                            <div>
                                <label class="flex flex-col">
                                    <p class="text-sm font-medium leading-normal pb-2">Mật khẩu</p>
                                    <div class="relative flex w-full flex-1 items-stretch">
                                        <input name="password" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-border-light dark:border-border-dark bg-surface-light dark:bg-surface-dark focus:border-primary focus:ring-primary h-12 pl-4 pr-12 text-base font-normal leading-normal placeholder:text-text-muted-light dark:placeholder:text-text-muted-dark text-text-light dark:text-text-dark" placeholder="Nhập mật khẩu của bạn" type="password" value="" />
                                        <button class="absolute inset-y-0 right-0 flex items-center pr-4 text-text-muted-light dark:text-text-muted-dark" type="button">
                                            <span class="material-symbols-outlined">visibility</span>
                                        </button>
                                    </div>
                                </label>
                            </div>
                            <div class="flex items-center justify-end">
                                <a class="text-sm font-medium text-accent-light dark:text-accent-dark hover:underline" href="#">Quên mật khẩu?</a>
                            </div>
                            <div>
                                <button class="flex w-full items-center justify-center rounded-lg bg-primary h-12 px-6 text-base font-bold text-white shadow-sm hover:bg-opacity-90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" type="submit">Đăng nhập</button>
                            </div>
                        </form>
                        <p class="mt-8 text-center text-sm text-text-muted-light dark:text-text-muted-dark">
                            Chưa có tài khoản?
                            <a class="font-semibold text-accent-light dark:text-accent-dark hover:underline" href="index.php?action=dangky">Tạo tài khoản mới</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>