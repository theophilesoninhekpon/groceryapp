<script setup>
import {useForm} from '@inertiajs/vue3';

// Crée le formulaire d'enregistrement
const form = useForm({
    offers_id: '',
    company: ''
});

// Soumet le formulaire d'enregistrement
const submit = () => {
    form.post(route('tenants.create'));
}

</script>

<template>

    <!-- Formulaire de création d'un client -->
    <form @submit.prevent="submit">
        <div>
            <select v-model="form.offers_id">
                <option value="1">Offre Basique</option>
                <option value="2">Offre premium</option>
                <option value="3">Offre Jaguar</option>
                <option value="4">Offre personnlisée</option>
            </select>
        </div>
        <div>
            <label for="entreprise">Nom de l'entreprise</label>
            <input type="text" id="entreprise" v-model="form.company">
        </div>
        <input type="submit" value="Enregistrer">
    </form>

    <!-- Tableau affichant les clients -->
</template>