<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="grid grid-cols-2 grid-auto-rows gap-20">
        <Link class="bg-white p-20 rounded-md hover:bg-red-400 hover:text-gray-700 text-red-400 font-bold shadow-md">Gestion des ventes</Link>
        <Link class="bg-white p-20 rounded-md hover:bg-red-400 hover:text-gray-700 text-red-400 font-bold shadow-md">Gestion des achats</Link>
        <Link class="bg-white p-20 rounded-md hover:bg-red-400 hover:text-gray-700 text-red-400 font-bold shadow-md">Gestion des ventes</Link>
        <Link class="bg-white p-20 rounded-md hover:bg-red-400 hover:text-gray-700 text-red-400 font-bold shadow-md">Gestion des achats</Link>
    </div>
</template>
