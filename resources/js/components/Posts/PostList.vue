<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>List of Posts</h2>
                <PostCard v-for="post in posts" :key="post.id" :post="post"/>
            </div>
        </div>
    </div>
</template>

<script>
import PostCard from "./PostCard.vue";

export default {
    name: 'PostList',

    components: {
        PostCard,
    },

    data() {
        return {
            posts: [],
            baseURI: 'http://127.0.0.1:8000/api/posts/',

        }
    },

    methods: {
        getPostList(){
            axios.get(this.baseURI)
            .then((response) => {

                this.posts = [...response.data];

                console.log(this.posts);
            })
            .catch((err) => {
                console.error(err);
            });
        }
    },

    created() {
        this.getPostList();
    }
}
</script>

<style>

</style>