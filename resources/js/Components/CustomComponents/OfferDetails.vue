<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    offer: Object
});

const emit = defineEmits(['showEditModalForm', 'close']);

</script>

<template>
    <div class="w-4/5 mx-auto flex flex-col mb-5 gap-y-10">
        <h1>Nom: {{ offer.description }}</h1>
        <p>Nombre d'utilisateurs: {{ offer.number_of_users }}</p>
        <!-- Menu d'édition (Modifier, suppression) -->
        <div class="flex gap-x-2">
            <button @click="emit('showEditModalForm')" class="w-1/2 text-center bg-green-500 py-2 rounded-md text-white">
            Modifier
            </button>
            <Link as="button" @click="emit('close')" :href="route('offers.delete', offer)" method="delete" class="w-1/2 text-center bg-red-500  py-2 rounded-md text-white">
            Supprimer
            </Link>
        </div>
    </div>
</template>