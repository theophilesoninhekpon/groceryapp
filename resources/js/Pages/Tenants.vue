<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CreateTenantForm from '@/Components/TenantsComponent.vue';
import TenantsComponent from '@/Components/CreateTenantForm.vue';

defineProps({
    tenants: Object
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
    
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <CreateTenantForm />
                    <TenantsComponent />
                </div>
                <div>
                    <table class="border-gray-700 border-2">
                        <tr>
                            <th>Nom</th>
                            <th>Nom de domaine</th>
                            <th>Nom de la BD</th>
                            <th>Date de création</th>
                        </tr>
                        <tr v-for="tenant in tenants">
                            <td>{{ tenant.company }}</td>
                            <td>{{ tenant.domains["domain"] }}</td>
                            <td> {{ tenant.data}}</td>
                            <td>{{ tenant.created_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
