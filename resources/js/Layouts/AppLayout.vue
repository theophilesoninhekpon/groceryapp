<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import NavDropdown from "@/Components/CustomComponents/NavDropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Icons from "@/Components/CustomComponents/Icons.vue";
import SideBarNavLink from "@/Components/CustomComponents/SideBarNavLink.vue";

defineProps({
    title: String,
});

const logout = () => {
    router.post(route("logout"));
};
</script>

<template>
    <div>

        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100 flex flex-col">

            <!-- Menu de navigation principale -->
            <header class="flex justify-between bg-red-400 shadow-md h-1/5">
                <div class="flex items-center">
                    <div class="flex items-center pr-24 pl-8">
                        <Link :href="route('dashboard')">
                        <ApplicationMark class="h-auto w-20" />
                        </Link>
                    </div>
                    <p class="font-bold text-3xl text-white"> {{ $page.props.auth.user.name }} </p>
                </div>

                <div class="flex justify-between items-center p-5 space-x-10 mr-10">
                    <Link href="#">
                    <Icons name="notification" />
                    </Link>

                    <NavDropdown>
                        <template #trigger>
                            <div class="cursor-pointer">
                                <Icons name="language" />
                            </div>
                        </template>
                        <template #content>
                            <DropdownLink as="button">
                                FR
                            </DropdownLink>
                            <DropdownLink as="button">
                                EN
                            </DropdownLink>
                        </template>
                    </NavDropdown>

                    <Dropdown>
                        <template #trigger>
                            <div class="cursor-pointer">
                                <Icons name="user" />
                            </div>
                        </template>
                        <template #content>
                            <p class="px-4 py-2">{{ $page.props.auth.user.name }}</p>
                            <DropdownLink as="button">
                                Profil
                            </DropdownLink>
                            <DropdownLink as="button" @click="logout">
                                Déconnexion
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>

            </header>

            <!-- Corps de l'interface -->
            <main class="flex">

                <!-- Menu de navigation latéral -->
                <nav class="flex flex-col bg-zinc-700 height shadow-lg">
                    <SideBarNavLink :active="route().current('dashboard')" class="hover:bg-gray-600 hover:text-red-400 pr-16 pl-10 py-8 text-zinc-300"
                        :href="route('dashboard')">
                    Accueil
                    </SideBarNavLink >
                    <div>
                        <p class="pr-16 pl-10 pt-8 pb-6 text-zinc-300">Licences</p>
                        <div class="flex flex-col">
                            <SideBarNavLink :active="route().current('offers')" class="hover:bg-gray-600 hover:text-red-400 pr-16 pl-16 py-6 text-zinc-300"
                                :href="route('offers')">
                            Offres
                            </SideBarNavLink >
                            <SideBarNavLink :active="route().current('licenses')" class="hover:bg-gray-600 hover:text-red-400 pr-16 pl-16 py-6 text-zinc-300"
                                :href="route('licenses')">
                            Gestion
                            </SideBarNavLink >
                        </div>
                    </div>
                    <SideBarNavLink :active="route().current('tenants')" class="hover:bg-gray-600 hover:text-red-400 pr-16 pl-10 py-8 text-zinc-300"
                        :href="route('tenants')">
                    Clients
                    </SideBarNavLink >
                    <SideBarNavLink :active="route().current('tickets')" class="hover:bg-gray-600 hover:text-red-400 pr-16 pl-10 py-8 text-zinc-300"
                        :href="route('tickets')">
                    Tickets
                    </SideBarNavLink >
                    <SideBarNavLink :active="route().current('superadmin')" class="hover:bg-gray-600 hover:text-red-400 pr-16 pl-10 py-8 text-zinc-300"
                        :href="route('superadmin')">
                    Super Admin
                    </SideBarNavLink >
                    <SideBarNavLink :active="route().current('troubleshooting')" class="hover:bg-gray-600 hover:text-red-400 pr-16 pl-10 py-8 text-zinc-300"
                        :href="route('troubleshooting')">
                    Dépannage
                    </SideBarNavLink >
                    <SideBarNavLink :active="route().current('settings')" class="hover:bg-gray-600 hover:text-red-400 pr-16 pl-10 py-8 text-zinc-300"
                        :href="route('settings')">
                    Paramètres
                    </SideBarNavLink >
                </nav>

                <!-- Corps de la vue -->
                <div class="flex-1">
                    <h1 class="mt-6 ml-8 text-3xl font-bold text-zinc-700">
                        <slot name="title" />
                    </h1>
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<style>
.height {
    height: calc(100vh - 88px) !important;
}
</style>
