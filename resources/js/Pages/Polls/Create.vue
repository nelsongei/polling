<template>
    <Head title="Create Polls"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Polls</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form class="">
                            <div class="flex md:flex md:flex-grow flex-row justify-end space-x-1 mb-2">
                                <div class="w-full md:w-1/3">
                                    <InputLabel for="name" value="Poll Title"/>
                                    <TextInput id="name" type="text" v-model="title" class="w-1/3" style="width: 100%"/>
                                </div>
                                <div class="w-full md:w-1/3">
                                    <InputLabel for="start_date" value="Start Date"/>
                                    <TextInput id="start_date" type="text" v-model="start_date" class="w-1/3" style="width: 100%"/>
                                </div>
                                <div class="w-full md:w-1/3">
                                    <InputLabel for="end_date" value="End Date"/>
                                    <TextInput id="end_date" type="text" v-model="end_date" class="w-1/3" style="width: 100%"/>
                                </div>
                            </div>
                            <PrimaryButton type="button" @click="addQuestions">Create Questions</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
export default {
    data() {
        return {
            title: "",
            start_date: "",
            end_date: "",
        }
    },
    methods:{
        addQuestions(){

        }
    },
}
</script>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
</script>
