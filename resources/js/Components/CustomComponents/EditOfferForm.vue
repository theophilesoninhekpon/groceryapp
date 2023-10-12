<script setup>
import { onMounted } from 'vue'; 
import { useForm } from '@inertiajs/vue3';
import CreateOfferButton from './CreateOfferButton.vue';

const props = defineProps({
    offers: Object
});

// Enregistrement des données du formulaire
const form = useForm({
    description: '',
    duration: null,
    numberOfUsers: null
});

// Au rendement du composant actuel
onMounted(() => {
    if(props.offers) {
        form.description = props.offers.description;
        form.duration = props.offers.duration;
        form.numberOfUsers = props.offers.number_of_users;
    }
})

// Evènements à déclencher vers la vue parente
const emit = defineEmits(['close']);

// Fonction de soumission du formulaire
const submit = () => {
    emit('close');
    form.post(route('offers.create'));
}
</script>

<template>
    <form @submit.prevent="submit">
        <div class="w-4/5 mx-auto flex flex-col mb-5">
            <label for="description">Description</label>
            <input type="text" id="description" class="border-1  border-gray-200 rounded-lg focus:border-red-400 focus:border-1 focus:ring-0" v-model="form.description">
            <div v-if="form.errors.description" class="text-red-400">{{ form.errors.description }}</div>
        </div>
        <div class="w-4/5 mx-auto flex flex-col mb-5">
            <label for="duration">Durée <small class="text-zinc-700/75 ml-1">(en mois | 1 mois = 30 jours)</small></label>
            <input type="number" id="duration" class="border-1  border-gray-200 rounded-lg focus:border-red-400 focus:border-1 focus:ring-0" v-model="form.duration">
            <div v-if="form.errors.duration" class="text-red-400">{{ form.errors.duration }}</div>
        </div>
        <div class="w-4/5 mx-auto flex flex-col mb-5">
            <label for="number-of-users">Nombre d'utilisateurs</label>
            <input type="number" id="number-of-users" class="border-1  border-gray-200 rounded-lg focus:border-red-400 focus:border-1 focus:ring-0" v-model="form.numberOfUsers">
            <div v-if="form.errors.numberOfUsers" class="text-red-400">{{ form.errors.numberOfUsers }}</div>
        </div>
        <div class="w-4/5 mx-auto flex justify-center">
            <CreateOfferButton type="submit" :disabled="form.processing"/>
        </div>
    </form>
</template>