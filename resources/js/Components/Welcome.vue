<script setup>
import Icons from './CustomComponents/Icons.vue';
</script>

<template>
    <!-- Affichage des statistiques de licences en card -->

    <div class="grid grid-cols-4 gap-20 mx-auto">
        <div
            class="bg-white px-8 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-20">
            <div>
                <Icons name="license"/>
            </div>
            <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                <div>Total</div>
                <div class="text-5xl">72</div>
            </div>
        </div>

        <div
            class="bg-white px-8 rounded-md hover:scale-110 transition duration-700  hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-20">
            <div>
                <Icons name="valid"/>
            </div>
            <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                <div>En cours</div>
                <div class="text-5xl">23</div>
            </div>
        </div>
        <div
            class="bg-white px-8 py-10 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-20">
            <div>
                <Icons name="hourglass-middle"/>
            </div>
            <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                <div>A terme</div>
                <div class="text-5xl">8</div>
            </div>
        </div>
        <div
            class="bg-white px-8 py-10 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-20">
            <div>
                <Icons name="hourglass-end" />
            </div>
            <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                <div>Expirées</div>
                <div class="text-5xl">2</div>
            </div>
    </div>
</div></template>
