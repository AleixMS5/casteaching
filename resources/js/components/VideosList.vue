<template>
    <div class=" px-4  mt-8 flex flex-col ">
        <div class="-my-2  overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class=" bg-gray-50 overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <div class=" bg-gray-50 mt-2 ml-5 sm:flex-auto">
                        <h1 class="bg-gray-50 text-xl font-semibold text-gray-900">Videos
                        <button class="inline-flex items-center rounded border border-transparent bg-indigo-600 px-3 py-2 text-xs font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" @click="refresh">
                            Refresh
                        </button>
                        </h1>

                    </div>
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6">id
                            </th>
                            <th scope="col"
                                class=" px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                                Title
                            </th>
                            <th scope="col"
                                class=" px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                description
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left  text-sm font-semibold text-gray-900">
                                url
                            </th>
                            <th scope="col" class="px-3 py-3.5 text-left  text-sm font-semibold text-gray-900">
                                actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">

                        <tr class="bg-white" v-for="video in videos">


                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ video.id }}</td>
                            <td class=" whitespace-nowrap px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ video.title }}</td>
                            <td class=" whitespace-nowrap px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ video.description }}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-left text-sm font-medium sm:pr-6">
                                <a href=""
                                   target="_blank"
                                   class="text-indigo-600 hover:text-indigo-900">{{video.url}}</a>
                            </td>

                            <td class="whitespace-nowrap py-4 pl-3 pr-4  text-sm font-medium sm:pr-6 text-center">
                                <video-show-link :video=video></video-show-link>
                                <video-edit-link :video=video></video-edit-link>
                                <video-delete-link :video=video @removed="refresh()"></video-delete-link>

                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VideoShowLink from "./VideoShowLink.vue";
import VideoEditLink from "./VideoEditLink.vue";
import VideoDeleteLink from "./VideoDeleteLink.vue";
import eventBus from "../eventBus";
import {defaultsDeep} from "lodash/object";
export default {
    name: "VideosList",
    components:{
        'video-show-link':VideoShowLink,
        'video-edit-link':VideoEditLink,
        'video-delete-link':VideoDeleteLink,
    },
    data() {
        return {
            videos: []
        // {
        //     "id": 1,
        //     "title": "Video 1",
        //     "description": "Descripciu00f3",
        //     "url": "https://www.youtube.com/watch?v=zyABmm6Dw64&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=5",
        //     "published_at": null
        //
        // }, {
        //     "id": 2,
        //         "title": "Video 2",
        //         "description": "Descripciu00f3",
        //         "url": "https://www.youtube.com/watch?v=q06GbMP1h_s&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=2",
        //         "published_at": null
        //
        // }, {
        //     "id": 3,
        //         "title": "Video 3",
        //         "description": "Descripciu00f3",
        //         "url": "https://www.youtube.com/watch?v=ofSbYUEml4c&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=9&t=1520s",
        //         "published_at": null
        //
        // }, {
        //     "id": 4,
        //         "title": "Ubuntu 101",
        //         "description": "",
        //         "url": "https://youtu.be/w8j07_DBl_I",
        //         "published_at": "2020-12-13T20:00:00.000000Z"
        //
        // }
        }
    },
    async created() {
        await this.getVideos()
        eventBus.$on('created',async () => {

            await this.refresh()
        });
        eventBus.$on('updated',async () => {

            await this.refresh()
        });
    },
    methods:{
        async getVideos() {
            this.videos = await window.casteaching.videos()
        },
        async refresh() {
            await this.getVideos()
        }
    }

}
</script>

<style scoped>

</style>
