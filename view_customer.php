<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
	<script>tailwind.config={theme:{extend:{colors:{line:'#999999',bluebox:'#b8e3f8',pink:'#c3265c'}}}};</script>
	<style>body{background:#ffffff}.shell{max-width:680px}</style>
	<title>Daftar Customer - Hotel</title>
</head>
<body class="font-sans text-sm text-black">
	<div class="shell mx-auto mt-5 min-h-[680px] border border-gray-500">
		<header class="border-b border-gray-500 bg-bluebox px-3 py-2 font-bold">
			<nav class="flex gap-3">
				<a href="index.php" class="hover:underline">Dashboard</a><span>|</span>
				<a href="controller.php?action=list" class="hover:underline">Daftar Order</a><span>|</span>
				<a href="controller.php?action=customers" class="hover:underline">Daftar Customer</a>
			</nav>
		</header>
		<main class="px-7 py-5">
			<h1 class="mb-8 text-center text-3xl text-blue-800">Daftar Customer</h1>
			<table class="mx-auto w-full border-collapse border border-gray-400">
				<thead>
					<tr class="bg-sky-300">
						<th class="border border-gray-400 px-2 py-2 text-center">Nama</th>
						<th class="border border-gray-400 px-2 py-2 text-center">Nomor HP</th>
						<th class="border border-gray-400 px-2 py-2 text-center">Edit Customer</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($customers)): ?>
						<tr><td colspan="3" class="border border-gray-400 px-2 py-4 text-center">Belum ada customer.</td></tr>
					<?php else: ?>
						<?php foreach ($customers as $customer): ?>
							<tr>
								<td class="border border-gray-400 px-2 py-2"><?= htmlspecialchars($customer->nama) ?></td>
								<td class="border border-gray-400 px-2 py-2"><?= htmlspecialchars($customer->telepon) ?></td>
								<td class="border border-gray-400 px-2 py-2 text-center">
									<a href="controller.php?action=edit&amp;id=<?= urlencode($customer->id) ?>" class="text-blue-700 hover:underline">Edit</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</main>
	</div>
</body>
</html>
