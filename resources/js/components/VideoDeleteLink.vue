<template>


        <a
           target="_blank"
           class=" text-center text-indigo-600 hover:text-indigo-900 cursor-pointer"
            @click="borrar()"> Delete</a>

</template>

<script>
export default {
    name: "VideoDeleteLink",
    props: {
        video: {
            type: Object,
            required: true
        }
    },
    methods:
{
        async borrar() {
            await window.casteaching.video.destroy(this.video.id)
        }
    }
}
</script>

<style scoped>

</style>
