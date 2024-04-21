<template>
    <Head title="Polls" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Polls</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <PrimaryButton class="md:mb-2">
                            <Link :href="route('polls.create')">
                                Create Poll</Link></PrimaryButton>
                        <div class="flex flex-col md:flex-row">
                            <template v-for="poll in polls">
                                <Link :href="route('polls.view',poll.id)" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg md:ml-3" >
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-black">{{poll.name}}</h5>
                                    <p class="font-normal text-gray-700 dark:text-gray-400">Questions: {{poll.questions.length}}</p>
                                </Link>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
export default {
    props:{
        polls:[]
    }
}
</script>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>
