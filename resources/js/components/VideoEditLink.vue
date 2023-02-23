<template>
    <a :href="'vue/manage/videos/'+video.id" target="_blank"
       class=" text-center text-indigo-600 hover:text-indigo-900"> edit</a>
</template>

<script>
export default {
    name: "VideoEditLink",
    props: {
        video: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
