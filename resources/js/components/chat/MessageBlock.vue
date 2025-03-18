<template>
    <div :class="componentClasses">
        <span class="text-xl font-bold">{{info?.user_name}}</span>
        <span>{{ info?.message }}</span>
    </div>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue';

const props = defineProps({
    'info': Object
})

const defaultClasses = ref("flex flex-col w-96 gap-4 rounded-lg p-4")

const componentClasses = computed(() => {
    if(props.info?.user == 'self'){
        return defaultClasses.value + " self-end bg-blue-900"
    }

    return defaultClasses.value + " self-start bg-zinc-700"
})
</script>
