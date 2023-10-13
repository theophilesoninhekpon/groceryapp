<script setup>
import { ref } from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateButton from "@/Components/CustomComponents/CreateButton.vue";
import ModalForm from "@/Components/CustomComponents/ModalForm.vue";
import LicenseForm from "@/Components/CustomComponents/LicenseForm.vue";
import Icons from '@/Components/CustomComponents/Icons.vue';

// Props du composant
const props = defineProps({
    licenses: Object,
    offers: Object,
    ongoing_licenses: Object,
    expiring_licenses: Object,
    expired_licenses: Object
});

const showModal = ref(false);

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

                <div class="grid grid-cols-4 gap-20 mx-auto">
                    <div
                        class="bg-white px-8 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-20">
                        <div>
                            <Icons name="license" />
                        </div>
                        <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                            <div>Total</div>
                            <div class="text-5xl"> {{ licenses.length }}</div>
                        </div>
                    </div>

                    <div
                        class="bg-white px-8 rounded-md hover:scale-110 transition duration-700  hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-20">
                        <div>
                            <Icons name="valid" />
                        </div>
                        <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                            <div>En cours</div>
                            <div class="text-5xl"> {{ ongoing_licenses.length }}</div>
                        </div>
                    </div>
                    <div
                        class="bg-white px-8 py-10 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-20">
                        <div>
                            <Icons name="hourglass-middle" />
                        </div>
                        <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                            <div>A terme</div>
                            <div class="text-5xl">{{ expiring_licenses.length }}</div>
                        </div>
                    </div>
                    <div
                        class="bg-white px-8 py-10 rounded-md hover:scale-110 transition duration-700 hover:text-gray-700 text-red-400 font-bold shadow-md flex items-center justify-between gap-x-20">
                        <div>
                            <Icons name="hourglass-end" />
                        </div>
                        <div class='flex flex-col items-end justify-center gap-y-2 text-zinc-700'>
                            <div>Expirées</div>
                            <div class="text-5xl">{{ expired_licenses.length }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire de création d'une offre en modal -->
            <ModalForm :show="showModal" @close="showModal = !showModal">
                <div class="py-12 relative">
                    <h2 class="text-center text-3xl font-bold mb-8"> Créer une offre </h2>
                    <LicenseForm @close="showModal = !showModal" :offersData="offers" />
                </div>
            </ModalForm>

            <div class="mt-10 mx-28">
                <table class="border-gray-200 border-2 w-full shadow-sm rounded-md">
                    <tr class="border-gray-200 border-2 p-3 text-center">
                        <th class="border-gray-200 border-2 p-3">N°</th>
                        <th class="border-gray-200 border-2 p-3">Offre</th>
                        <th class="border-gray-200 border-2 p-3">Client</th>
                        <th class="border-gray-200 border-2 p-3">Statut</th>
                        <th class="border-gray-200 border-2 p-3">Activée le</th>
                        <th class="border-gray-200 border-2 p-3">Expire le</th>
                        <th class="border-gray-200 border-2 p-3">Action</th>
                        <th class="border-gray-200 border-2 p-3"></th>
                    </tr>
                    <tr v-for="license in licenses" class="border-gray-200 border-2 text-center">
                        <td  class="border-gray-200 border-2 p-3" >{{ license.id }}</td>
                        <td  class="border-gray-200 border-2 p-3" >{{ license.offer }}</td>
                        <td  class="border-gray-200 border-2 p-3" > {{ license.company }}</td>
                        <td  class="border-gray-200 border-2 p-3" >{{ license.status }}</td>
                        <td  class="border-gray-200 border-2 p-3" > {{ license.purchased_at }}</td>
                        <td  class="border-gray-200 border-2 p-3" >{{ license.expires_at }}</td>
                        <td  class="border-gray-200 border-2 p-3" ></td>
                        <td  class="border-gray-200 border-2 p-3" >
                            <button class="p-3 outline-green-300">Changer d'offre</button>
                        </td>
                    </tr>

                    <!-- 'id' => $license->id,
                    'offer'=> Offer::find($license->offers_id),
                    company
                    'status' => $license->status,
                    'purchased_at' => $license->created_at,
                    'expires_at' => $license->expires_at, -->
                </table>
            </div>

        </div>

        <!-- Modal du formulaire de création d'une licence -->

    </AppLayout>
</template>
