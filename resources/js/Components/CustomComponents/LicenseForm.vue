<script setup>
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from './PrimaryButton.vue';

defineProps({
    offersData: Object
});

// Enregistrement des données du formulaire
const form = useForm({
    company: '',
    offer: null
});

// Evènements à déclencher vers la vue parente
const emit = defineEmits(['close']);

// Fonction de soumission du formulaire
const submit = () => {
    emit('close');
    form.post(route('licenses.create'));
}
</script>

<template>
    <form @submit.prevent="submit">
        <div class="w-4/5 mx-auto flex flex-col mb-5">
            <label for="company-name">Nom de l'entreprise</label>
            <input type="text" id="company-name" class="border-1  border-gray-200 rounded-lg focus:border-red-400 focus:border-1 focus:ring-0" v-model="form.company">
            <div v-if="form.errors.company" class="text-red-400">{{ form.errors.company }}</div>
        </div>
        <div class="w-4/5 mx-auto flex flex-col mb-5">
            <label for="offers">Offre</label>
            <select v-model="form.offer" id="offers" class="border-1  border-gray-200 rounded-lg focus:border-red-400 focus:border-1 focus:ring-0">
                <option v-for="offer in offersData" :value="offer.id">{{offer.description}}</option>
            </select>
            <div v-if="form.errors.offer" class="text-red-400">{{ form.errors.offer }}</div>
        </div>
        <div class="w-4/5 mx-auto flex justify-center">
            <PrimaryButton name="Enregistrer" type="submit" :disabled="form.processing"/>
        </div>
    </form>
</template>