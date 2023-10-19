<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-orange-600 dark:text-orange-400">
            {{ message }}
        </p>
    </div>
</template>
