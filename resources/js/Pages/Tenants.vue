<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CreateTenantForm from '@/Components/TenantsComponent.vue';
import TenantsComponent from '@/Components/CreateTenantForm.vue';

const props = defineProps({
    tenants: Object
});
console.log(props.tenants);
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
                <div class="mt-10">
                    <table class="border-gray-200 border-2 w-full">
                        <tr class="border-gray-200 border-2">
                            <th>Nom</th>
                            <th>Nom de domaine</th>
                            <th>Nom de la BD</th>
                            <th>Date de création</th>
                        </tr>
                        <tr v-for="tenant in tenants" class="border-gray-200 border-2">
                            <td>{{ tenant.company }}</td>
                            <td>{{ tenant.domain }}</td>
                            <td> {{ tenant.db_name}}</td>
                            <td>{{ tenant.created_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
