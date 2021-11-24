<template>
    <div class="container">
        <div v-if="isLoading"  class="row">
            <div class="col-12">
                <h2>List of Posts</h2>
                <PostCard v-for="post in posts" :key="post.id" :post="post"/>
            </div>
            <div class="col-12">
                    <ul class="pagination justify-content-center">
                        <li v-if="currentPage > 1" class="page-item">
                            <button @click="getPostList(currentPage-1)" class="page-link">Previous</button>
                        </li>
                        
                        <li v-for="n in lastPage" :key="n" :class="{ active: currentPage === n} " class="page-item">
                            <button @click="getPostList(n)" class="page-link">{{n}}</button>
                        </li>

                        <li v-if="currentPage < lastPage" class="page-item">
                            <button @click="getPostList(currentPage+1)" class="page-link">Next</button>
                        </li>
                    </ul>
            </div>
        </div>        
        <Loader v-else />
    </div>
</template>

<script>
import PostCard from "./PostCard.vue";
import Loader from "./Loader.vue";

export default {
    name: 'PostList',

    components: {
        PostCard,
        Loader,
    },

    data() {
        return {
            posts: [],
            baseURI: 'http://127.0.0.1:8000/api/posts/',
            isLoading: false,
            currentPage: null,
            lastPage: null,
        }
    },

    methods: {
        getPostList(nPage){         
            console.log(nPage);
            axios.get(this.baseURI, {
                params: {
                    page: nPage
                }
            })
            .then((response) => {
                console.log(response.data.data);
                this.posts = response.data.data;

                //Aggiorno la pagina corrente grazie all'API
                this.currentPage = response.data.current_page;
                //Ottengo l'ultima pagina disponibile nelle API
                this.lastPage = response.data.last_page;

                console.log(this.posts);

                //Aggiornando la variabile a true solo dopo che la chiamata all'API
                //è stata completata, la pagina viene visualizzata correttamente
                this.isLoading = true;
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