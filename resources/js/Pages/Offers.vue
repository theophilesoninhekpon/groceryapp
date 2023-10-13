<script setup>
import { ref } from "vue";
import OfferDetails from "@/Components/CustomComponents/OfferDetails.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateButton from "@/Components/CustomComponents/CreateButton.vue";
import ModalForm from "@/Components/CustomComponents/ModalForm.vue";
import OfferForm from "@/Components/CustomComponents/OfferForm.vue";
import EditOfferForm from "@/Components/CustomComponents/EditOfferForm.vue"
import Icons from "@/Components/CustomComponents/Icons.vue";

// Props du composant
const props = defineProps({
    offers: Object
});

// Variable qui conditionne l'affichage du modal
const showModal = ref(false);
const showEditModal = ref(false);
const showDetailsModal = ref(false);
const offerData = ref({});

// Afficher le modal des détails d'un formulaire
const showOfferDetails = () => {
    showDetailsModal.value = true;
}

// Affichage du formulaire de modification d'une offre
const canShowEditModalForm = () => {
    showDetailsModal.value = false;
    showEditModal.value = true; 
}
// Récupération de l'offre
const getOfferData = async (id) => {
    try {
        let response = await axios.get('offers/' + id + '/show');
        let data = response.data[0];
        offerData.value = data;
        showOfferDetails();
    } catch (error) {
        console.log(error); 
    }
}

</script>

<template>
    <!-- Layout -->
    <AppLayout title="Dashboard">
        <template #title>
            <div class="flex items-center">
                Offres
                <div class="ml-3 p-4 rounded-full bg-red-400 flex items-center justify-center text-white text-2xl w-5 h-5">
                    {{ offers.length }}
                </div>
                <div class="flex justify-end ml-10">
                    <CreateButton class="flex gap-x-2 items-center" @click="showModal = !showModal">
                        Créer
                        <Icons name="plus" />
                    </CreateButton>
                </div>
            </div>
        </template>
        <div class="py-12">

            <!-- Formulaire de création d'une offre en modal -->
            <ModalForm :show="showModal" @close="showModal = !showModal">
                <div class="py-12 relative">
                    <h2 class="text-center text-3xl font-bold mb-8"> Créer une offre </h2>
                    <OfferForm @close="showModal = !showModal" :offer="offerData"/>
                </div>
            </ModalForm>

            <!-- Formulaire de modification d'une offre en modal -->
            <ModalForm :show="showEditModal" @close="showEditModal = !showEditModal">
                <div class="py-12 relative">
                    <h2 class="text-center text-3xl font-bold mb-8"> Modifier une offre </h2>
                    <EditOfferForm @close="showEditModal = !showEditModal" :offer="offerData"/>
                </div>
            </ModalForm>

            <!-- Affichage des détails d'une offre en modal -->
            <ModalForm :show="showDetailsModal" @close="showDetailsModal = !showDetailsModal">
                <div class="py-12 relative">
                    <OfferDetails @showEditModalForm="canShowEditModalForm" @close="showDetailsModal = !showDetailsModal" :offer="offerData"/>
                </div>
            </ModalForm>

            <!-- Cartes des offres -->
            <div class="flex justify-center flex-wrap gap-x-20 gap-y-5 mt-10 mx-10">
                <button v-for="offer in offers" class="w-1/4 p-5 rounded-lg shadow-md bg-white hover:bg-red-200 transition-all duration-500" @click="getOfferData(offer.id)">
                    <div class="items-center flex flex-col items-center">
                        <div class="flex bg-red-400 items-center justify-center p-5 rounded-full shadow-md mb-5">
                            <Icons name="dollar" />
                        </div>
                        <h2 class="text-center text-2xl font-bold text-red-400 mb-5">{{ offer.description }}</h2>
                        <div class="text-center">{{ offer.duration }} mois</div>
                        <div class="text-center">{{ offer.number_of_users }} utilisateurs</div>
                    </div>
                </button>
            </div>
    </div>
</AppLayout></template>
