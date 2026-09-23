<?php
/** @var model_customer $customer */
/** @var array<string, model_room> $rooms_for_dropdown */
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
	<script>tailwind.config={theme:{extend:{colors:{line:'#999999',yellowbox:'#f4f98b',pink:'#c3265c'}}}};</script>
	<style>body{background:#ffffff}.shell{max-width:680px}</style>
	<title>Edit Customer - Hotel</title>
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
			<h1 class="mb-8 text-center text-3xl text-blue-800">Edit Customer</h1>
			<form action="controller.php?action=edit&amp;id=<?= urlencode($customer->id) ?>" method="post" class="mx-auto max-w-md">
				<label class="mb-4 flex items-center"><span class="w-28">Nama</span><input required name="nama" value="<?= htmlspecialchars($customer->nama) ?>" class="h-8 flex-1 border border-gray-400 px-2"></label>
				<label class="mb-4 flex items-center"><span class="w-28">Nomor HP</span><input required name="no_telepon" type="tel" value="<?= htmlspecialchars($customer->telepon) ?>" class="h-8 flex-1 border border-gray-400 px-2"></label>
				<div class="mb-5 flex items-start">
					<span class="w-28 pt-2">Kamar</span>
					<div class="relative flex-1">
						<input id="room-toggle" type="checkbox" class="peer sr-only">
						<label for="room-toggle" class="flex h-8 w-full cursor-pointer items-center justify-between border border-gray-400 bg-white px-2 text-left">Pilih kamar
							<span>▼</span>
						</label>
						<div class="absolute z-10 hidden max-h-48 w-full overflow-y-auto border border-gray-400 bg-white p-2 shadow peer-checked:block">
							<?php foreach ($rooms_for_dropdown as $nomor => $kamar): ?>
								<label class="block cursor-pointer px-1 py-1 hover:bg-blue-50"><input type="checkbox" name="rooms[]" value="<?= htmlspecialchars($nomor) ?>" <?= in_array((string)$nomor, array_map('strval', $customer->rooms_assigned), true) ? 'checked' : '' ?> class="mr-2">Room <?= htmlspecialchars($nomor) ?></label>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<button class="mx-auto block rounded-md border border-gray-600 bg-yellowbox px-7 py-1.5 hover:bg-sky-200" type="submit">SIMPAN</button>
			</form>
		</main>
	</div>
</body>
</html>
