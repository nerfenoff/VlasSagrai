<template lang="pug">
.container
    .row 
        .col-4
        .col
            newPosts

</template>
<script>
import newPosts from './addNewPost.vue'
export default {
    data() {
        return {
            
        }
    },
    components: {
        newPosts
    },
    beforeMount() {
        
    }
}
</script>