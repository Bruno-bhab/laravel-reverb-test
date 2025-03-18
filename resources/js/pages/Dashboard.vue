<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { SendHorizonal, LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const form = useForm({
    message: ""
});

const messages = ref([
    {
        user_id: 1,
        user_name: "Fulano",
        message: "Olha esse novo chat que legal!"
    },
    {
        user_id: 2,
        user_name: "Ciclano",
        message: "Olha esse novo chat que legal!"
    },
    {
        user_id: 3,
        user_name: "Beltrano",
        message: "Olha esse novo chat que legal!"
    },
    {
        user_id: 4,
        user_name: "Tralano",
        message: "Olha esse novo chat que legal!"
    }
])

const submit = () => {
    form.post(route('login'));
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min
            flex flex-col
            ">
               <div class="flex-1 bg-red-900">

               </div>
               <div class="bg-zinc-800 flex items-center justify-center px-4 py-4">
                    <form @submit.prevent="submit" class="w-full flex gap-8 items-center justify-between">
                        <Input
                            id="message"
                            type="text"
                            v-model="form.message"
                            placeholder="Type your message"
                        />

                        <Button class="" type="submit" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            <SendHorizonal v-else/>
                        </Button>
                    </form>
               </div>
            </div>
        </div>
    </AppLayout>
</template>
