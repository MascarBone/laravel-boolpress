<template>
    <div class="container">
        <div class="row justify-content-center">
            <Header :title="valore"/>
            <PostList />
        </div>
    </div>
</template>

<script>
    import Header from "./Header.vue";
    import PostList from "./Posts/PostList.vue";

    export default {
        // name: 'App',
        
        components: {
            Header,
            PostList,
        },

        data() {
            return {
                valore : 'posts',
            }
        },
    }
</script>
