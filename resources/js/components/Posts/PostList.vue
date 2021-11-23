<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>List of Posts</h2>
                <PostCard v-for="post in posts" :key="post.id" :post="post"/>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                    <ul class="pagination justify-content-center">
                        <li v-if="currentPage > 1" class="page-item">
                            <button @click="getPostList(currentPage-1)" class="page-link">Previous</button>
                        </li>
                        
                        <li v-for="n in lastPage" :key="n" class="page-item">
                            <button @click="getPostList(n)" class="page-link">{{n}}</button>
                        </li>

                        <li v-if="currentPage < lastPage" class="page-item">
                            <button @click="getPostList(currentPage+1)" class="page-link">Next</button>
                        </li>
                    </ul>
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
            currentPage: 1,
            lastPage: null,
        }
    },

    methods: {
        getPostList(nPage){
            this.currentPage = nPage;          
            console.log(nPage);
            axios.get(this.baseURI, {
                params: {
                    page: nPage
                }
            })
            .then((response) => {
                console.log(response.data.data);
                this.posts = [...response.data.data];

                //Ottengo l'ultima pagina disponibile nelle API
                this.lastPage = response.data.last_page;

                console.log(this.posts);
            })
            .catch((err) => {
                console.error(err);
            });
        }
    },

    created() {
        this.getPostList(this.currentPage);
    }
}
</script>

<style>

</style>