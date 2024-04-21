<template>
    <Head :title="poll.name"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ poll.name }}</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <template v-for="(question, questionIndex) in poll.questions" :key="questionIndex">
                            <div class="mb-4">
                                <h3 class="font-semibold mb-2">{{ question.title }}</h3>
                                <div v-for="(option, optionIndex) in question.options" :key="optionIndex">
                                    <input type="radio" :id="'option_' + questionIndex + '_' + optionIndex"
                                           :name="'question_' + questionIndex" :value="optionIndex"
                                           v-model="selectedOptions[questionIndex]"
                                           @click="vote(option.id, question.id)"
                                           :disabled="hasUserVoted(option.id,option.vote)"
                                           :checked="hasUserVoted(option.id, option.vote)"
                                    >
                                    <label :for="'option_' + questionIndex + '_' + optionIndex"
                                           class="md:ml-3">{{ option.option }}</label>
                                </div>
                            </div>
                        </template>
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
            selectedOptions: [],
        };
    },
    props: {
        poll: {},
        loggedInUserId: "",
    },
    methods: {
        vote(id, qId) {
            const formData = new FormData();
            formData.append('option_id', id)
            formData.append('question_id', qId)
            axios.post('/votes/store', formData)
                .then((response) => {
                    console.log(response)
                })
                .catch((error) => {
                    console.log(error)
                })
        },
        hasUserVoted(optionId, vote) {
            if (vote !== null) {
                const userId = this.loggedInUserId;
                return vote.user_id === userId && vote.answer_id === optionId;
            } else {
                return false;
            }
        }
    },
}
</script>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>

