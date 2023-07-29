<template>
    <AppLayout title="Games">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Games</h2>
                <div>
                    <input type="text" class="rounded-full border border-gray-500 w-[400px] text-center" placeholder="&#128269;Search" @keydown.enter="search($event)">
                </div>
                <div>
                    <Link v-if="props.auth.user.roles.includes('admin')" href="/games/create" class="bg-transparent hover:bg-blue-500 text-white font-semibold hover:text-white py-2 px-4 border border-gray-700 hover:border-transparent rounded">Add a Game</Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg flex flex-wrap justify-between">
                    <div class="w-[49%] mb-4" v-for="game in games" :key="game.id">
                        <GameCard :game="game" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import GameCard from '@/Components/GameCard.vue'
    import { usePage, router, Link } from '@inertiajs/vue3';
    import { computed } from 'vue'


    const props = defineProps({
        games: Array,
        auth: Object
    })

    function search(ev) {
        router.visit('/games/search/' + ev.target.value)
    }

    const page = usePage()

    const user = computed(() => page.props.auth.user)
</script>
