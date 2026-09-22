<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={theme:{extend:{colors:{line:'#999999',bluebox:'#b8e3f8',pink:'#c3265c'}}}};</script>
    <style>body{background:#ffffff}.shell{max-width:680px}</style>
    <title>Dashboard - Hotel</title>
</head>
<body class="font-sans text-sm text-black">
    <div class="shell mx-auto mt-5 min-h-[680px] border border-gray-500">
        <header class="border-b border-gray-500 bg-bluebox px-3 py-2 font-bold">
            <nav class="flex gap-3"><a href="index.php" class="hover:underline">Dashboard</a><span>|</span>
            <a href="view_list_order.php" class="hover:underline">Daftar Order</a>
        </nav>
        </header>
        <main class="px-7 py-5">
            <h1 class="mb-8 text-center text-3xl text-blue-800">Order Baru</h1>
            <form id="order-form" class="mx-auto max-w-md">
                <label class="mb-4 flex items-center"><span class="w-28">Nama</span><input required name="name" class="h-8 flex-1 border border-gray-400 px-2"></label>
                <label class="mb-4 flex items-center"><span class="w-28">Nomor HP</span><input required name="phone" type="tel" class="h-8 flex-1 border border-gray-400 px-2"></label>
                <div class="mb-5 flex items-start">
                    <span class="w-28 pt-2">Kamar</span>
                    <div class="relative flex-1">
                        <button type="button" id="room-button" class="flex h-8 w-full items-center justify-between border border-gray-400 bg-white px-2 text-left">Pilih kamar
                            <span>▼</span>
                        </button>
                        <div id="room-menu" class="absolute z-10 hidden w-full border border-gray-400 bg-white p-2 shadow">
                            <div id="room-options"></div>
                        </div>
                    </div>
                </div>
                <button class="mx-auto block rounded-md border border-gray-600 bg-bluebox px-7 py-1.5 hover:bg-sky-200" type="submit">SIMPAN</button>
            </form>
        </main>
    </div>
</body>
</html>