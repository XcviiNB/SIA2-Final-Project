<template>
    <AppLayout title="Show Game">
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-200 leading-tight">Game Details</h2>
                <Link class="bg-gray-500 hover:bg-blue-400 text-white font-semibold hover:text-white py-2 px-4 border border-gray-700 hover:border-transparent rounded mb-2" as="button" :href="'/games/'">Back</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-300 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex">
                        <div class="w-[300px] h-[400px] border flex justify-center items-center">
                            <img :src="game.picUrl" alt="Game Image" class="aspect-square w-full object-cover mb-4">
                        </div>
                        <div class="flex-1 ml-4">
                            <div class="flex">
                                <h3 class="text-2xl flex-1">{{ game.title }}</h3>
                                <div v-if="props.auth.user.roles.includes('admin')">
                                    <Link class="button2 mr-2" :href="'/games/' + game.id" method="delete" as="button">Delete</Link>
                                    <Link class="button1 mb-2" :href="'/games/edit/' + game.id" as="button">Edit</Link>
                                </div>
                            </div>
                            <hr>
                            <div class="mt-4">{{ game.date_release }}</div>
                            <div class="py-4">{{ game.developer }}</div>
                            <div class="p-4 border rounded">
                                {{ game.synopsis }}
                            </div>
                            <div class="mt-4" v-if="game.available">
                                Available: <bold class="text-green-500" style="text-decoration: underline;"> Yes </bold>
                            </div>
                            <div class="mt-4" v-else>
                                Available: <bold class="text-red-500" style="text-decoration: line-through;"> No </bold>
                            </div>
                        </div>
                    </div>
                    <div v-if="props.auth.user.roles.includes('customer') && game.available" class="flex justify-end pr-6 pb-6">
                        <Link class="bg-green-700 hover:bg-green-600 text-gray-200 font-semibold py-2 px-4 rounded">
                            &#x1F6D2;Order Now
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Head, Link, usePage } from '@inertiajs/vue3';
    import { computed } from 'vue'

    const props = defineProps({
        game: Object,
        auth: Object
    })

    const page = usePage()

    const user = computed(() => page.props.auth.user)
</script>
