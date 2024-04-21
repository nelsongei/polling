<template>
    <template v-for="(question, questionIndex) in questions" :key="questionIndex">
        <div class="flex flex-col md:flex-row">
            <div class="flex flex-col md:w-2/3 mb-2 md:mb-0">
                <InputLabel :for="'question_' + questionIndex" value="Question"/>
                <TextInput :id="'question_' + questionIndex" type="text" v-model="question.title" class="w-full"/>
            </div>
            <div class="flex flex-col md:w-1/3 mb-2 md:mt-5 md:ml-2">
                <DangerButton type="button" @click="removeQuestion(questionIndex)">
                    Remove Question
                </DangerButton>
            </div>
        </div>
        <div class="flex flex-col md:flex-row md:mt-2">
            <PrimaryButton type="button" @click="addOption(questionIndex)">Add Option</PrimaryButton>
        </div>
        <div class="flex flex-col md:flex-row" v-for="(option, optionIndex) in question.options" :key="optionIndex">
            <div class="flex flex-col md:w-2/3 mb-2 md:mb-0">
                <InputLabel :for="'option_' + questionIndex + '_' + optionIndex" :value="'Option ' + (optionIndex + 1)"/>
                <TextInput :id="'option_' + questionIndex + '_' + optionIndex" type="text" v-model="option.option_name" class="w-full"/>
            </div>
        </div>
    </template>
    <div class="flex flex-col md:flex-row mt-2">
        <PrimaryButton type="button" @click="addQuestion" class="self-center mt-2 md:mt-0">Create Questions</PrimaryButton>
    </div>
</template>

<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import DangerButton from "@/Components/DangerButton.vue";
</script>

<script>
export default {
    props: {
        questions: [],
    },
    methods: {
        addQuestion() {
            const newQuestion = {
                title: "",
                options: []
            };
            this.$emit('addQuestion', newQuestion);
        },
        removeQuestion(index) {
            this.$emit('removeQuestion', index);
        },
        addOption(questionIndex) {
            const newOption = {
                option_name: "",
            };
            this.questions[questionIndex].options.push(newOption);
        }
    }
}
</script>
