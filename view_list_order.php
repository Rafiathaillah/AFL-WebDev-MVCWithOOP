<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={theme:{extend:{colors:{line:'#999999',bluebox:'#b8e3f8',pink:'#c3265c'}}}};</script>
    <style>body{background:#ffffff}.shell{max-width:680px}</style>
</head>
<body class="font-sans text-sm text-black">
    <div class="shell mx-auto mt-5 min-h-[680px] border border-gray-500">
        <header class="border-b border-gray-500 bg-bluebox px-3 py-2 font-bold">
            <nav class="flex gap-3">
                <a href="index.php" class="hover:underline">Dashboard</a><span>|</span>
                <a href="view_list_order.php" class="hover:underline">Daftar Order</a>
            </nav>
        </header>
        <main class="px-7 py-5"><h1 class="mb-8 text-center text-3xl text-blue-800">Daftar Order</h1>
            <table class="mx-auto w-full max-w-md border-collapse border border-gray-400">
                <thead>
                    <tr class="bg-sky-300">
                        <th class="border border-gray-400 px-2 py-2 text-center">Nomor Kamar</th>
                        <th class="border border-gray-400 px-2 py-2 text-center">Nama Customer</th>
                        <th class="border border-gray-400 px-2 py-2 text-center">Nomor HP</th>
                        <th class="border border-gray-400 px-2 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="order-list"></tbody>
            </table>
        </main>
    </div>
</body>
</html>
