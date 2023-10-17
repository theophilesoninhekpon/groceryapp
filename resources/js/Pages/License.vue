<script setup>
import { ref, onMounted } from "vue";
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
    ongoing_licenses: Number,
    expiring_licenses: Number,
    expired_licenses: Number,
});

// const licensesData = ref(props.licenses);
const showModal = ref(false);
const showOffersModal = ref(false);
const availableOffers = ref({});
const showExpiredNotification = ref(false);
const showExpiringNotification = ref(false);
const ongoingLicensesNumber = ref(0);
const expiringLicensesNumber = ref(0);
const expiredLicensesNumber = ref(0);
const idOfLicenseToUpdate = ref(0);


// const emit = defineEmits(["closeOffersModal"]);


// Au chargement du composant
onMounted(() => {

    ongoingLicensesNumber.value = props.ongoing_licenses;
    expiringLicensesNumber.value = props.expiring_licenses;
    expiredLicensesNumber.value = props.expired_licenses;

})


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

}

// Gestion des données reçues au broadcast d'une licence créée
Echo.private(`licenseIsCreated`)
    .listen('LicenseCreated', (e) => {

        ongoingLicensesNumber.value = props.licenses.filter((license) => license.status === 'ACTIVE').length;

    });


// Gestion des données reçues au broadcast d'une licence à terme
Echo.private(`licenseIsExpiring`)
    .listen('ExpiringLicense', (e) => {

        let expiringLicense = e.license;

        props.licenses.map((license) => {
            if (license.id === expiringLicense.id) {
                license.status = expiringLicense.status;
            }
        });

        expiringLicensesNumber.value = props.licenses.filter((license) => license.status === 'EXPIRING').length;

    });


// Gestion des données reçues au broadcast d'une licence expirée
Echo.private(`licenseIsExpired`)
    .listen('ExpiredLicense', (e) => {

        let expiredLicense = e.license;

        props.licenses.map((license) => {
            if (license.id === expiredLicense.id) {
                license.status = expiredLicense.status;
            }
        });

        ongoingLicensesNumber.value = props.licenses.filter((license) => license.status === 'ACTIVE').length;
        expiringLicensesNumber.value = props.licenses.filter((license) => license.status === 'EXPIRING').length;
        expiredLicensesNumber.value = props.licenses.filter((license) => license.status === 'INACTIVE').length;

    });



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

                <div class="w-4/5 flex justify-center gap-x-10 gap-y-5 mt-10 ">
                    <div
                        class="w-1/4 bg-white px-8 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between space-x-10">
                        <div class="w-1/2">
                            <Icons name="license" />
                        </div>
                        <div class=" w-1/2 flex flex-col items-end justify-center gap-y-2 text-zinc-700">
                            <div>Total</div>
                            <div class="text-5xl">{{ licenses.length }}</div>
                        </div>
                    </div>

                    <div
                        class=" w-1/4 bg-white px-8 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between space-x-10">
                        <div class="w-1/2">
                            <Icons name="valid" />
                        </div>
                        <div class="w-1/2 flex flex-col items-end justify-center gap-y-2 text-zinc-700">
                            <div>En cours</div>
                            <div class="text-5xl">
                                {{ ongoingLicensesNumber }}
                            </div>
                        </div>
                    </div>
                    <div
                        class=" w-1/4 bg-white px-8 py-10 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between space-x-10">
                        <div class="w-1/2">
                            <Icons name="hourglass-middle" />
                        </div>
                        <div class="w-1/2 flex flex-col items-end justify-center gap-y-2 text-zinc-700">
                            <div>A terme</div>
                            <div class="text-5xl">
                                {{ expiringLicensesNumber }}
                            </div>
                        </div>
                    </div>
                    <div
                        class=" w-1/4 bg-white px-8 py-10 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between space-x-10">
                        <div class="w-1/2">
                            <Icons name="hourglass-end" />
                        </div>
                        <div class="w-1/2 flex flex-col items-end justify-center gap-y-2 text-zinc-700">
                            <div>Expirées</div>
                            <div class="text-5xl">
                                {{ expiredLicensesNumber }}
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
                            class="w-2/5 bg-red-400 px-3 py-2 rounded-md shadow-sm" @click="changeLicenseOffer(offer)">
                            {{ offer.description }}
                        </button>
                    </div>
                </div>
            </ModalForm>

            <div class="mt-10 mx-28 board-container overflow-auto">
                <table class="border-gray-200 border-2 w-full shadow-sm rounded-md">
                    <tr class="border-gray-200 border-2 p-3 text-center">
                        <th class="border-gray-200 border-2 px-3 py-3">N°</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Offre</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Client</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Statut</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Activée le</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Expire le</th>
                        <th class="border-gray-200 border-2 py-3">Action</th>
                        <!-- <th class="border-gray-200 border-2 px-3 py-3"></th> -->
                    </tr>
                    <tr v-for="license in licenses" class="border-gray-200 border-2 text-center">
                        <td class="border-gray-200 border-2 px-3 py-3">
                            {{ license.id }}
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
                        <td class="border-gray-200 border-2 px-3 py-3">
                            {{ license.expires_at }}
                        </td>
                        <!-- <td class="border-gray-200 border-2 p-3"></td> -->
                        <td class="border-gray-200 border-2 py-3 flex justify-center">
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
                                    <DropdownLink as="button">
                                        Désactiver
                                    </DropdownLink>
                                    <DropdownLink as="button">
                                        Renouveler
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                            <!-- <button class="py-2 px-5 bg-green-500 rounded-md text-white " @click="getOffers(license.offer)">
                                Changer d'offre
                            </button> -->
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