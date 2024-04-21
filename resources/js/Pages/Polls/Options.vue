<template>
    <div class="flex flex-col md:flex-row">
        <PrimaryButton type="button">Add Option</PrimaryButton>
    </div>
    <div class="flex flex-col md:flex-row" v-for="option in options">
        <div class="flex flex-col md:w-2/3 mb-2 md:mb-0">
            <InputLabel for="name" value="Question"/>
            <TextInput id="name" type="text" v-model="option.title" class="w-full"/>
        </div>
    </div>
</template>
<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>
<script>
export default {
    props:{
        options:[]
    }
}
</script>
