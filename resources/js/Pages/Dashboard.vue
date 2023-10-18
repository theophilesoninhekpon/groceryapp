<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";

// Props du composant
const props = defineProps({
    licenses: Object,
    active_licenses: Number,
    inactive_licenses: Number,
});


</script>

<template>
    <AppLayout title="Dashboard">
        <template #title>
            Tableau de bord
        </template>
        <div class="py-12">
            <div
                class="w-full flex justify-center items-center"
            >
                <Welcome :licensesData="props"/>
            </div>
        </div>
    </AppLayout>
</template>
