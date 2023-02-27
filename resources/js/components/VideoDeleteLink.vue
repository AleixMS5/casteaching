<template>


    <a
        target="_blank"
        class=" text-center text-indigo-600 hover:text-indigo-900 cursor-pointer"
        @click="borrar()"> Delete</a>

</template>

<script>
import eventBus from "../eventBus";

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
                try {
                    await window.casteaching.video.destroy(this.video.id)
                    this.$emit('removed')
                    eventBus.$emit('status', "video deleted successfully")
                } catch (error) {
                    throw error
                }

            }
        }
}
</script>

<style scoped>

</style>
