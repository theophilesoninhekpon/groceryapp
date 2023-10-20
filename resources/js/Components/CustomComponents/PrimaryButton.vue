<script setup>
import { ref } from 'vue';
import Icons from './Icons.vue';

const props = defineProps({
    name: String,
    type: String, 
    disabled: Boolean
});

</script>

<template>
    <button type="type" :disabled="disabled" class="transition-all duration-200 cursor-pointer flex gap-x-2 items-center shadow-md border-2 border-orange-400 border-gray-700 rounded-lg bg-orange-400 px-6 py-3 text-white hover:border-2 hover:border-orange-400 hover:bg-white hover:text-orange-400">
            {{ name }}
    </button>
</template>