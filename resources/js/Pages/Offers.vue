<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateButton from "@/Components/CustomComponents/CreateButton.vue";
import ModalForm from "@/Components/CustomComponents/ModalForm.vue";
import FormSection from "@/Components/FormSection.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const showModal = ref(false);

</script>

<template>
    <AppLayout title="Dashboard">
        <template #title>
            Offres
        </template>
        <div class="py-12">
            <div class="w-full flex items-center">
                <div class="w-full flex justify-end mr-10">
                    <CreateButton class="items-center" @click="showModal = !showModal"> Créer une offre 
                        <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24"
                            stroke-width="2" stroke="#ffffff" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </CreateButton>
                </div>
            </div>
            <ModalForm :show="showModal" @close="showModal = !showModal">
                    <p class="py-12">
                        <FormSection>
                            <template #title>Formulaire</template>
                            <template #description> Description du formulaire</template>
                            <template #form>
                                <div>
                                    <InputLabel>Nom</InputLabel>
                                    <TextInput></TextInput>
                                </div>
                                <div>
                                    <InputLabel>Prix</InputLabel>
                                    <TextInput></TextInput>
                                </div>
                            </template>
                            <template #actions></template>
                        </FormSection>
                    </p>
            </ModalForm>
        </div>
    </AppLayout>
</template>
