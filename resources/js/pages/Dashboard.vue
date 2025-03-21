<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { SendHorizonal, LoaderCircle } from 'lucide-vue-next';
import MessageBlock from '@/components/chat/MessageBlock.vue';

interface IMessage {
    id: number,
    user_id: number,
    user_name: string,
    user: "other" | "self",
    message: string,
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const form = useForm({
    message: ""
});

defineProps<{ messages: Array<IMessage> }>()

const submit = () => {
    form.post(route('chat.store'), {
        preserveScroll: false,
        onSuccess: () => {
            const chatScrollDiv = document.getElementById('chat-scroll');
            if (chatScrollDiv) {
                form.reset('message')
                chatScrollDiv.scrollTop = chatScrollDiv.scrollHeight;
            }
        }
    });
};

</script>

<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min
            flex flex-col justify-between
            ">
               <div class="flex-1 py-4 px-2">
                    <div id="chat-scroll" class="flex flex-col w-full h-full gap-6 p-4 max-h-[73vh] overflow-y-auto">
                        <template v-if="messages">
                            <MessageBlock  v-for="message of messages" :info="message" :key="message.id"/>
                        </template>
                        <span v-else>No messages</span>
                    </div>
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

<style>
/* Personalização da barra de rolagem com Tailwind e CSS customizado */
#chat-scroll::-webkit-scrollbar {
    width: 8px;
}

#chat-scroll::-webkit-scrollbar-thumb {
    background-color: #d6d6d6;
    border-radius: 10px;
}

#chat-scroll::-webkit-scrollbar-thumb:hover {
    background-color: #555;
}

#chat-scroll::-webkit-scrollbar-track {
    background: #888;
    border-radius: 10px;
}

</style>
