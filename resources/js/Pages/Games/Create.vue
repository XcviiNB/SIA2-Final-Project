<template>
    <AppLayout title="Add Game">
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-200 leading-tight">Add Game</h2>
                <Link class="bg-gray-500 hover:bg-blue-400 text-white font-semibold hover:text-white py-2 px-4 border border-gray-700 hover:border-transparent rounded mb-2" as="button" href="/games">Back</Link>
            </div>
        </template>

        <div class="py-6">
            <div class="bg-white max-w-4xl p-4 mx-auto rounded-lg border">
                <form @submit.prevent="submit" class="flex">
                    <div class="flex-1 pr-4">
                        <h4 class="text-xl mb-4">Personal Details</h4>
                        <div class="form-field">
                            <label for="title">Title</label>
                            <input type="text" id="title" v-model="form.title">
                        </div>

                        <div class="form-field">
                            <label for="developer">Developer</label>
                            <input type="text" id="developer" v-model="form.developer">
                        </div>

                        <div class="form-field">
                            <label for="date_release">Date Release</label>
                            <input type="date" id="date_release" v-model="form.date_release">
                        </div>

                        <div class="form-field">
                            <label for="phone">Game Image</label>
                            <input type="file" @input="form.img = $event.target.files[0]" class="h-full border-gray-400 rounded text-center" accept="image/jpeg" />
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col">
                        <h4 class="text-xl">Synopsis</h4>
                        <textarea cols="30" v-model="form.synopsis" class="flex-1 border border-gray-400 rounded "></textarea>
                        <button class="button1 mt-2" type="submit">Add Game</button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link, useForm } from '@inertiajs/vue3';

    const form = useForm({
        title: null,
        img: null,
        date_release: null,
        developer: null,
        synopsis: null
    })

    function submit() {
        form.post('/games/')
    }
</script>
