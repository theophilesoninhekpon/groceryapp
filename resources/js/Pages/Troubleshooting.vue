<script setup>
import { onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";


const page = usePage();

/**
 * Au chargement du composant, on désactive tous les évènements clic
 * si l'utilisateur n'est pas un administrateur ou gestionnaire de licence
 */
 onMounted(()=>{
    if(page.props.auth.user.right !== 'Administrateur' && page.props.auth.user.right !== 'Support') {
        document.removeEventListener('click', ()=> {});
    };
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #title>
            Dépannage
        </template>
        <div class="py-12">
            <div
                class="w-full flex justify-center items-center"
            >
                Dépannage
            </div>
        </div>
    </AppLayout>
</template>
