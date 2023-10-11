<script setup>

</script>

<template>
    <!-- Affichage des statistiques de licences en card -->

    <div class="grid grid-cols-4 gap-20 mx-auto">
        <div
            class="bg-white px-8 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-20">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="#3f3f46" fill="none" stroke-linecap="round"
                    stroke-linejoin="round" class="w-24 h-24">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11" />
                    <line x1="9" y1="7" x2="13" y2="7" />
                    <line x1="9" y1="11" x2="13" y2="11" />
                </svg>
            </div>
            <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                <div>Total</div>
                <div class="text-5xl">72</div>
            </div>
        </div>

        <div
            class="bg-white px-8 rounded-md hover:scale-110 transition duration-700  hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-20">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#4ade80"
                    class="w-24 h-24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                <div>En cours</div>
                <div class="text-5xl">23</div>
            </div>
        </div>
        <div
            class="bg-white px-8 py-10 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-20">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="w-20 h-20" fill="#fb923c">
                    <path
                        d="M0 24C0 10.7 10.7 0 24 0H360c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V67c0 40.3-16 79-44.5 107.5L225.9 256l81.5 81.5C336 366 352 404.7 352 445v19h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H24c-13.3 0-24-10.7-24-24s10.7-24 24-24h8V445c0-40.3 16-79 44.5-107.5L158.1 256 76.5 174.5C48 146 32 107.3 32 67V48H24C10.7 48 0 37.3 0 24zM110.5 371.5c-3.9 3.9-7.5 8.1-10.7 12.5H284.2c-3.2-4.4-6.8-8.6-10.7-12.5L192 289.9l-81.5 81.5zM284.2 128C297 110.4 304 89 304 67V48H80V67c0 22.1 7 43.4 19.8 61H284.2z" />
                </svg>
            </div>
            <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                <div>A terme</div>
                <div class="text-5xl">8</div>
            </div>
        </div>
        <div
            class="bg-white px-8 py-10 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-20">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="w-20 h-20" fill="#ef4444">
                    <path
                        d="M32 0C14.3 0 0 14.3 0 32S14.3 64 32 64V75c0 42.4 16.9 83.1 46.9 113.1L146.7 256 78.9 323.9C48.9 353.9 32 394.6 32 437v11c-17.7 0-32 14.3-32 32s14.3 32 32 32H64 320h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V437c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H320 64 32zM96 75V64H288V75c0 25.5-10.1 49.9-28.1 67.9L192 210.7l-67.9-67.9C106.1 124.9 96 100.4 96 75z" />
                </svg>
            </div>
            <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                <div>Expirées</div>
                <div class="text-5xl">2</div>
            </div>
    </div>
</div></template>
