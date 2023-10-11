<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type"
        class="inline-flex items-center px-4 py-3 bg-zinc-700 
        border border-transparent rounded-xl font-semibold text-xs 
        text-white uppercase tracking-widest hover:bg-zinc-700 focus:bg-zinc-700 
        active:bg-zinc-900 focus:outline-none focus:ring-1 focus:ring-red-400 
        focus:ring-offset-2 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
