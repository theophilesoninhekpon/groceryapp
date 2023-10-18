<script setup>
import Icons from './CustomComponents/Icons.vue';

defineProps({
    licensesData: Object
});

</script>

<template>
    <!-- Affichage des statistiques de licences en card -->

    <div class="flex justify-center gap-10 mx-10">
        <div
            class="bg-white px-8 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-72">
            <div>
                <Icons name="license"/>
            </div>
            <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                <div>Total</div>
                <div class="text-5xl"> {{ licensesData.licenses }} </div>
            </div>
        </div>

        <div
            class="bg-white px-8 rounded-md hover:scale-110 transition duration-700  hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-72">
            <div>
                <Icons name="valid"/>
            </div>
            <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                <div>Actives</div>
                <div class="text-5xl"> {{ licensesData.active_licenses }} </div>
            </div>
        </div>
    
        <div
            class="bg-white px-8 py-10 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-72">
            <div>
                <Icons name="hourglass-end" />
            </div>
            <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                <div>Inactives</div>
                <div class="text-5xl"> {{ licensesData.inactive_licenses }} </div>
            </div>
    </div>
</div>
</template>
