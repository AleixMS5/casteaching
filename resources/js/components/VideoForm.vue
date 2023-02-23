<template>
    <div>
    <div class="lg:grid bg-white md:bg-transparent  lg:grid-cols-12 lg:gap-x-5 mt-5">
        <aside class=" py-6 px-4 sm:px-6 lg:col-span-3 lg:py-0 lg:px-4">
            <h3 class="  py-5 text-gray-900 font-medium text-lg leading-5 ">
                Vídeos
            </h3>
            <p class="text-gray-600 text-sm mt-1">Informació Bàsica del video</p>
        </aside>
        <div class="space-y-6 sm:px-6 lg:col-span-9 lg:px-0">

            <form class="px-4 py-5" data-qa="form_video_create" @submit.prevent="store" method="POST">

                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white py-6 px-4 sm:p-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="title">Tilte</label>
                            <div class="mt-1">
                                <input
                                    class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    type="text" name="title" id="title" v-model="video.title">
                            </div>

                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700"
                                   for="description">Description</label>
                            <div class="mt-1">
                            <textarea type="text" name="description" id="description" rows="10"  v-model="video.description"
                                      class="block w-full  rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                            </div>

                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="url">URL</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                    <span
                                        class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">http://</span>
                                <input
                                    class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="https://www.youtube.com/watch?v=tweo3gmdha4&list=PLyasg1A0hpk07HA0VCApd4AGd3Xm45LQv&index=19"
                                    type="url" name="url" id="url"  v-model="video.url">
                            </div>

                        </div>

                        <div class=" px-4 py-3 text-right sm:px-6">
                            <button

                                type="submit"
                                class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Create Video
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    name: "VideoForm",
    data(){
        return{video:{}
        }

    },
    methods:{
        store(){

            window.casteaching.video.create({
                title:this.video.title,
                url:this.video.url,
                description: this.video.description
            })
        }
    }
}
</script>

<style scoped>

</style>
