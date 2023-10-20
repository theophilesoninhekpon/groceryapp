<script setup>
import { ref, onMounted } from "vue";
import { usePage } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateButton from "@/Components/CustomComponents/CreateButton.vue";
import ModalForm from "@/Components/CustomComponents/ModalForm.vue";
import LicenseForm from "@/Components/CustomComponents/LicenseForm.vue";
import Icons from "@/Components/CustomComponents/Icons.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { router } from "@inertiajs/vue3";

// Props du composant
const props = defineProps({
    licenses: Object,
    offers: Object,
    active_licenses: Number,
    inactive_licenses: Number,
});


const page = usePage();
const showModal = ref(false);
const showOffersModal = ref(false);
const availableOffers = ref({});
const idOfLicenseToUpdate = ref(0);


/**
 * Au chargement du composant, on désactive tous les évènements clic
 * si l'utilisateur n'est pas un administrateur ou gestionnaire de licence
 */
onMounted(()=>{
    if(page.props.auth.user.right !== 'Administrateur' && page.props.auth.user.right !== 'Gestionnaire de licence') {
        document.removeEventListener('click', ()=> {});
    };
});


/**
 * Fonction de récupération des offres disponibles pour un changement
 */
const getOffers = (actualLicense) => {

    // Stocker l'id de la license à modifier
    idOfLicenseToUpdate.value = actualLicense.id;

    // Supprimer l'offre de la licence en cours de la liste des offres et stocket dans un autre tableau
    availableOffers.value = [...props.offers];
    let offerIndex = availableOffers.value.findIndex((offer) => offer.description === actualLicense.offer);

    // Si l'offre à changer existe
    if (offerIndex !== -1) {
        availableOffers.value.splice(offerIndex, 1);
    }

    showOffersModal.value = true;

};


/**
 * Fonction de changement de l'offre actuelle
 * */ 
const changeLicenseOffer = (offer) => {

    router.patch(route('licenses.update', idOfLicenseToUpdate.value), {offer: offer});

    showOffersModal.value = false;
    
}

/**
 * Fonction de désactivation d'une licence
 * */ 
const disableLicense = (license) => {

    router.patch(route('licenses.disable', license));

}



</script>

<template>
    <AppLayout title="Dashboard">
        <template #title>
            <div class="flex items-center">
                Gestion des licences
                <div class="flex justify-end ml-7">
                    <CreateButton class="flex gap-x-1 items-center" @click="showModal = !showModal">
                        Acheter
                        <Icons name="plus" />
                    </CreateButton>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="w-full flex justify-center items-center">
                <!-- Affichage des statistiques de licences en card -->

                <div class="w-full mx-28 flex justify-around gap-x-14 gap-y-5 mt-4 ">
                    <div
                        class="w-1/3 bg-white px-8 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-orange-400 font-bold shadow-md flex items-center justify-between space-x-10">
                        <div class="w-1/2">
                            <Icons name="license" />
                        </div>
                        <div class=" w-1/2 flex flex-col items-end justify-center gap-y-2 text-zinc-700">
                            <div>Total</div>
                            <div class="text-5xl">{{ licenses.length }}</div>
                        </div>
                    </div>

                    <div
                        class=" w-1/3 bg-white px-8 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-orange-400 font-bold shadow-md flex items-center justify-between space-x-10">
                        <div class="w-1/2">
                            <Icons name="valid" />
                        </div>
                        <div class="w-1/2 flex flex-col items-end justify-center gap-y-2 text-zinc-700">
                            <div>Actives</div>
                            <div class="text-5xl">
                                {{ active_licenses }}
                            </div>
                        </div>
                    </div>
                    <div
                        class=" w-1/3 bg-white px-8 py-10 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-orange-400 font-bold shadow-md flex items-center justify-between space-x-10">
                        <div class="w-1/2">
                            <Icons name="hourglass-end" />
                        </div>
                        <div class="w-1/2 flex flex-col items-end justify-center gap-y-2 text-zinc-700">
                            <div>Inactives</div>
                            <div class="text-5xl">
                                {{ inactive_licenses }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire de création d'une offre en modal -->
            <ModalForm :show="showModal" @close="showModal = !showModal">
                <div class="py-12 relative">
                    <h2 class="text-center text-3xl font-bold mb-8">
                        Acheter une licence
                    </h2>
                    <LicenseForm @close="showModal = !showModal" :offersData="offers" />
                </div>
            </ModalForm>

            <!-- Modal de changement d'offre -->
            <ModalForm :show="showOffersModal" @close="showOffersModal = !showOffersModal">
                <!-- @closeOffersModal="showOffersModal = !showOffersModal" -->
                <div class="py-12 relative">
                    <h2 class="text-center text-3xl font-bold mb-8">Offres</h2>
                    <div class="flex flex-col items-center gap-y-3">
                        <button v-for="offer in availableOffers" type="button"
                            class="w-2/5 bg-orange-400 px-3 py-2 rounded-md shadow-sm" @click="changeLicenseOffer(offer)">
                            {{ offer.description }}
                        </button>
                    </div>
                </div>
            </ModalForm>

            <div class=" mt-10 mx-28 board-container"> <!-- ajouter overflow-auto -->
                <table class="border-gray-200 border-2 w-full shadow-sm rounded-md">
                    <tr class="border-gray-200 border-2 p-3 text-center">
                        <th class="border-gray-200 border-2 px-3 py-3">N°</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Offre</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Client</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Statut</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Activée le</th>
                        <th class="border-gray-200 border-2 py-3">Action</th>
                        <!-- <th class="border-gray-200 border-2 px-3 py-3"></th> -->
                    </tr>
                    <tr v-for="(license, index) in licenses" class="border-gray-200 border-2 text-center">
                        <td class="border-gray-200 border-2 px-3 py-3">
                            {{ index + 1 }}
                        </td>
                        <td class="border-gray-200 border-2 px-3 py-3">
                            {{ license.offer }}
                        </td>
                        <td class="border-gray-200 border-2 px-3 py-3">
                            {{ license.company }}
                        </td>
                        <td class="border-gray-200 border-2 px-3 py-3">
                            {{ license.status }}
                        </td>
                        <td class="border-gray-200 border-2 px-3 py-3">
                            {{ license.purchased_at }}
                        </td>
                        <!-- <td class="border-gray-200 border-2 p-3"></td> -->
                        <td class="border-gray-200 border-2 py-3 ">
                            <div class="flex justify-center">
                                <Dropdown class="ring-0">
                                <template #trigger>
                                    <div class="cursor-pointer">
                                        <Icons name="edit" />
                                    </div>
                                </template>
                                <template #content>
                                    <DropdownLink as="button" @click="getOffers(license)">
                                        Changer d'offre
                                    </DropdownLink>
                                    <DropdownLink as="button" @click="disableLicense(license)">
                                        Désactiver
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

        </div>

        <!-- Modal du formulaire de création d'une licence -->
    </AppLayout>
</template>

<style>
/* Style du scrollbar */

.board-container {
    max-height: 28rem;
}

.board-container::-webkit-scrollbar {
    background: transparent;
    width: 10px;
}

.board-container::-webkit-scrollbar-track {
    background: #d4d4d4;
    border-radius: 40px;
}

.board-container::-webkit-scrollbar-thumb {
    border-radius: 40px;
    background: #aaaaaa;
}
</style>