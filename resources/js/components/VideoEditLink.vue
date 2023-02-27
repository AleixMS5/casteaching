<template>
    <a @click="edit"
       class=" text-center text-indigo-600 hover:text-indigo-900 cursor-pointer"> edit</a>
</template>

<script>
import eventBus from "../eventBus";

export default {
    name: "VideoEditLink",
    props: {
        video: {
            type: Object,
            required: true
        }
    },methods:{
        edit(){
            eventBus.$emit('edit',this.video)
        }
    }
}
</script>

<style scoped>

</style>
