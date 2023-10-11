<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
</script>

<template>
    <AppLayout title="Dashboard">
        <template #title>
            Gestion des licences
        </template>
        <div class="py-12">
            <div
                class="w-full flex justify-center items-center"
            >
                Licences
            </div>
        </div>
    </AppLayout>
</template>
