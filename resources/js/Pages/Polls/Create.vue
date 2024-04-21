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
                        <form>
                            <div class="flex flex-col md:flex-row">
                                <div class="flex flex-col md:w-1/3 mb-2 md:mb-0">
                                    <InputLabel for="name" value="Poll Title"/>
                                    <TextInput id="name" type="text" v-model="title" class="w-full"/>
                                </div>
                                <div class="flex flex-col md:w-1/3 mb-2 md:mb-0 md:ml-2">
                                    <InputLabel for="start_date" value="Start Date"/>
                                    <TextInput id="start_date" type="date" v-model="start_date" class="w-full"/>
                                </div>
                                <div class="flex flex-col md:w-1/3 mb-2 md:mb-0 md:ml-2">
                                    <InputLabel for="end_date" value="End Date"/>
                                    <TextInput id="end_date" type="date" v-model="end_date" class="w-full"/>
                                </div>
                            </div>
                            <Question :questions="questions" :options="options" @addQuestion="addQuestion" @addOption="addOption"/>
                            <button @click="storePoll" type="button" class="mt-2 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Store Poll
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import Question from "@/Pages/Polls/Question.vue";
import axios from "axios";
export default {
    data() {
        return {
            title: "",
            start_date: "",
            end_date: "",
            questions:[],
            options:[],
        }
    },
    components:{
        Question,
    },
    methods:{
        //This function will trigger and event and a question input will be created
        addQuestion(question){
            this.questions.push(question)
        },
        //This function is for removing question options
        removeQuestion(){

        },
        /*
        * Each question has its own options, passing an index to options will uniquely tell vuejs where to render each input
        * */
        addOption(questionIndex) {
            if (this.questions[questionIndex]) {
                if (!this.questions[questionIndex].options) {
                    this.questions[questionIndex].options = [];
                }
                const newOption = {
                    option_name: "",
                };
                this.questions[questionIndex].options.push(newOption);
            }
        },
        storePoll(){
            const formData = new FormData();
            formData.append('title',this.title)
            formData.append('start_date',this.start_date)
            formData.append('end_date',this.end_date)
            this.questions.forEach((question,index)=>{
                formData.append(`questions[${index}][title]`,question.title)
                question.options.forEach((option,optIndex)=>{
                    formData.append(`questions[${index}][options][${optIndex}][option_name]`,option.option_name);
                })
            });
            axios.post('/polls/store',formData)
                .then((response)=>{
                    console.log(response)
                })
                .catch((error)=>{
                    console.log(error)
                })
        },
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
