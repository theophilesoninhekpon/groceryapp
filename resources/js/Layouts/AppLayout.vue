<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(
        route("current-team.update"),
        {
            team_id: team.id,
        },
        {
            preserveState: false,
        }
    );
};

const logout = () => {
    router.post(route("logout"));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100 flex">
            <header
                class="flex-col items-center justify-center bg-red-400 shadow-lg w-1/5"
            >
                <!-- Primary Navigation Menu -->
                <!-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex"> -->
                <div class="flex items-center justify-center my-4">
                    <Link :href="route('dashboard')">
                        <ApplicationMark class="block h-auto w-20" />
                    </Link>
                </div>
                <nav class="flex flex-col">
                    <Link
                        class="text-white hover:bg-gray-600 hover:text-red-400 px-8 py-8 "
                    >
                        Gestion des employés
                    </Link>
                    <Link
                        class="flex text-white hover:bg-gray-600 hover:text-red-400 px-8 py-8 "
                    >
                        Gestion des clients
                    </Link>
                    <Link
                        class="flex text-white hover:bg-gray-600 hover:text-red-400 px-8 py-8 "
                    >
                        Gestion des fournisseurs
                    </Link>
                    <Link
                        class="flex text-white hover:bg-gray-600 hover:text-red-400 px-8 py-8 "
                    >
                        Gestion des utilisateurs
                    </Link>
                    <Link
                        class="flex text-white hover:bg-gray-600 hover:text-red-400 px-8 py-8 border-b border-b-gray-600"
                    >
                        Gestion des factures d'achat
                    </Link>
                </nav>
            </header>

            <!-- Page Content -->
            <main class="w-4/5">
                <div class="flex justify-end items-center h-16 shadow-md p-5">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="#f87171"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="#f3f4f6"
                        class="w-10 h-10"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>
                </div>
                <slot />
            </main>
        </div>
    </div>
</template>
