<script setup>
import { ref } from 'vue';
import Icons from './Icons.vue';

const props = defineProps({
    name: String,
    type: String, 
    disabled: Boolean
});

const hover = ref(false);
const noHover = ref(true);

// Changement de la couleur du bouton et de l'icône au survol du bouton
const onHover = () => {
    hover.value = true;
    noHover.value = false;
    return hover;
}

// Changement de la couleur du bouton et de l'icône hors du bouton
const onOutHover = () => {
    hover.value = false;
    noHover.value = true;
    return noHover;
}

</script>

<template>
    <button type="type" @mouseover="onHover" @mouseout="onOutHover" :disabled="disabled" class="transition-all duration-200 cursor-pointer flex gap-x-2 items-center shadow-md border-2 border-red-400 border-gray-700 rounded-lg bg-red-400 px-6 py-3 text-white hover:border-2 hover:border-red-400 hover:bg-white hover:text-red-400">
            {{ name }}
            <Icons v-if="hover" name="save-red-400"/>
            <Icons v-else="noHover" name="save-white" />
    </button>
</template>