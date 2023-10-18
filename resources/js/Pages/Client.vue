<script setup>
import { ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import ModalForm from "@/Components/CustomComponents/ModalForm.vue";
import Icons from "@/Components/CustomComponents/Icons.vue";

// Props du composant
const props = defineProps({
    clients: Object
});

const client = ref({});
const showClientDetailsModal = ref(false);

const getCompanyInfos = (id) => {

    client.value = props.clients.find((client) => client.id === id);
    showClientDetailsModal.value = true;

}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #title>
            <div class="flex items-center">
                Clients
                <div class="ml-3 p-4 rounded-full bg-red-400 flex items-center justify-center text-white text-2xl w-5 h-5">
                    {{ clients.length }}
                </div>
            </div>
        </template>

        <div class="py-12">

            <!-- Modal de changement d'offre -->
            <ModalForm :show="showClientDetailsModal" @close="showClientDetailsModal = !showClientDetailsModal">
                <!-- @closeOffersModal="showOffersModal = !showOffersModal" -->
                <div class="py-12 relative">
                    <div class="w-4/5 mx-auto flex flex-col mb-5 gap-y-10">
                        <h1><strong>Nom:</strong> {{ client.company }}</h1>
                        <p> <strong>Offre:</strong> {{ client.offer }}</p>
                        <p> <strong>Base de données:</strong> {{ client.database }}</p>
                        <p> <strong>Domaine:</strong> {{ client.domain }} </p>   
                    </div>
                </div>
            </ModalForm>

            <div class=" mt-10 mx-28 board-container"> <!-- ajouter overflow-auto -->
                <table class="border-gray-200 border-2 w-full shadow-sm rounded-md">
                    <tr class="border-gray-200 border-2 p-3 text-center">
                        <th class="border-gray-200 border-2 px-3 py-3">N°</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Nom</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Offre</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Statut</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Base de données</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Nom de domaine</th>
                        <th class="border-gray-200 border-2 px-3 py-3">Action</th>
                        <!-- <th class="border-gray-200 border-2 py-3">Action</th> -->
                        <!-- <th class="border-gray-200 border-2 px-3 py-3"></th> -->
                    </tr>
                    <tr v-for="(client, index) in clients" class="border-gray-200 border-2 text-center">
                        <td class="border-gray-200 border-2 px-3 py-3">
                            {{ index }}
                        </td>
                        <td class="border-gray-200 border-2 px-3 py-3">
                            {{ client.company }}
                        </td>
                        <td class="border-gray-200 border-2 px-3 py-3">
                            {{ client.offer }}
                        </td>
                        <td class="border-gray-200 border-2 px-3 py-3" >
                            <div class="flex justify-center">
                                <Icons v-if="client.status === 'ACTIVE'" name="active" />
                                <Icons v-if="client.status === 'INACTIVE'" name="danger" />
                            </div>
                        </td>
                        <td class="border-gray-200 border-2 px-3 py-3">
                            {{ client.database }}
                        </td>
                        <td class="border-gray-200 border-2 px-3 py-3">
                            {{ client.domain }}
                        </td>
                        <td class="border-gray-200 border-2 px-3 py-3">
                            <button @click="getCompanyInfos(client.id)">
                                <Icons name="eye" />
                            </button>
                        </td>
                        <!-- <td class="border-gray-200 border-2 p-3"></td>
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
                                    <DropdownLink as="button" @click="disableLicense(license)">
                                        Désactiver
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </td> -->
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