<script setup>
import {Head, Link} from '@inertiajs/vue3';
</script>

<template>
    <Head title="View Results"/>

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter selection:text-white"
    >
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <Link
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >Dashboard
            </Link
            >
            <Link
                :href="route('login')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >Log in
            </Link
            >

            <Link
                v-if="canRegister"
                :href="route('register')"
                class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >Register
            </Link
            >
        </div>
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="font-semibold mb-2">{{ poll.name }}</div>
            <template v-for="(question, index) in poll_data.questions" :key="question.id">
                <div class="mb-4">
                    <h3 class="font-semibold mb-2">{{ question.title }}</h3>
                    <template v-for="option in question.options">
                        <p>{{option.option+' '+option.votes.length}}</p>
                        <div class="mb-1 text-base font-medium dark:text-white">{{option.option}}</div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700">
                            <div class="bg-blue-600 h-1.5 rounded-full dark:bg-blue-500"  :style="{ width: (option.votes.length * 10) + '%' }"></div>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    props: {
        poll: {},
    },
    data() {
        return {
            poll_data:{},
        }
    },
    mounted() {
        this.getPolls()
    },
    methods:{
        getPolls(){
            setInterval(()=>{
                axios.get('/all_results/'+this.poll.id)
                    .then((response)=>{
                        this.poll_data = response.data
                    })
            },100)
        }
    }
}
</script>
<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
