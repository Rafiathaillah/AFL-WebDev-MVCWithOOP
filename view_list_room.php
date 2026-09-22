<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={theme:{extend:{colors:{line:'#999999',bluebox:'#b8e3f8',pink:'#c3265c'}}}};</script>
    <style>body{background:#ffffff}.shell{max-width:680px}</style>
    <title>Daftar Kamar - Hotel</title>
</head>
<body class="font-sans text-sm text-black">
    <div class="shell mx-auto mt-5 min-h-[680px] border border-gray-500">
        <header class="border-b border-gray-500 bg-bluebox px-3 py-2 font-bold">
            <nav class="flex gap-3">
                <a href="index.php" class="hover:underline">Dashboard</a><span>|</span>
                <a href="view_list_room.php" class="hover:underline">Daftar Kamar</a><span>|</span>
                <a href="view_list_order.php" class="hover:underline">Daftar Order</a>
            </nav>
        </header>
        <main class="px-7 py-5">
            <h1 class="mb-8 text-center text-3xl text-blue-800">Daftar Kamar</h1>
            <form id="room-form" class="mx-auto mb-8 flex max-w-md gap-2">
                <input required id="room-number" placeholder="Nomor kamar baru" class="h-8 flex-1 border border-gray-400 px-2">
                <button class="rounded-md border border-gray-600 bg-bluebox px-5 hover:bg-sky-200">Tambah</button>
            </form>
            <table class="mx-auto w-full max-w-md border-collapse border border-gray-400">
                <thead>
                    <tr class="bg-sky-300">
                        <th class="border border-gray-400 px-2 py-2 text-left">Nomor Kamar</th>
                        <th class="border border-gray-400 px-2 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="room-list"></tbody>
            </table>
        </main>
    </div>
    <script>
        let rooms=JSON.parse(localStorage.getItem('hotelRooms')||'["101","102","103","201","202"]');
        function save(){
            localStorage.setItem('hotelRooms',JSON.stringify(rooms));render()
        }

        function render(){
            document.getElementById('room-list').innerHTML=rooms.map((room,index)=>
            `<tr>
            <td class="border border-gray-400 px-2 py-2">${room}</td>
            <td class="border border-gray-400 px-2 py-2 text-center">
            <button onclick="editRoom(${index})" class="mr-3 text-blue-700 hover:underline">Ubah</button>
            <button onclick="deleteRoom(${index})" class="text-red-700 hover:underline">Hapus</button>
            </td>
            </tr>`)
            .join('')
        }
        function editRoom(index){const value=prompt('Nomor kamar baru:',rooms[index]);if(value&&value.trim()){rooms[index]=value.trim();save()}}
        function deleteRoom(index){if(confirm(`Hapus kamar ${rooms[index]}?`)){rooms.splice(index,1);save()}}
        document.getElementById('room-form').addEventListener('submit',event=>{event.preventDefault();const input=document.getElementById('room-number');if(!rooms.includes(input.value.trim())){rooms.push(input.value.trim());save()}input.value='' });render();
    </script>
</body>
</html>
