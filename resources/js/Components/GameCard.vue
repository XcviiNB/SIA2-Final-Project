<template>
    <div class="rounded-lg p-4 border-2 border-green-700 bg-gray-400 shadow flex hover:bg-gray-200">
        <div class="cursor-pointer flex flex-1">
            <div class="w-[160px] h-[150px] border flex justify-center items-center bg-gray-300 text-center">
                <img :src="game.picUrl" alt="Game Image" class="aspect-square w-full object-cover mb-4">
            </div>
            <div class="ml-4 flex-1"  @click="open(game)">
                <h3 class="font-bold">
                    Game Details
                </h3>
                <hr>
                <div class="text-2xl">{{ game.title }}</div>
                <div class="italic">{{ game.date_release }}</div>
                <div class="italic">{{ game.developer }}</div>
                <div class="mt-2">{{ game.synopsis }}</div>
            </div>
            <div v-if="$page.props.auth.user.roles.includes('admin')" class="flex justify-between">
                <div>&nbsp;</div>
                <label :for="'status-' + game.id" class="switch">
                    <input type="checkbox" :id="'status-' + game.id" :checked="game.available" @change="toggleActive(game)">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { router } from '@inertiajs/vue3';
    import { computed } from 'vue'


    const props = defineProps({
        game: Object,
    })

    function open(game) {
        router.visit('/games/' + game.id)
    }

    function toggleActive(game) {
        router.visit('/games/toggle/' + game.id, {
            method: 'post',
            preserveScroll: true
        })
    }

    // const user = computed(() => page.props.auth.user)
</script>

<style scoped>
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(16px);
        -ms-transform: translateX(16px);
        transform: translateX(16px);
    }

    .slider.round {
        border-radius: 20px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
