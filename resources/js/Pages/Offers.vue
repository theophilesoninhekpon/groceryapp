<script setup>

import { ref, onMounted } from "vue";
import NavDropdown from "@/Components/CustomComponents/NavDropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateButton from "@/Components/CustomComponents/CreateButton.vue";
import ModalForm from "@/Components/CustomComponents/ModalForm.vue";
import OfferForm from "@/Components/CustomComponents/OfferForm.vue";
import EditOfferForm from "@/Components/CustomComponents/EditOfferForm.vue"
import Icons from "@/Components/CustomComponents/Icons.vue";

// Props du composant
defineProps({
    offers: Object
});

// Variable qui conditionne l'affichage du modal
const showModal = ref(false);
const showEditModal = ref(false);
const offerData = ref({});

// Afficher le modal du formulaire de mise à jour
const showEditForm = () => {
    showEditModal.value = !showEditModal.value;
}

// Récupération de l'offre
const getOfferData = async (id) => {
    try {
        let response = await axios.get('offers/' + id + '/show');
        let data = response.data[0];
        offerData.value = data;
    } catch (error) {
        console.log(error); 
    }
}

</script>

<template>
    <!-- Layout -->
    <AppLayout title="Dashboard">
        <template #title>
            Offres
        </template>
        <div class="py-12">
            <div class="w-full flex items-center">
                <div class="w-full flex justify-end mr-10">
                    <CreateButton class="flex gap-x-2 items-center" @click="showModal = !showModal">
                        Créer une offre
                        <Icons name="plus" />
                    </CreateButton>
                </div>
            </div>

            <!-- Formulaire de création d'une offre en modal -->
            <ModalForm :show="showModal" @close="showModal = !showModal">
                <div class="py-12 relative">
                    <h2 class="text-center text-3xl font-bold mb-8"> Créer une offre </h2>
                    <OfferForm @close="showModal = !showModal"/>
                </div>
            </ModalForm>

            <!-- Formulaire de modification d'une offre en modal -->
            <ModalForm :show="showEditModal" @close="showEditModal = !showEditModal">
                <div class="py-12 relative">
                    <h2 class="text-center text-3xl font-bold mb-8"> Modifier une offre </h2>
                    <EditOfferForm @close="showEditModal = !showEditModal" :offers="offerData"/>
                </div>
            </ModalForm>

            <!-- Cartes des offres -->
            <div class="flex justify-center flex-wrap gap-x-10 gap-y-5 mt-10">
                <div v-for="offer in offers" class="w-1/4 p-5 rounded-lg shadow-md bg-white">

                        <!-- Menu d'édition (Modifier, suppression) -->
                        <div class="flex justify-end -me-3">
                            <NavDropdown>
                                <template #trigger>
                                    <div class="cursor-pointer">
                                       <Icons name="vertical-menu" />
                                    </div>
                                </template>
                                <template #content>
                                    <DropdownLink @click="getOfferData(offer.id)">
                                        Modifier
                                    </DropdownLink>
                                    <DropdownLink >
                                        Supprimer
                                    </DropdownLink>
                                </template>
                            </NavDropdown>
                        </div>
    
                    <div class="items-center flex flex-col items-center">
                        <div class="flex bg-red-400 items-center justify-center p-5 rounded-full shadow-md mb-5">
                            <Icons name="dollar" />
                        </div>
                        <h2 class="text-center text-2xl font-bold text-red-400 mb-5">{{ offer.description }}</h2>
                        <div class="text-center">{{ offer.duration }} mois</div>
                        <div class="text-center">{{ offer.number_of_users }} utilisateurs</div>
                    </div>
                </div>
            </div>
    </div>
</AppLayout></template>
