<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={
        theme:{
            extend:{
                colors:{
                    line:'#999999',
                    yellowbox:'#f4f98b',
                    pink:'#c3265c'
                }
            }
        }
    };</script>
    <style>body{background:#ffffff}.shell{max-width:680px}</style>
</head>
<body class="font-sans text-sm text-black">
    <div class="shell mx-auto mt-5 min-h-[680px] border border-gray-500">
        <header class="border-b border-gray-500 bg-yellowbox px-3 py-2 font-bold">
            <nav class="flex gap-3">
                <a href="index.php" class="hover:underline">Dashboard</a><span>|</span>
                <a href="controller.php?action=list" class="hover:underline">Daftar Order</a><span>|</span>
                <a href="controller.php?action=customers" class="hover:underline">Daftar Customer</a>
            </nav>
        </header>
        <main class="px-7 py-5">
            <h1 class="mb-8 text-center text-3xl text-blue-800">Daftar Order</h1>
            <table class="mx-auto w-full max-w border-collapse border border-gray-400">
                <thead>
                    <tr class="bg-yellowbox">
                        <th class="border border-gray-400 px-2 py-2 text-center">Nomor Kamar</th>
                        <th class="border border-gray-400 px-2 py-2 text-center">Nama Customer</th>
                        <th class="border border-gray-400 px-2 py-2 text-center">Nomor HP</th>
                        <th class="border border-gray-400 px-2 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                    <tbody id="order-list">
                        <?php if (empty($customers)): ?>
                            <tr><td colspan="4" class="border border-gray-400 px-2 py-4 text-center">Belum ada order.</td></tr>
                        <?php else: ?>
                            <?php foreach ($customers as $customer): ?>
                                <?php foreach ($customer->rooms_assigned as $room): ?>
                                    <tr>
                                        <td class="border border-gray-400 px-2 py-2"><?= htmlspecialchars($room) ?></td>
                                        <td class="border border-gray-400 px-2 py-2"><?= htmlspecialchars($customer->nama) ?></td>
                                        <td class="border border-gray-400 px-2 py-2"><?= htmlspecialchars($customer->telepon) ?></td>
                                        <td class="border border-gray-400 px-2 py-2 text-center">
                                            <a href="controller.php?action=delete&amp;room=<?= urlencode($room) ?>" class="text-red-700 hover:underline" onclick="return confirm('Hapus order kamar ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
            </table>
        </main>
    </div>
</body>
</html>
